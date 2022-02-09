<?php

namespace App\Http\Controllers;

use App\User;
use App\Services\TeamsGenerator;
use Illuminate\Support\Collection;

class TournamentController extends Controller
{
    public function create(TeamsGenerator $teamsBuilder, \Faker\Generator $faker)
    {
        /** @var Collection */
        $players =  User::ofPlayers()->get();

        return response()->json([
            'teams' => $teamsBuilder->generate($players)
                ->map(fn ($team) => [
                    'name' => $faker->streetName,
                    'ranking' => $team->sum('ranking'),
                    'players' => $team,
                ])
        ]);
    }
}
