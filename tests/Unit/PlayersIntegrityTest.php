<?php

namespace Tests\Unit;

use App\Services\EvenTeamCountCalculator;
use App\User;
use Tests\TestCase;

class PlayersIntegrityTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGoaliePlayersExist()
    {
        /*
		Check there are players that have can_play_goalie set as 1
        */
        $result = User::where('user_type', 'player')->where('can_play_goalie', 1)->count();
        $this->assertTrue($result > 1);
    }
    public function testAtLeastOneGoaliePlayerPerTeam()
    {
        /*
	    calculate how many teams can be made so that there is an even number of teams and they each have between 18-22 players.
	    Then check that there are at least as many players who can play goalie as there are teams
        */
        $teamCountCalculator = new EvenTeamCountCalculator;
        $playerCount = User::where('user_type', 'player')->count();
        $goaliesCount = User::where('user_type', 'player')->where('can_play_goalie', 1)->count();
        $teamsQty = $teamCountCalculator->calculate($playerCount, 22, 18);

        $this->assertTrue($goaliesCount >= $teamsQty, "There's not enough goalies to fill all teams");
    }
}
