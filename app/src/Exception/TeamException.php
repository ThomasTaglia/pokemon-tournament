<?php


namespace App\Exception;

use Throwable;

/**
 * Class TeamException
 * @package App\Exception
 */
class TeamException extends \Exception
{
    /**
     * @inheritDoc
     */
    public function __construct($message = "", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}