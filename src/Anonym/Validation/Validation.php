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
