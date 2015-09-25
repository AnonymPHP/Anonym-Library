<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Element\Query;


use Anonym\Element\Query\Grammer\Grammer;
use Illuminate\Container\Container;

class Builder
{

    /**
     * the instance of laravel container
     *
     * @var Container
     */
    protected $container;

    /**
     * the instance of grammer
     *
     * @var Grammer
     */
    protected $grammer;


    public function __construct(Container $container, Grammer $grammer){
        $this->container = $container;
        $this->grammer = $grammer;
    }

}
