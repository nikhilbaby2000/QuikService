<?php

namespace App\QuikService\Libraries\SMS\Providers;

interface ProviderContract
{
    /**
     * Send the SMS.
     *
     * @param array $numbers
     * @param string $message
     * @param int $type
     * @return bool
     * @throws \App\QuikService\Libraries\SMS\Exceptions\SMSFailException
     * @throws \App\QuikService\Libraries\SMS\Exceptions\SMSInsufficientCreditsException
     */
    public function send(array $numbers, $message, $type);
}
