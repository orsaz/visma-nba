<?php

namespace App\Api\Rapidapi\FreeNba;

use Generator;

interface FreeNbaClientInterface
{
    public function getTeams(): array;

    public function getGames(int $page = 0, int $perPage = 25, array $teamIds = [], string $date = '', array $seasons = []): array;

    public function getPlayers(int $page = 0, int $perPage = 25, array $search = []): array;
}
