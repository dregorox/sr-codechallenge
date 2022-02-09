<?php
namespace App\Services;

class EvenTeamCountCalculator implements TeamCountCalculator
{
    public function calculate(int $numberOfPlayers, int $maxPlayers, int $minPlayers): int
    {
        $maxTeams = floor($numberOfPlayers / $minPlayers);
        $minTeams = floor($numberOfPlayers / $maxPlayers);

        if ($maxTeams <= 1) {
            throw new \Exception("There's not enough players to create more than one team");
        }

        $currentGuess = $maxTeams;
        // Yes I know, but it is easy to change to lets say that the number of teams must be a power of 2
        do {
            // if No. of teams is even
            if ($currentGuess % 2 == 0) {
                return $currentGuess;
            }
            $currentGuess--;
        } while ($currentGuess >= $minTeams);

        throw new \Exception('Could not calculate a number of teams, that is even and has between ' . $minPlayers . ' and ' . $maxPlayers . ' players');
    }
}
