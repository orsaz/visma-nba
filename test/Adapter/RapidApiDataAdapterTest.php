<?php declare(strict_types=1);

namespace AppTest\Adapter;

use App\Adapter\RapidApiDataAdapter;
use App\VO\Player;
use App\VO\Team;
use PHPUnit\Framework\TestCase;

class RapidApiDataAdapterTest extends TestCase
{

    /**
     * @dataProvider playerDataProvider
     */
    public function testAdaptPlayer(array $playerData)
    {
        $rapidApiDataAdapter = new RapidApiDataAdapter();
        $player = $rapidApiDataAdapter->adaptPlayer($playerData);
        $this->assertEquals((int) $playerData['id'], $player->getId());
        $this->assertEquals($playerData['height_feet'], $player->getHeightFeet());
        $this->assertEquals($playerData['weight_pounds'], $player->getWeightPounds());
        $this->assertEquals($playerData['first_name'], $player->getFirstName());
    }

    /**
     * @dataProvider teamDataProvider
     */
    public function testAdaptTeam(array $teamData)
    {
        $rapidApiDataAdapter = new RapidApiDataAdapter();
        $game = $rapidApiDataAdapter->adaptTeam($teamData, []);
        $this->assertEquals($teamData['id'], $game->getId());
        $this->assertEquals($teamData['name'], $game->getName());
    }

    /**
     * @dataProvider gameDataProvider
     */
    public function testAdaptGame(array $gameData)
    {
        $rapidApiDataAdapter = new RapidApiDataAdapter();
        $game = $rapidApiDataAdapter->adaptGame($gameData, $this->createTestTeam(), $this->createTestTeam());
        $this->assertEquals($gameData['id'], $game->getId());
        $this->assertEquals($gameData['date'], $game->getDate());
        $this->assertIsString($game->getHomeTeam()->getName());
        $this->assertIsString($game->getVisitorTeam()->getName());
        $this->assertIsArray($game->getHomeTeam()->getPlayers());
        $this->assertIsArray($game->getVisitorTeam()->getPlayers());
    }

    public function playerDataProvider()
    {
        return [
            'basic player info' => [
                'playerData' => [
                    "id" => 18677986,
                    "first_name" => "Trey",
                    "height_feet" => 1,
                    "height_inches" => 2,
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
                    "weight_pounds" => 3,
                ]
            ],
            'basic player info with null' => [
                'playerData' => [
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
                    "weight_pounds" => NULL,
                ]
            ]
        ];
    }

    public function gameDataProvider()
    {
        return [
            'full game data' => [
                'gameData' => [
                    "id" => 47179,
                    "date" => "2019-01-30T00:00:00.000Z",
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
            ]
        ];
    }

    public function teamDataProvider()
    {
        return [
            'full game data' => [
                'teamData' => [
                    "id" => 2,
                    "abbreviation" => "BOS",
                    "city" => "Boston",
                    "conference" => "East",
                    "division" => "Atlantic",
                    "full_name" => "Boston Celtics",
                    "name" => "Celtics",
                ]
            ]
        ];
    }

    private function createTestTeam(): Team
    {
        return new Team(
            1,
            'testAbbreviation',
            'testCity',
            'testConference',
            'testDivision',
            'testFullName',
            'testName',
            [
                new Player(
                    1,
                    'testFirstName',
                    'testLastName',
                    null,
                    null,
                    'testPosition',
                    null,
                )
            ]
        );
    }
}
