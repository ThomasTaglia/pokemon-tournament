<?php


namespace App\Controller;


use App\Dto\TeamRequest;
use App\Exception\TeamCreationException;
use App\Exception\TeamDeleteException;
use App\Exception\TeamEditException;
use App\Exception\TeamNotFoundException;
use App\Service\Reader\TeamReader;
use App\Service\Writer\TeamWriter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TeamController
 * @package App\Controller
 * @Route("/api/team",name="api_")
 */
class TeamController extends AbstractController
{
    /**
     * @var TeamWriter
     */
    private TeamWriter $teamWriter;

    /**
     * @var TeamReader
     */
    private TeamReader $teamReader;

    /**
     * TeamController constructor.
     * @param TeamWriter $teamWriter
     * @param TeamReader $teamReader
     */
    public function __construct(TeamWriter $teamWriter, TeamReader $teamReader)
    {
        $this->teamWriter = $teamWriter;
        $this->teamReader = $teamReader;
    }

    /**
     * @param string $name
     * @return JsonResponse
     * @throws TeamCreationException
     * @Route("/create/{name}", methods={"POST"})
     */
    public function createTeam(string $name): JsonResponse
    {
        $teamRequest = new TeamRequest(null, $name, new \DateTime());
        return new JsonResponse($this->teamWriter->createTeam($teamRequest), Response::HTTP_CREATED);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @Route("/{id}", methods={"GET"})
     * @throws \Exception
     */
    public function getTeamById(int $id): JsonResponse
    {
        $team = $this->teamReader->getTeamById($id);
        return new JsonResponse(['team' => $team->serialize()]);
    }

    /**
     * @return JsonResponse
     * @Route("/", methods={"GET"})
     */
    public function getAllTeams(): JsonResponse
    {
        $teams = $this->teamReader->getTeams();
        $serializedTeams = [];
        foreach ($teams as $team) {
            $serializedTeams[] = $team->serialize();
        }

        return new JsonResponse(['teams' => $serializedTeams]);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     * @throws TeamEditException
     * @throws TeamNotFoundException
     * @Route("/{id}", methods={"PATCH"})
     */
    public function editTeam(int $id, Request $request): JsonResponse
    {
        $new_name = $request->get('name', null);
        $teamRequest = new TeamRequest($id, $new_name, null);
        return new JsonResponse(['message' => $this->teamWriter->editTeam($teamRequest)]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws TeamNotFoundException
     * @throws TeamDeleteException
     * @Route("/{id}", methods={"DELETE"})
     */
    public function deleteTeam(int $id): JsonResponse
    {
        return new JsonResponse(['message' => $this->teamWriter->deleteTeam($id)]);
    }
}