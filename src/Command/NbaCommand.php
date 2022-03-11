<?php declare(strict_types=1);

namespace App\Command;

use App\Api\Rapidapi\FreeNba\Client;
use App\Printer;
use App\Provider\RapidApi\ClientTeamsProviderInterface;
use App\Validator\GameValidatorInterface;
use App\VO\Game;

class NbaCommand
{
    private Printer $printer;
    private GameValidatorInterface $gameValidator;
    private ClientTeamsProviderInterface $clientTeamsProvider;

    public function __construct(
        Printer $printer,
        GameValidatorInterface $gameValidator,
        ClientTeamsProviderInterface $clientTeamsProvider,
    )
    {
        $this->printer = $printer;
        $this->gameValidator = $gameValidator;
        $this->clientTeamsProvider = $clientTeamsProvider;
    }

    public function executeHelp(): void
    {
        $this->printer = new Printer();
        $name = 'teams <team-keyword>';
        $description = 'List NBA teams';

        $this->printer->writeLn('Command: ' . $name);
        $this->printer->writeLn(str_pad(' ', 4) . $description);
        $this->printer->writeLn('');
    }

    public function teamsList(array $arguments): void
    {
        $rapidApi = new Client();

        $teams = $rapidApi->getTeams();
        $filter = $arguments[0] ?? null;

        foreach ($teams['data'] as $team) {
            if ($filter !== null && (stristr($team['full_name'], $filter) || stristr($team['city'], $filter))) {
                $this->printer->writeLn('Team name: ' . $team['full_name'] . ' from ' . $team['city']);
            }
        }
    }

    public function gamesList(array $arguments): void
    {
        $date = $arguments[0] ?? null;
        $games = $this->clientTeamsProvider->getGames(0, 25, [], $date);

        /** @var Game $game */
        foreach ($games as $game) {
            if ($this->gameValidator->validate($game)) {
                $this->printer->writeLn('############################');
                $this->printer->writeLn('Home team name: ' . $game->getHomeTeam()->getName());
                $this->printer->writeLn('Visitor team name: ' . $game->getVisitorTeam()->getName());
                $this->printer->writeLn('score: ' . $game->getHomeTeamScore() . ' - ' . $game->getVisitorTeamScore());
                $this->printer->writeLn('############################');

                $this->printer->writeLn('Home team players:');
                $playerCount = 0;
                foreach ($game->getHomeTeam()->getPlayers() as $player) {
                    $playerCount++;
                    $this->printer->writeLn("{$playerCount}. {$player->getFirstName()} {$player->getLastName()}");
                }
                $this->printer->writeLn('############################');
                $this->printer->writeLn('Visitor team players:');
                $playerCount = 0;
                foreach ($game->getVisitorTeam()->getPlayers() as $player) {
                    $playerCount++;
                    $this->printer->writeLn("{$playerCount}. {$player->getFirstName()} {$player->getLastName()}");
                }
                $this->printer->writeLn('');
            }
        }
    }
}
