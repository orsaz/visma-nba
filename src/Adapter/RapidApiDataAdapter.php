<?php declare(strict_types=1);

namespace App\Adapter;

use App\VO\Game;
use App\VO\Player;
use App\VO\Team;

class RapidApiDataAdapter implements ClientDataAdapterInterface
{
    public function adaptGame(array $game, Team $homeTeam, Team $visitorTeam): Game
    {
        return new Game(
            (int) $game['id'],
            (string) $game['date'],
            $homeTeam,
            $visitorTeam,
            (int) $game['home_team_score'],
            (int) $game['visitor_team_score'],
            (int) $game['period'],
            (bool) $game['postseason'],
            (int) $game['season'],
            (string) $game['status'],
            (string) $game['time']
        );
    }
    
    public function adaptTeam(array $team, array $players): Team
    {
        return new Team(
            (int) $team['id'],
            (string) $team['abbreviation'],
            (string) $team['city'],
            (string) $team['conference'],
            (string) $team['division'],
            (string) $team['full_name'],
            (string) $team['name'],
            $players
        );
    }

    public function adaptPlayer(array $player): Player
    {
        return new Player(
            (int) $player['id'],
            (string) $player['first_name'],
            (string) $player['last_name'],
            isset($player['height_feet']) ? (int) $player['height_feet'] : null,
            isset($player['height_inches']) ? (int) $player['height_inches'] : null,
            (string) $player['position'],
            isset($player['weight_pounds']) ? (int) $player['weight_pounds'] : null,
        );
    }
}
