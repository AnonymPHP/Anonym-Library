<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Billing;
use Anonym\Element\Element;

/**
 * Class Billing
 * @package Anonym\Billing
 */
class Billing
{

    /**
     * @var Element
     */
    protected $element;

    /**
     * the constructor of Billing .
     * @param Element $element
     */
    public function __construct(Element $element)
    {
        $this->element = $element;
    }
}
