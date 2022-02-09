<?php

namespace App\Exceptions;

class CompressedFilePathException extends \Exception
{
    public function __construct($message = "Can't open zip file!", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function render()
    {
        return $this->message;
    }
}
