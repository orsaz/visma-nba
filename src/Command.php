<?php declare(strict_types=1);

namespace App;

class Command
{
    public function executeHelp(): void
    {
        $printer = new Printer();
        $name = 'teams <team-keyword>';
        $description = 'List NBA teams';

        $printer->writeLn('Command: ' . $name);
        $printer->writeLn(str_pad(' ', 4) . $description);
        $printer->writeLn('');
    }

    public function teamsList(array $arguments): void
    {
        $printer = new Printer();
        $rapidApi = new RapidApiClient();

        $teams = $rapidApi->getTeams();
        $filter = $arguments[0] ?? null;

        foreach ($teams['data'] as $team) {
            if ($filter !== null && (stristr($team['full_name'], $filter) || stristr($team['city'], $filter))) {
                $printer->writeLn('Team name: ' . $team['full_name'] . ' from ' . $team['city']);
            }
        }
    }
}
