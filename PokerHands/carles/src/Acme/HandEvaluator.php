<?php

namespace Acme;

class Card
{
	protected $card_number, $value;

	public function __construct($card_number, $value)
	{
		$this->card_number = $card_number;
		$this->value = $value;
	}

	public function equals(Card $other_card)
	{
		return $this->card_number == $other_card->card_number;
	}

	public function greaterThan(Card $other_card)
	{
		return $this->value > $other_card->value;
	}
}

class HandFactory
{

	public static function create($hand)
	{
        $values = array(
            '2' => 2,
            '3' => 3,
            '4' => 4,
            '5' => 5,
            '6' => 6,
            '7' => 7,
            '8' => 8,
            '9' => 9,
            'T' => 10,
            'J' => 11,
            'Q' => 12,
            'K' => 13,
            'A' => 14
        );

		$cards = array();
		for ($i=0; $i<strlen($hand); $i++) {
			$card_number = $hand[$i];

			$cards[] = new Card($card_number, $values[$card_number]);
		}

		return new Hand($cards);
	}
}

class Hand
{
	private $cards, $type;

    const HIGHCARD = 1;
    const PAIR = 2;

	public function __construct(array $cards)
	{
		$this->cards = $cards;
		$this->sortCards();
        $this->type = $this->evaluate();
	}

    private function evaluate()
    {
        if ($this->cards[0]->equals($this->cards[1])) return self::PAIR;
        return self::HIGHCARD;
    }

	public function equals(Hand $other_hand)
	{
        for ($i=0; $i < count($this->cards); $i++) {
            if (!$this->cards[$i]->equals($other_hand->cards[$i])) {
                return false;
            }
        }
        return true;
	}

	public function greaterThan(Hand $other_hand)
	{
        if ($this->type > $other_hand->type) {
            return true;
        } elseif ($this->type < $other_hand->type) {
            return false;
        }

		if ($this->cards[0]->equals($other_hand->cards[0])) {
		  return $this->cards[1]->greaterThan($other_hand->cards[1]);
		}
		return $this->cards[0]->greaterThan($other_hand->cards[0]);
	}

	private function sortCards()
	{
		usort($this->cards, function($first, $second) {
			if ($first->equals($second)) {
				return 0;
			}
			if ($first->greaterThan($second)) {
				return -1;
			}
			return 1;
		});
	}
}

class HandEvaluator
{

    public function evaluate($player_hand, $opponent_hand)
    {
		$player_hand_object = HandFactory::create($player_hand);
		$opponent_hand_object = HandFactory::create($opponent_hand);

		if ($player_hand_object->equals($opponent_hand_object)) {
			return 'tie';
		}

		if ($player_hand_object->greaterThan($opponent_hand_object)) {
			return 'player';
		}

		return 'opponent';
	}
}
