<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Mail;

/**
 * Interface SwiftAttachmentDInterface
 * @package Anonym\Mail
 */
interface SwiftAttachmentInterface
{

    /**
     * get the created attachment
     *
     * @return \Swift_Mime_Attachment
     */
    public function getAttach();

}
