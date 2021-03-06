<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Support;

/**
 * Class TemplateGenerator
 * @package Anonym\Support
 */
class TemplateGenerator
{

    /**
     * the content of template
     *
     * @var string
     */
    private $content;


    /**
     * create a new instance and register the content
     *
     * @param string $content
     */
    public function __construct($content = '')
    {
        $this->setContent($content);
    }

    /**
     * create the new content
     *
     * @param array $parameters
     * @return mixed|string
     */
    public function generate($parameters = [])
    {

        $content = $this->getContent();
        if (count($parameters)) {
            foreach ($parameters as $param => $value) {
                $content = str_replace("{{ $param }}", $value, $content);
            }
        }

        return $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return TemplateGenerator
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }


}