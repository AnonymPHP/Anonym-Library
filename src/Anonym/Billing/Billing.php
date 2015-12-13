<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Billing;

use Anonym\Database\Database;
use Anonym\Facades\Config;

/**
 * Class Billing
 * @package Anonym\Billing
 */
class Billing extends Database
{

    /**
     * selected columns
     *
     * @var array
     */
    protected $select = [
        'trail_started', 'trail_ends_at', 'user_id', 'subscription_started', 'subscription_plan', 'subscription_status', 'subscription_ends_at'
    ];

    /**
     * store the subscription plans
     *
     * @var array
     */

    protected $subscriptionPlans;
    /**
     * the table name of cashier
     *
     * @var string
     */
    protected $table;

    /**
     * @var int
     */
    protected $selectedUserId;

    /**
     *
     * @var int
     */
    protected $trailDays;

    /**
     * the constructor of Billing .
     * @param int $selectedUserId
     */
    public function __construct($selectedUserId = 0)
    {
        $this->table = Config::get('billing.table_name');
        $this->subscriptionPlans = Config::get('billing.plans');
        $this->trailDays = Config::get('billings.trails_days');
        $this->selectedUserId = $selectedUserId;
        $this->whereOrCreate('user_id', $selectedUserId);
        parent::__construct();
    }

    /**
     * return or set the cash amount
     *
     * @param null $cash
     * @return mixed
     */
    public function cash($cash = null)
    {
        if ($cash !== null) {
            $this->update([
                'cash' => $cash
            ]);
        } else {
            return $this->getFirstAttribute()['cash'];
        }
    }

    /**
     * return or set trail started time
     *
     * @param null $started
     * @return $this|null
     */
    public function trailStarted($started = null)
    {
        if ($started === null) {
            return $this->trail_started;
        } else {
            $this->trail_started = $started;
            return $this;
        }
    }

    /**
     * return or set trail end time
     *
     * @param null $endDate
     * @return $this|null
     */
    public function trailEndsAt($endDate = null)
    {
        if ($endDate === null) {
            return $this->trail_ends_at;
        } else {
            $this->trail_ends_at = $endDate;
            return $this;
        }
    }

    /**
     * check this is started or not
     *
     * @return bool
     */
    public function isTrail()
    {
        if (time() > $this->trailStarted() && time() < $this->trailEndsAt()) {
            return true;
        } else {
            false;
        }
    }

    /**
     * return the timestamp of subscription_ends_at
     *
     * @param int $started
     * @param int $days
     * @return int
     */
    protected function findTimestampOfSubscription($started, $days)
    {
        return strtotime("$days+ days", $started);
    }

    /**
     * determine our subscription is a valid subscription
     *
     * @return bool
     * @throws BillingSubscriptionPlanException
     */
    public function isSubscription()
    {
        $started = $this->subscriptionStarted();
        $status = $this->status();
        $time = time();

        if (!isset($this->subscriptionPlans[$plan = $this->plan()])) {
            throw new BillingSubscriptionPlanException(sprintf('Your %s plan is not exists in our website'));
        }

        if ($started !== '' && is_numeric($started) && $status !== '' && $status !== 'canceled' && $time < $this->findTimestampOfSubscription($started, $plan)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * return or set subscription status
     *
     * @param null $status
     * @return $this|null
     */
    public function status($status = null)
    {
        if ($status === null) {
            return $this->subscription_status;
        } else {
            $this->subscription_status = $status;
            return $this;
        }
    }


    /**
     * set or return subscription plan
     *
     * @param null $plan
     * @return $this|null
     */
    public function plan($plan = null)
    {
        if ($plan === null) {
            return $this->subscription_plan;
        } else {
            $this->subscription_plan = $plan;
            return $this;
        }
    }

    /**
     * put the canceled value to subscrition status
     *
     * @return $this
     */
    public function cancel()
    {
        return $this->status('canceled');
    }

    /**
     * pause the subscription
     *
     * @return $this
     * @throws BillingSubscriptionPlanException
     */
    public function pause()
    {
        $this->status('paused');
        $started = $this->subscriptionStarted();

        if (!isset($this->subscriptionPlans[$plan = $this->plan()])) {
            $this->delete();
            throw new BillingSubscriptionPlanException(sprintf('Your %s plan is not exists in our website'));
        }

        $endTime = $this->findTimestampOfSubscription($started, $plan);
        $left = $endTime - $started;
        $this->subscription_paused_left = $left;
        return $this;
    }

    public function resume()
    {
        $time = time();
        $this->subscriptionStarted($time - $this->subscription_paused_left);
    }

    public function subscriptionEndsAt($ends = null)
    {
        if ($ends === null) {
            return $this->subscription_ends_at;
        } else {
            $this->subscription_ends_at = $ends;
            return $this;
        }
    }

    /**
     * return or set subscription status
     *
     * @param null $started
     * @return mixed
     * @throws BillingSubscriptionPlanException
     */
    public function subscriptionStarted($started = null)
    {
        if ($started === null) {
            return $this->subscription_started;
        } else {
            if (!isset($this->subscriptionPlans[$plan = $this->plan()])) {
                $this->delete();
                throw new BillingSubscriptionPlanException(sprintf('Your %s plan is not exists in our website'));
            }

            $this->subscription_started = $started;
            $this->subscriptionEndsAt($this->findTimestampOfSubscription($started, $plan));

            $this->status('started');
            return $this;
        }
    }

    /**
     * determine subscription is correct
     *
     * @return mixed
     */
    public function subscripted()
    {
        return $this->isTrail() ?: $this->isSubscription();
    }

    public function create()
    {

    }
}
