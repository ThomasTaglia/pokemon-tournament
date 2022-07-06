<?php


namespace App\Exception;


use Throwable;

/**
 * Class PokemonCreationException
 * @package App\Exception
 */
class PokemonCreationException extends PokemonException
{
    /**
     * @inheritDoc
     */
    public function __construct($message = "", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}