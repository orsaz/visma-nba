<?php declare(strict_types=1);

namespace App\VO;

class Game
{
    private int $id;
    private string $date;
    private Team $homeTeam;
    private Team $visitorTeam;
    private int $homeTeamScore;
    private int $visitorTeamScore;
    private int $period;
    private bool $postSeason;
    private int $season;
    private string $status;
    private string $time;

    public function __construct(
        int $id,
        string $date,
        Team $homeTeam,
        Team $visitorTeam,
        int $homeTeamScore,
        int $visitorTeamScore,
        int $period,
        bool $postSeason,
        int $season,
        string $status,
        string $time
    )
    {
        $this->id = $id;
        $this->date = $date;
        $this->homeTeam = $homeTeam;
        $this->visitorTeam = $visitorTeam;
        $this->homeTeamScore = $homeTeamScore;
        $this->visitorTeamScore = $visitorTeamScore;
        $this->period = $period;
        $this->postSeason = $postSeason;
        $this->season = $season;
        $this->status = $status;
        $this->time = $time;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getHomeTeam(): Team
    {
        return $this->homeTeam;
    }

    public function getVisitorTeam(): Team
    {
        return $this->visitorTeam;
    }

    public function getHomeTeamScore(): int
    {
        return $this->homeTeamScore;
    }

    public function getVisitorTeamScore(): int
    {
        return $this->visitorTeamScore;
    }

    public function getPeriod(): int
    {
        return $this->period;
    }

    public function isPostSeason(): bool
    {
        return $this->postSeason;
    }

    public function getSeason(): int
    {
        return $this->season;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getTime(): string
    {
        return $this->time;
    }
}
