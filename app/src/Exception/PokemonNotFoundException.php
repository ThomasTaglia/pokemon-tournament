<?php


namespace App\Exception;


use Throwable;

class PokemonNotFoundException extends PokemonException
{
    /**
     * @inheritDoc
     */
    public function __construct($message = "", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}