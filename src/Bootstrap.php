<?php declare(strict_types=1);

namespace App;

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
        $command = new Command();

        switch ($commandName) {
            case 'teams':
                $command->teamsList($commandArguments);
                break;

            case 'help':
                $command->executeHelp();
                break;

            default:
                throw new InvalidCommandException('Such command does not exist: ' . $commandName);
        }
    }
}
