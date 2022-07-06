<?php


namespace App\Repository\interfaces;


use App\Entity\Team;

/**
 * Interface TeamRepository
 * @package App\Repository\interfaces
 */
interface TeamRepository
{
    /**
     * @param Team $team
     */
    public function add(Team $team): void;

    /**
     * @param Team $team
     */
    public function edit(Team $team): void;

    /**
     * @param Team $team
     */
    public function remove(Team $team): void;

    /**
     * @return Team[]|null
     */
    public function all(): ?array;

    /**
     * @param int $id
     * @return Team|null
     */
    public function getById(int $id): ?Team;
}