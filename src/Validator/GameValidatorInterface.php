<?php

namespace App\Validator;

use App\VO\Game;

interface GameValidatorInterface
{
    public function validate(Game $game): bool;
}
