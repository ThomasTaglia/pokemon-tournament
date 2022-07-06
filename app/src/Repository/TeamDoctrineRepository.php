<?php


namespace App\Repository;


use App\Entity\Team;
use App\Repository\interfaces\TeamRepository;

/**
 * Class TeamDoctrineRepository
 * @package App\Repository
 */
class TeamDoctrineRepository extends BaseDoctrineRepository implements TeamRepository
{

    /**
     * @inheritDoc
     */
    public function add(Team $team): void
    {
        $this->entity_manager->persist($team);
        $this->entity_manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function edit(Team $team): void
    {
        $this->entity_manager->refresh($team);
        $this->entity_manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function remove(Team $team): void
    {
        $this->entity_manager->remove($team);
        $this->entity_manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function all(): ?array
    {
        return $this->entity_manager->createQueryBuilder()
                                    ->select('t')
                                    ->from(Team::class, 't')
                                    ->orderBy('t.creationDate', 'DESC')
                                    ->getQuery()
                                    ->enableResultCache()
                                    ->execute();
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id): ?Team
    {
        return $this->entity_manager->getRepository(Team::class)->findOneBy(['id' => $id]);
    }
}