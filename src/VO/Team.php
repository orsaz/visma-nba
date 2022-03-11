<?php declare(strict_types=1);

namespace App\VO;

class Team
{
    private int $id;
    private string $abbreviation;
    private string $city;
    private string $conference;
    private string $division;
    private string $fullName;
    private string $name;

    /**
     * @var Player[]
     */
    private array $players;

    public function __construct(
        int $id,
        string $abbreviation,
        string $city,
        string $conference,
        string $division,
        string $fullName,
        string $name,
        array $players
    )
    {
        $this->id = $id;
        $this->abbreviation = $abbreviation;
        $this->city = $city;
        $this->conference = $conference;
        $this->division = $division;
        $this->fullName = $fullName;
        $this->name = $name;
        $this->players = $players;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAbbreviation(): string
    {
        return $this->abbreviation;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getConference(): string
    {
        return $this->conference;
    }

    public function getDivision(): string
    {
        return $this->division;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPlayers(): array
    {
        return $this->players;
    }
}
