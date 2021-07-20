<?php

namespace App\Exceptions;


use Exception;

class ConfigMissingException extends Exception
{
    protected $message = 'Configuration file is missing.';
}
