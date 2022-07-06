<?php


namespace App\Exception;


use Throwable;

/**
 * Class TeamNotFoundException
 * @package App\Exception
 */
class TeamNotFoundException extends TeamException
{
    /**
     * @inheritDoc
     */
    public function __construct($message = "", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}