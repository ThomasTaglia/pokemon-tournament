<?php


namespace App\Controller;


use App\Exception\PokemonDeleteException;
use App\Exception\PokemonNotFoundException;
use App\Exception\TeamNotFoundException;
use App\Service\Reader\PokemonReader;
use App\Service\Reader\TeamReader;
use App\Service\Writer\PokemonWriter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PokemonController
 * @package App\Controller
 * @Route("/api/pokemon",name="api_")
 */
class PokemonController extends AbstractController
{
    /**
     * @var TeamReader
     */
    private TeamReader $teamReader;

    /**
     * @var PokemonWriter
     */
    private PokemonWriter $pokemonWriter;

    /**
     * @var PokemonReader
     */
    private PokemonReader $pokemonReader;

    /**
     * PokemonController constructor.
     * @param TeamReader $teamReader
     * @param PokemonWriter $pokemonWriter
     * @param PokemonReader $pokemonReader
     */
    public function __construct(TeamReader $teamReader, PokemonWriter $pokemonWriter, PokemonReader $pokemonReader)
    {
        $this->teamReader = $teamReader;
        $this->pokemonWriter = $pokemonWriter;
        $this->pokemonReader = $pokemonReader;
    }

    /**
     * @param int $teamId
     * @return JsonResponse
     * @throws TeamNotFoundException
     * @throws \Exception
     * @Route("/{teamId}", methods={"POST"})
     */
    public function addPokemonToTeam(int $teamId): JsonResponse
    {
        $team = $this->teamReader->getTeamById($teamId);
        return new JsonResponse($this->pokemonWriter->addToTeam($team), Response::HTTP_CREATED);
    }

    /**
     * @param int $teamId
     * @return JsonResponse
     * @throws TeamNotFoundException
     * @throws \Exception
     * @Route("/{teamId}", methods={"GET"})
     */
    public function getPokemonListByTeam(int $teamId): JsonResponse
    {
        $team = $this->teamReader->getTeamById($teamId);
        $pokemonList = $this->pokemonReader->getPokemonListByTeam($team);
        $serializedPokemonList = [];
        foreach ($pokemonList as $pokemon) {
            $serializedPokemonList[] = $pokemon->serialize();
        }
        return new JsonResponse(['pokemonList' => $serializedPokemonList]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws PokemonDeleteException
     * @throws PokemonNotFoundException
     * @Route("/{id}", methods={"DELETE"})
     */
    public function deletePokemon(int $id): JsonResponse
    {
        return new JsonResponse(['message' => $this->pokemonWriter->deletePokemon($id)]);
    }
}