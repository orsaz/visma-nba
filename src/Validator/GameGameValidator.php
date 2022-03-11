<?php declare(strict_types=1);

namespace App\Validator;

use App\VO\Game;

class GameGameValidator implements GameValidatorInterface
{
    public function validate(Game $game): bool
    {
        $isHomeTeamWinner = $game->getHomeTeamScore() > $game->getVisitorTeamScore();
        $isSameConference = $game->getHomeTeam()->getConference() === $game->getVisitorTeam()->getConference();

        return $isHomeTeamWinner && $isSameConference;
    }
}
