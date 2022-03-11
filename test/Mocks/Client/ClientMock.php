<?php

namespace AppTest\Mocks\Client;

use App\Api\Rapidapi\FreeNba\FreeNbaClientInterface;

class ClientMock implements FreeNbaClientInterface
{

    public function getTeams(): array
    {
        // TODO =>  Implement getTeams() method.
    }

    public function getGames(int $page = 0, int $perPage = 25, array $teamIds = [], string $date = '', array $seasons = []): array
    {
        return [
            'data' => [
                [
                    "id" => 47179,
                    "date" => "2019-01-30T00 => 00 => 00.000Z",
                    "home_team" => [
                        "id" => 2,
                        "abbreviation" => "BOS",
                        "city" => "Boston",
                        "conference" => "East",
                        "division" => "Atlantic",
                        "full_name" => "Boston Celtics",
                        "name" => "Celtics",
                    ],
                    "home_team_score" => 126,
                    "period" => 4,
                    "postseason" => false,
                    "season" => 2018,
                    "status" => "Final",
                    "time" => " ",
                    "visitor_team" => [
                        "id" => 4,
                        "abbreviation" => "CHA",
                        "city" => "Charlotte",
                        "conference" => "East",
                        "division" => "Southeast",
                        "full_name" => "Charlotte Hornets",
                        "name" => "Hornets",
                    ],
                    "visitor_team_score" => 94
                ]
            ],
            'meta' => [
                "total_pages" => 1,
                "current_page" => 1,
                "next_page" => NULL,
                "per_page" => 25,
                "total_count" => 1,
            ]
        ];
    }

    public function getPlayers(int $page = 0, int $perPage = 25, array $search = []): array
    {
        return [
            'data' => [
                [
                    "id" => 18677986,
                    "first_name" => "Trey",
                    "height_feet" => NULL,
                    "height_inches" => NULL,
                    "last_name" => "Murphy III",
                    "position" => "F",
                    "team" => [
                        "id" => 19,
                        "abbreviation" => "NOP",
                        "city" => "New Orleans",
                        "conference" => "West",
                        "division" => "Southwest",
                        "full_name" => "New Orleans Pelicans",
                        "name" => "Pelicans",
                    ],
                    "weight_pounds" => NULL
                ]
            ],
            'meta' => [
                "total_pages" => 1,
                "current_page" => 1,
                "next_page" => NULL,
                "per_page" => 25,
                "total_count" => 1,
            ]
        ];
    }
}
