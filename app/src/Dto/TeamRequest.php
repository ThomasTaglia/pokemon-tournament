<?php


namespace App\Dto;

/**
 * Class TeamRequest
 * @package App\Dto
 */
class TeamRequest
{
    /**
     * @var int|null
     */
    private ?int $id;

    /**
     * @var string|null
     */
    private ?string $name;

    /**
     * @var \DateTime|null
     */
    private ?\DateTime $creationDate;

    /**
     * TeamRequest constructor.
     * @param int|null $id
     * @param string|null $name
     * @param \DateTime|null $creationDate
     */
    public function __construct(?int $id, ?string $name, ?\DateTime $creationDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->creationDate = $creationDate;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }
}