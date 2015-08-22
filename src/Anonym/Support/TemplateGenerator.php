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
    private  $content;

    public function generate($parameters = [])
    {

        $content = $this->getContent();
        if (count($parameters)) {
            foreach($parameters as $param)
            {
                 $this
            }
        }

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