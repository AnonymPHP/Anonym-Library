<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Validation;

/**
 * Class Validation
 * @package Anonym\Validation
 */
class Validation
{

    /**
     * an array type to rules
     *
     * @var array
     */
    protected $rules;

    /**
     * an array type to datas
     *
     * @var array
     */
    protected $datas;

    /**
     *
     *
     * @var array
     */
    protected $fails;

    /**
     * failed data messages
     *
     * @var array
     */
    protected $failedMessages;

    /**
     * ValidationErrorMessage Reposity, store the given messages
     *
     * @var ValidationErrorMessage
     */
    protected $messageReposity;

    /**
     * Validation constructor.
     *
     * @param array $datas
     * @param array $rules
     */
    public function __construct($datas = [], $rules = [], $messages = [])
    {
        $this->setDatas($datas)
            ->setRules($rules)
            ->setMessageReposity(new ValidationErrorMessage())
            ->getMessageReposity()->setErrors($messages);
    }


    /**
     * determine datas is correct or not
     *
     * @throws Exception
     */
    public function run()
    {
        if (!is_array($rules = $this->getRules())) {
            $rules = $this->convertToArray($rules);
        }

        if (!is_array($datas = $this->getDatas())) {
            $datas = $this->convertToArray($datas);
        }

        foreach ($rules as $key => $rule) {
            $parsedRules = explode("|", $rule);

            foreach ($parsedRules as $parsedRule) {
                $this->handleRule($parsedRule, $key,  $datas);
            }
        }
    }

    /**
     * handle the given rule
     *
     * @param string $rule
     * @param string $key
     * @param array $allDatas
     */
    private function handleRule($rule,$key, array $allDatas){
        if (!strstr($rule,":")) {
            $this->$rule($key, $allDatas);
        }else{
            $value = explode(":", $key)[1];
            if (strstr($value, ",")) {
                $sendDatas = [explode(",", $value), $key, $allDatas];
            }else{
                $sendDatas = [$value, $key, $allDatas];
            }

            call_user_func_array([$this, $rule], [$sendDatas]);
        }
    }

    private function runRequired($key, $datas)
    {

    }

    /**
     * tries convert given variable type to array
     *
     * @param mixed $notArray
     * @throws Exception
     * @return array
     */
    private function convertToArray($notArray)
    {
        if (is_object($notArray) || is_string($notArray) || is_numeric($notArray)) {
            return (array)$notArray;
        } else {
            throw new Exception(sprintf('your data could not convert to array'));
        }
    }

    /**
     * return the failed datas
     *
     * @return array
     */
    public function fails()
    {
        return $this->getFails();
    }

    /**
     * @return array
     */
    public function getFails()
    {
        return $this->fails;
    }

    /**
     * @param array $fails
     * @return Validation
     */
    public function setFails($fails)
    {
        $this->fails = $fails;
        return $this;
    }


    /**
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @param array $rules
     * @return Validation
     */
    public function setRules($rules)
    {
        $this->rules = $rules;
        return $this;
    }

    /**
     * @return ValidationErrorMessage
     */
    public function getMessageReposity()
    {
        return $this->messageReposity;
    }

    /**
     * @param ValidationErrorMessage $messageReposity
     * @return Validation
     */
    public function setMessageReposity(ValidationErrorMessage $messageReposity)
    {
        $this->messageReposity = $messageReposity;
        return $this;
    }

    /**
     * @return array
     */
    public function getDatas()
    {
        return $this->datas;
    }

    /**
     * @param array $datas
     * @return Validation
     */
    public function setDatas($datas)
    {
        $this->datas = $datas;
        return $this;
    }

}
