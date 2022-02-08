<?php

namespace App\Services;

use Illuminate\Support\Collection;

const MAX_TEAMPLAYERS = 22;
const MIN_TEAMPLAYERS = 18;

class TeamsGenerator
{
    /** @var TeamCountCalculator */
    private $teamCountCalculator;

    public function __construct(TeamCountCalculator $teamCountCalculator)
    {
        $this->teamCountCalculator = $teamCountCalculator;
    }

    public function generate(Collection $players) : Collection
    {
        // Calculate number of teams
        $teamsQty = $this->teamCountCalculator->calculate($players->count(), MAX_TEAMPLAYERS, MIN_TEAMPLAYERS);

        // Validate goalies
        $goalies = $players->filter(fn ($player) => $player->isGoalie);
        if ($goalies->count() < $teamsQty) {
            throw new \Exception("There's not enough goalies for all teams");
        }

        $players = $players->sortBy([['can_play_goalie', 'desc'], ['ranking', 'desc']]);
        // Create teams with goalies first
        $teams = new Collection();
        for ($i = 0; $i < $teamsQty; $i++) {
            $teams->push(new Collection([$players[$i]]));
            $players->forget($i); // Remove Goalie from the player list
        }

        // Sort players again, now without goalies and only by ranking
        $players = $players->sortBy([['ranking', 'desc']]);
        $players->each(function ($player, $idx) use ($teams) {
            $offset = intval(floor($idx / $teams->count())) + 1;
            $teamIdx = ($idx + $offset) % $teams->count();
            $teams[$teamIdx]->push($player);
        });

        return $teams;
    }
}
