<?php


namespace App\Service\Reader;

use App\Entity\Pokemon;
use App\Entity\Team;
use App\Repository\interfaces\PokemonRepository;

/**
 * Class PokemonReader
 * @package App\Service\Reader
 */
class PokemonReader
{
    /**
     * @var PokemonRepository
     */
    private PokemonRepository $pokemonRepository;

    /**
     * PokemonReader constructor.
     * @param PokemonRepository $pokemonRepository
     */
    public function __construct(PokemonRepository $pokemonRepository)
    {
        $this->pokemonRepository = $pokemonRepository;
    }

    /**
     * @param Team $team
     * @return Pokemon[]|null
     */
    public function getPokemonListByTeam(Team $team): ?array
    {
        return $this->pokemonRepository->getByTeam($team);
    }
}