<?php


namespace App\Service\Writer;


use App\Entity\Pokemon;
use App\Entity\Team;
use App\Exception\PokemonCreationException;
use App\Exception\PokemonDeleteException;
use App\Exception\PokemonNotFoundException;
use App\Repository\interfaces\PokemonRepository;
use App\Utility\PokeApiClient;
use Psr\Log\LoggerInterface;

class PokemonWriter
{
    private const POKEMON_CREATION_EXCEPTION_MESSAGE = 'Something went wrong while saving pokemon with id %s.';
    private const POKEMON_CREATION_OK_MESSAGE = 'Pokemon with name %s successfully saved.';
    private const POKEMON_DELETE_OK_MESSAGE = 'Pokemon with id %s successfully deleted.';
    private const POKEMON_DELETE_EXCEPTION_MESSAGE = 'Something went wrong while deleting pokemon with id %s.';
    private const POKEMON_NOT_FOUND_MESSAGE = 'Pokemon with id %s not found.';

    /**
     * @var PokemonRepository
     */
    private PokemonRepository $pokemonRepository;

    /**
     * @var PokeApiClient
     */
    private PokeApiClient $pokeApiClient;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * PokemonWriter constructor.
     * @param PokemonRepository $pokemonRepository
     * @param PokeApiClient $pokeApiClient
     * @param LoggerInterface $logger
     */
    public function __construct(PokemonRepository $pokemonRepository, PokeApiClient $pokeApiClient, LoggerInterface $logger)
    {
        $this->pokemonRepository = $pokemonRepository;
        $this->pokeApiClient = $pokeApiClient;
        $this->logger = $logger;
    }

    /**
     * @param Team $team
     * @return array
     * @throws PokemonCreationException
     * @throws \Exception
     */
    public function addToTeam(Team $team): array
    {
        $randomId = random_int(0, 905);
        try {
            $retrievedPokemon = $this->pokeApiClient->pokemon($randomId);
            $retrievedPokemonAbilities = $this->getPokemonAbilities($retrievedPokemon['abilities']);
            $retrievedPokemonTypes = $this->getPokemonTypes($retrievedPokemon['types']);
            $pokemon = new Pokemon();
            $pokemon->setName($retrievedPokemon['name'])
                ->setAbilities($retrievedPokemonAbilities)
                ->setTypes($retrievedPokemonTypes)
                ->setBaseExperience($retrievedPokemon['base_experience'])
                ->setImg($retrievedPokemon['sprites']['front_default'])
                ->setTeam($team);
            $this->pokemonRepository->add($pokemon);
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            throw new PokemonCreationException(sprintf(self::POKEMON_CREATION_EXCEPTION_MESSAGE, $randomId));
        }

        $this->logger->info(sprintf(self::POKEMON_CREATION_OK_MESSAGE, $pokemon->getName()));
        return ['message' => sprintf(self::POKEMON_CREATION_OK_MESSAGE, $pokemon->getName()), 'pokemon' => $pokemon->serialize()];
    }

    /**
     * @param array $abilities
     * @return array
     */
    private function getPokemonAbilities(array $abilities): array
    {
        $abilitiesNames = [];
        foreach ($abilities as $abilityOccurrence) {
            $abilitiesNames[] = $abilityOccurrence['ability']['name'];
        }
        return $abilitiesNames;
    }

    /**
     * @param array $types
     * @return array
     */
    private function getPokemonTypes(array $types): array
    {
        $typesNames = [];
        foreach ($types as $typeOccurrence) {
            $typesNames[] = $typeOccurrence['type']['name'];
        }
        return $typesNames;
    }

    /**
     * @param int $id
     * @return string
     * @throws PokemonDeleteException
     * @throws PokemonNotFoundException
     */
    public function deletePokemon(int $id): string
    {
        $pokemon = $this->pokemonRepository->getById($id);

        if (!$pokemon) {
            $this->logger->error(sprintf(self::POKEMON_NOT_FOUND_MESSAGE, $id));
            throw new PokemonNotFoundException(sprintf(self::POKEMON_NOT_FOUND_MESSAGE, $id));
        }

        try {
            $this->pokemonRepository->remove($pokemon);
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            throw new PokemonDeleteException(sprintf(self::POKEMON_DELETE_EXCEPTION_MESSAGE, $id));
        }

        $this->logger->info(sprintf(self::POKEMON_DELETE_OK_MESSAGE, $id));
        return sprintf(self::POKEMON_DELETE_OK_MESSAGE, $id);
    }
}