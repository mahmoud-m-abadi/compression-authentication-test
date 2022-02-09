<?php

namespace App\Exceptions;

class CompressedFileTypeException extends \Exception
{
    public function __construct($message = "Compression Type is not allowed to use!", $code = 1004, \Throwable $previous = null)
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
