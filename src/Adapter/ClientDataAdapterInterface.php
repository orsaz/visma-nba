<?php

namespace App\Adapter;

use App\VO\Game;
use App\VO\Player;
use App\VO\Team;

interface ClientDataAdapterInterface
{
    public function adaptGame(array $game, Team $homeTeam, Team $visitorTeam): Game;

    public function adaptTeam(array $team, array $players): Team;

    public function adaptPlayer(array $player): Player;
}
