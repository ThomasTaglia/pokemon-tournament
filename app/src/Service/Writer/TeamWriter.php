<?php


namespace App\Service\Writer;


use App\Dto\TeamRequest;
use App\Entity\Team;
use App\Exception\TeamCreationException;
use App\Exception\TeamDeleteException;
use App\Exception\TeamEditException;
use App\Exception\TeamNotFoundException;
use App\Repository\interfaces\TeamRepository;
use Psr\Log\LoggerInterface;

/**
 * Class TeamWriter
 * @package App\Service\Writer
 */
class TeamWriter
{
    private const TEAM_NAME_NOT_PROVIDED_MESSAGE = "Team name not provided.";
    private const TEAM_CREATION_EXCEPTION_MESSAGE = "Something went wrong while creating team with name %s.";
    private const TEAM_EDIT_EXCEPTION_MESSAGE = "Something went wrong while editing team with id %s.";
    private const TEAM_CREATION_OK_MESSAGE = "Team %s successfully created.";
    private const TEAM_EDIT_OK_MESSAGE = "Team with id %s successfully edited.";
    private const TEAM_EDIT_INVALID_PARAMETER = "Provided unexpected value for %s parameter.";
    private const TEAM_NOT_FOUND_MESSAGE = "Team with id %s not found.";
    private const TEAM_DELETE_EXCEPTION_MESSAGE = "Something went wrong while deleting team with id %s.";
    private const TEAM_DELETE_OK_MESSAGE = "Team with id %s successfully deleted.";

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
     * @param TeamRequest $teamRequest
     * @return array
     * @throws TeamCreationException
     */
    public function createTeam(TeamRequest $teamRequest): array
    {
        if (!$teamRequest->getName()) {
            $this->logger->error(self::TEAM_NAME_NOT_PROVIDED_MESSAGE);
            throw new TeamCreationException(self::TEAM_NAME_NOT_PROVIDED_MESSAGE);
        }

        $team = new Team();
        $team->setName($teamRequest->getName())->setCreationDate($teamRequest->getCreationDate());

        try {
            $this->teamRepository->add($team);
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            throw new TeamCreationException(sprintf(self::TEAM_CREATION_EXCEPTION_MESSAGE, $teamRequest->getName()));
        }

        $this->logger->info(sprintf(self::TEAM_CREATION_OK_MESSAGE, $teamRequest->getName()));
        return ['message' => sprintf(self::TEAM_CREATION_OK_MESSAGE, $teamRequest->getName()), "team" => $team->serialize()];
    }

    /**
     * @param TeamRequest $teamRequest
     * @return string
     * @throws TeamNotFoundException|TeamEditException
     */
    public function editTeam(TeamRequest $teamRequest): string
    {
        $team = $this->teamRepository->getById($teamRequest->getId());
        if (!$team) {
            $this->logger->error(sprintf(self::TEAM_NOT_FOUND_MESSAGE, $teamRequest->getId()));
            throw new TeamNotFoundException(sprintf(self::TEAM_NOT_FOUND_MESSAGE, $teamRequest->getId()));
        }

        if (!$teamRequest->getName()) {
            $this->logger->error(sprintf(self::TEAM_EDIT_INVALID_PARAMETER, 'name'));
            throw new TeamEditException(sprintf(self::TEAM_EDIT_INVALID_PARAMETER, 'name'));
        }

        $team->setName($teamRequest->getName());
        try {
            $this->teamRepository->edit($team);
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            throw new TeamEditException(sprintf(self::TEAM_EDIT_EXCEPTION_MESSAGE, $team->getId()));
        }

        $this->logger->info(sprintf(self::TEAM_EDIT_OK_MESSAGE, $team->getId()));
        return sprintf(self::TEAM_EDIT_OK_MESSAGE, $team->getId());
    }

    /**
     * @param int $id
     * @return string
     * @throws TeamDeleteException
     * @throws TeamNotFoundException
     */
    public function deleteTeam(int $id): string
    {
        $team = $this->teamRepository->getById($id);
        if (!$team) {
            $this->logger->error(sprintf(self::TEAM_NOT_FOUND_MESSAGE, $id));
            throw new TeamNotFoundException(sprintf(self::TEAM_NOT_FOUND_MESSAGE, $id));
        }

        try {
            $this->teamRepository->remove($team);
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            throw new TeamDeleteException(sprintf(self::TEAM_DELETE_EXCEPTION_MESSAGE, $id));
        }

        $this->logger->info(sprintf(self::TEAM_DELETE_OK_MESSAGE, $id));
        return sprintf(self::TEAM_DELETE_OK_MESSAGE, $id);
    }
}