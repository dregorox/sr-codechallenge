<?php
namespace App\Services;

interface TeamCountCalculator
{
    public function calculate(int $numberOfPlayers, int $maxPlayers, int $minPlayers): int;
}
