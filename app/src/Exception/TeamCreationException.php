<?php


namespace App\Exception;


use Throwable;

/**
 * Class TeamCreationException
 * @package App\Exception
 */
class TeamCreationException extends TeamException
{
    /**
     * @inheritDoc
     */
    public function __construct($message = "", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}