<?php


namespace App\Repository\interfaces;

use App\Entity\Pokemon;
use App\Entity\Team;

/**
 * Interface PokemonRepository
 * @package App\Repository\interfaces
 */
interface PokemonRepository
{
    /**
     * @param Team $team
     * @return Pokemon[]|null
     */
    public function getByTeam(Team $team): ?array;

    /**
     * @param Pokemon $pokemon
     */
    public function add(Pokemon $pokemon): void;

    /**
     * @param Pokemon $pokemon
     */
    public function remove(Pokemon $pokemon): void;

    /**
     * @param int $id
     * @return Pokemon|null
     */
    public function getById(int $id): ?Pokemon;
}