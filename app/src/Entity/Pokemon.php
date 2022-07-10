<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Pokemon
 * @package App\Entity
 * @ORM\Table(name="pokemon")
 * @ORM\Entity
 */
class Pokemon implements \Serializable
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @var string
     * @ORM\Column(type="string",length=100)
     * @Assert\NotBlank()
     */
    private string $name;

    /**
     * @var int
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private int $baseExperience;

    /**
     * @var string
     * @ORM\Column(type="string",length=100)
     * @Assert\NotBlank()
     */
    private string $img;

    /**
     * @var array
     * @ORM\Column(type="array")
     * @Assert\NotBlank()
     */
    private array $abilities;

    /**
     * @var array
     * @ORM\Column(type="array")
     * @Assert\NotBlank()
     */
    private array $types;

    /**
     * @var Team
     * @ORM\ManyToOne(targetEntity="App\Entity\Team")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private Team $team;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Pokemon
     */
    public function setId(int $id): Pokemon
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Pokemon
     */
    public function setName(string $name): Pokemon
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getBaseExperience(): int
    {
        return $this->baseExperience;
    }

    /**
     * @param int $baseExperience
     * @return Pokemon
     */
    public function setBaseExperience(int $baseExperience): Pokemon
    {
        $this->baseExperience = $baseExperience;
        return $this;
    }

    /**
     * @return string
     */
    public function getImg(): string
    {
        return $this->img;
    }

    /**
     * @param string $img
     * @return Pokemon
     */
    public function setImg(string $img): Pokemon
    {
        $this->img = $img;
        return $this;
    }

    /**
     * @return array
     */
    public function getAbilities(): array
    {
        return $this->abilities;
    }

    /**
     * @param array $abilities
     * @return Pokemon
     */
    public function setAbilities(array $abilities): Pokemon
    {
        $this->abilities = $abilities;
        return $this;
    }

    /**
     * @return array
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    /**
     * @param array $types
     * @return Pokemon
     */
    public function setTypes(array $types): Pokemon
    {
        $this->types = $types;
        return $this;
    }

    /**
     * @return Team
     */
    public function getTeam(): Team
    {
        return $this->team;
    }

    /**
     * @param Team $team
     * @return Pokemon
     */
    public function setTeam(Team $team): Pokemon
    {
        $this->team = $team;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function serialize(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'baseExperience' => $this->getBaseExperience(),
            'img' => $this->getImg(),
            'abilities' => $this->getAbilities(),
            'types' => $this->getTypes(),
            'team' => $this->getTeam()->serialize()
        ];
    }

    /**
     * @inheritDoc
     */
    public function unserialize($data)
    {
        // TODO: Implement unserialize() method.
    }
}