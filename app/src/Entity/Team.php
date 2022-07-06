<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Team
 * @package App\Entity
 * @ORM\Table(name="team")
 * @ORM\Entity
 */
class Team implements \Serializable
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
     * @var \DateTime
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private \DateTime $creationDate;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Team
     */
    public function setId(int $id): Team
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
     * @return Team
     */
    public function setName(string $name): Team
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     * @return Team
     */
    public function setCreationDate(\DateTime $creationDate): Team
    {
        $this->creationDate = $creationDate;
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
            'creationDate' => $this->getCreationDate()->format('Y-m-d H:i:s'),
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