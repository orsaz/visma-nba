<?php declare(strict_types=1);

namespace App\VO;

class Player
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private ?int $heightFeet;
    private ?int $heightInches;
    private string $position;
    private ?int $weightPounds;

    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        ?int $heightFeet,
        ?int $heightInches,
        string $position,
        ?int $weightPounds
    )
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->heightFeet = $heightFeet;
        $this->heightInches = $heightInches;
        $this->position = $position;
        $this->weightPounds = $weightPounds;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getHeightFeet(): ?int
    {
        return $this->heightFeet;
    }

    public function getHeightInches(): ?int
    {
        return $this->heightInches;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function getWeightPounds(): ?int
    {
        return $this->weightPounds;
    }
}
