<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Element;

/**
 * Class Cashier
 * @package Anonym\Element
 */
class Cashier
{
    /**
     * the instance of Element Class
     *
     * @var Element
     */
    protected $element;


    /**
     * the constructor of Cashier .
     * @param Element $element
     */
    public function __construct(Element $element)
    {
        $this->element = $element;
    }
}