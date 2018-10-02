<?php

namespace App\QuikService\Libraries\SMS\Exceptions;

use Exception;

class SMSFailException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @param string $message
     */
    public function __construct($message = null)
    {
        if (!app_debug_enabled() || empty($message)) {
            $message = 'Error occurred when sending SMS.';
        }

        parent::__construct($message);
    }
}
