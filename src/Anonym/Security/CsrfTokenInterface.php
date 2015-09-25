<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */

namespace Anonym\Components\Security;

/**
 * Interface CsrfTokenInterface
 * @package Anonym\Components\Security
 */
interface CsrfTokenInterface
{

    /**
     * Csrftoken i kontrol eder
     *
     * @return mixed
     */
    public function run();
}
