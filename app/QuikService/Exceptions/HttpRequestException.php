<?php

namespace App\QuikService\Exceptions;

use Exception;

class HttpRequestException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @param array $error
     * @throws Exception
     */
    public function __construct(array $error)
    {
        parent::__construct(json_encode($error));
    }
}
