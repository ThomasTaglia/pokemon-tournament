<?php


namespace App\Repository;


use App\Entity\Pokemon;
use App\Entity\Team;
use App\Repository\interfaces\PokemonRepository;

/**
 * Class PokemonDoctrineRepository
 * @package App\Repository
 */
class PokemonDoctrineRepository extends BaseDoctrineRepository implements PokemonRepository
{

    /**
     * @inheritDoc
     */
    public function getByTeam(Team $team): ?array
    {
        return $this->entity_manager->getRepository(Pokemon::class)->findBy(['team' => $team]);
    }

    /**
     * @inheritDoc
     */
    public function add(Pokemon $pokemon): void
    {
        $this->entity_manager->persist($pokemon);
        $this->entity_manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function remove(Pokemon $pokemon): void
    {
        $this->entity_manager->remove($pokemon);
        $this->entity_manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id): ?Pokemon
    {
        return $this->entity_manager->getRepository(Pokemon::class)->findOneby(['id' => $id]);
    }
}