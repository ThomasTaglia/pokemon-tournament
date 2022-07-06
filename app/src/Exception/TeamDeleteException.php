<?php


namespace App\Exception;


use Throwable;

class TeamDeleteException extends TeamException
{
    /**
     * @inheritDoc
     */
    public function __construct($message = "", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}