<?php


namespace App\Exception;

use Throwable;

/**
 * Class PokemonException
 * @package App\Exception
 */
class PokemonException extends \Exception
{

    /**
     * @inheritDoc
     */
    public function __construct($message = "", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}