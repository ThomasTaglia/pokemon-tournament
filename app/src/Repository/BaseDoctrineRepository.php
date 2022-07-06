<?php


namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class BaseDoctrineRepository
 * @package App\Repository
 */
abstract class BaseDoctrineRepository
{
    protected EntityManagerInterface $entity_manager;

    /**
     * BaseDoctrineRepository constructor.
     *
     * @param EntityManagerInterface $entity_manager
     */
    public function __construct(EntityManagerInterface $entity_manager)
    {
        $this->entity_manager = $entity_manager;
    }
}