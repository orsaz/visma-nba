<?php

namespace AppTest\Provider\RapidApi;

use App\Adapter\RapidApiDataAdapter;
use App\Provider\RapidApi\RapidApiProvider;
use App\VO\Game;
use AppTest\Mocks\Client\ClientMock;
use PHPUnit\Framework\TestCase;

class RapidApiTeamsProviderTest extends TestCase
{

    public function testGetGames()
    {
        $apiProvider = new RapidApiProvider(
            new ClientMock(),
            new RapidApiDataAdapter()
        );

        $games = $apiProvider->getGames();
        /** @var Game $game */
        foreach ($games as $game) {
            $this->assertIsString($game->getStatus());
            $this->assertIsInt($game->getId());
            $this->assertIsInt($game->getHomeTeamScore());
            $this->assertIsInt($game->getVisitorTeamScore());
            $this->assertIsObject($game->getHomeTeam());
            $this->assertIsObject($game->getVisitorTeam());
        }
    }

    public function testGetTeamPlayers()
    {

    }
}
