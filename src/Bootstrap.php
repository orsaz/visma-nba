<?php declare(strict_types=1);

namespace App;

use App\Adapter\RapidApiDataAdapter;
use App\Api\Rapidapi\FreeNba\Client;
use App\Command\NbaCommand;
use App\Exceptions\InvalidCommandException;
use App\Provider\RapidApi\RapidApiProvider;
use App\Validator\GameGameValidator;

class Bootstrap
{
    public function __invoke(array $arguments): void
    {
        array_shift($arguments);

        if (!isset($arguments[0])) {
            throw new InvalidCommandException('No command specified');
        }

        $command = $arguments[0];
        $commandArguments = array_slice($arguments, 1);

        $this->runCommand($command, $commandArguments);
    }

    private function runCommand(mixed $commandName, array $commandArguments): void
    {
        $command = new NbaCommand(
            new Printer(),
            new GameGameValidator(),
            new RapidApiProvider(
                new Client(),
                new RapidApiDataAdapter()
            )
        );

        switch ($commandName) {
            case 'teams':
                $command->teamsList($commandArguments);
                break;
            case 'games':
                $command->gamesList($commandArguments);
                break;
            case 'help':
                $command->executeHelp();
                break;

            default:
                throw new InvalidCommandException('Such command does not exist: ' . $commandName);
        }
    }
}
