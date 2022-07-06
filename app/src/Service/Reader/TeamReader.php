<?php


namespace App\Service\Reader;


use App\Entity\Team;
use App\Exception\TeamNotFoundException;
use App\Repository\interfaces\TeamRepository;
use Psr\Log\LoggerInterface;

/**
 * Class TeamReader
 * @package App\Service\Reader
 */
class TeamReader
{
    private const TEAM_NOT_FOUND_MESSAGE = 'Team with id %s not found.';

    /**
     * @var TeamRepository
     */
    private TeamRepository $teamRepository;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * TeamWriter constructor.
     * @param TeamRepository $teamRepository
     * @param LoggerInterface $logger
     */
    public function __construct(TeamRepository $teamRepository, LoggerInterface $logger)
    {
        $this->teamRepository = $teamRepository;
        $this->logger = $logger;
    }

    /**
     * @param int $id
     * @return Team
     * @throws TeamNotFoundException
     */
    public function getTeamById(int $id): Team
    {
        $team = $this->teamRepository->getById($id);
        if (!$team) {
            $this->logger->error(sprintf(self::TEAM_NOT_FOUND_MESSAGE, $id));
            throw new TeamNotFoundException(sprintf(self::TEAM_NOT_FOUND_MESSAGE, $id));
        }
        return $team;
    }

    /**
     * @return array|null
     */
    public function getTeams(): ?array
    {
        return $this->teamRepository->all();
    }
}