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
     * @var array
     */
    protected $messageReposity;

    /**
     * store the default error messages
     *
     * @var
     */
    protected $defaultErrorMessages;

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
            ->setMessageReposity($messages);
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
                $this->handleRule($parsedRule, $key, $datas);
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
    private function handleRule($rule, $key, array $allDatas)
    {

        $methodName = "run".ucfirst(str_replace("-","", $rule));

        if (!strstr($rule, ":")) {
            $this->callMethod($methodName, [$key, $allDatas, $rule]);
        } else {
            $value = explode(":", $key)[1];
            if (strstr($value, ",")) {
                $sendDatas = [explode(",", $value), $key, $allDatas, $rule];
            } else {
                $sendDatas = [$value, $key, $allDatas, $rule];
            }

            $this->callMethod($methodName, $sendDatas);
        }
    }

    /**
     * @param string $key
     * @param array $datas
     * @param string $rule
     */
    protected function runRequired($key, $datas, $rule = '')
    {
        if (!isset($datas[$key]) && !empty($datas[$key])) {
            $this->fails[] = $messageKey = "required.$key";

            $this->addMessage($key, $rule, $messageKey);
        }
    }

    /**
     * determine data is numeric
     *
     * @param string $key
     * @param array $datas
     * @param string $rule
     */
    protected function runNumeric($key, $datas, $rule = '')
    {
        if (!is_numeric($datas[$key])) {
            $this->fails[] = $messageKey = "numeric.$key";

            $this->addMessage($key, $rule, $messageKey);
        }
    }


    /**
     * @param $max
     * @param $key
     * @param $datas
     * @param $rule
     */
    protected function runMax($max, $key, $datas, $rule)
    {
        $data = $datas[$key];

        if (is_string($data)) {
            $lenght = strlen($data);
        }elseif(is_numeric($data)){
            $lenght = $data;
        }

        if($lenght > $max){
            $this->fails[] = $messageKey = "max.$key";

            $this->addMessage($key, $rule, $messageKey, [$max]);
        }
    }


    /**
     * determine email is right
     *
     * @param $key
     * @param $datas
     * @param $rule
     */
    protected function runEmail($key, $datas, $rule){

        $email = $datas[$key];
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $this->fails[] = $messageKey = "email.$key";

            $this->addMessage($key, $rule, $messageKey);
        }

    }

    /**
     * @param $min
     * @param $key
     * @param $datas
     * @param $rule
     */
    protected function runMin($min, $key, $datas, $rule)
    {
        $data = $datas[$key];

        if (is_string($data)) {
            $lenght = strlen($data);
        }elseif(is_numeric($data)){
            $lenght = $data;
        }

        if($lenght > $min){
            $this->fails[] = $messageKey = "min.$key";

            $this->addMessage($key, $rule, $messageKey, [$min]);
        }
    }

    /**
     * determine given regex is matching with given datas
     *
     * @param $regex
     * @param $key
     * @param $datas
     * @param $rule
     */
    protected function runRegex($regex, $key, $datas, $rule)
    {
        if (!preg_match($regex, $datas[$key])) {
            $this->fails[] = $messageKey = "regex.$key";

            $this->addMessage($key, $rule, $messageKey);
        }
    }


    /**
     * adds a error message
     *
     * @param string $key
     * @param string $rule
     * @param string $specialRule
     * @param array $datas
     */
    protected function addMessage($key, $rule, $specialRule, array $datas = [])
    {
        $specialMessages = $this->getMessageReposity();
        $defaultMessages = $this->defaultErrorMessages;

        if (count($datas) === 0) {
            $datas = [$key];
        }

        if (isset($specialMessages[$specialRule])) {
            $selectedMessage = $specialMessages[$specialRule];
        } else {
            $selectedMessage = $defaultMessages[$rule];
        }

        array_unshift($datas, $selectedMessage);
        $this->failedMessages[] = call_user_func_array('sprintf', $datas);
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
     * @return array
     */
    public function getMessageReposity()
    {
        return $this->messageReposity;
    }

    /**
     * @param array $messageReposity
     * @return Validation
     */
    public function setMessageReposity($messageReposity)
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
