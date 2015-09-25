<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Components\View;

/**
 * Class View
 * @package Anonym\Components\View
 */
class View extends Blade
{

    /**
     * the instance of language manager
     *
     * @var LanguageManager
     */
    protected  $languageManager;
    /**
     * create a new instance and register blade
     *
     * @param array $configs
     */
    public function __construct(array $configs = [])
    {
        $cache = isset($configs['cache']) ? $configs['cache'] : RESOURCE . 'cache/';
        $view = isset($configs['view']) ? $configs['view'] : VIEW;
        $language = isset($configs['language']) ? $configs['language'] : LANGUAGE;

        $this->languageManager = new LanguageManager($language);

        parent::__construct($view, $cache);
    }

    /**
     * get the language parameters
     *
     * @param string $lang
     * @return array|bool
     */
    public function lang($lang = ''){
        return $this->languageManager->getLanguage($lang);
    }

    /**
     * if called method not found in this class, call it in view.
     *
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public function __call($method, array $args)
    {
        return call_user_func_array([$this->instance, $method], $args);
    }

}
