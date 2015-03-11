<?php

namespace spec\Acme;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HandEvaluatorSpec extends ObjectBehavior
{

	public function it_returns_tie_with_ace_pair_vs_ace_pair()
	{
		$result = $this->evaluate('AA', 'AA');

		$result->shouldEqual('tie');
	}

	public function it_returns_ace_pair_wins_vs_kings_pair()
	{
		$result = $this->evaluate('AA', 'KK');

		$result->shouldEqual('player');
	}

	public function it_returns_player_wins_for_KA_vs_K9()
	{
		$result = $this->evaluate('KA', 'K9');

		$result->shouldEqual('player');
	}

	public function it_returns_opponent_win_for_K9_vs_9K()
	{
		$result = $this->evaluate('K9', '9K');

		$result->shouldEqual('tie');
	}

    public function it_returns_player_wins_for_22_vs_AK()
    {
        $result = $this->evaluate('22', 'AK');

        $result->shouldEqual('player');
    }

    public function it_returns_opponent_wins_for_AK_vs_33()
    {
        $result = $this->evaluate('AK', '33');

        $result->shouldEqual('opponent');
    }

    public function it_returns_player_wins_for_33_vs_44()
    {
        $result = $this->evaluate('33', '44');

        $result->shouldEqual('opponent');
    }

    public function it_returns_player_wins_for_AAJ_vs_AAQ()
    {
        $result = $this->evaluate('AAJ', 'AAQ');

        $result->shouldEqual('opponent');
    }

}
