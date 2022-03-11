<?php declare(strict_types=1);

namespace App\Provider\RapidApi;

use App\Adapter\ClientDataAdapterInterface;
use App\Api\Rapidapi\FreeNba\FreeNbaClientInterface;
use Generator;

class RapidApiProvider implements ClientTeamsProviderInterface
{
    private FreeNbaClientInterface $client;
    private ClientDataAdapterInterface $clientDataAdapter;

    public function __construct(FreeNbaClientInterface $client, ClientDataAdapterInterface $clientDataAdapter)
    {
        $this->client = $client;
        $this->clientDataAdapter = $clientDataAdapter;
    }

    public function getGames(int $page = 0, int $perPage = 25, array $teamIds = [], string $date = '', array $seasons = []): Generator
    {
        $games = $this->client->getGames($page, $perPage, $teamIds, $date, $seasons);
        foreach ($games['data'] as $game) {
            $teamPlayers = [];
            foreach ($this->getTeamPlayers($game['home_team']['name']) as $player) {
                $teamPlayers[] = $player;
            }
            $visitorPlayers = [];
            foreach ($this->getTeamPlayers($game['visitor_team']['name']) as $player) {
                $visitorPlayers[] = $player;
            }

            $homeTeam = $this->clientDataAdapter->adaptTeam(
                $game['home_team'],
                $teamPlayers
            );
            $visitorTeam = $this->clientDataAdapter->adaptTeam(
                $game['visitor_team'],
                $visitorPlayers
            );

            yield $this->clientDataAdapter->adaptGame($game, $homeTeam, $visitorTeam);
        }
    }

    public function getTeamPlayers(string $teamName, int $startPage = 0): Generator
    {
        $allPlayers = $this->client->getPlayers($startPage);
        foreach ($allPlayers['data'] as $player) {
            if ($player['team']['name'] !== $teamName) {
                continue;
            }

            yield $this->clientDataAdapter->adaptPlayer($player);
        }

        if ($allPlayers['meta']['next_page'] !== null) {
            return $this->getTeamPlayers($teamName, $allPlayers['meta']['next_page']);
        }
    }
}
