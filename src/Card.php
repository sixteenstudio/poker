<?php namespace Sixteenstudio\Poker;

class InvalidCardPropertyException extends \Exception {}

class Card implements Contracts\Card {

	/**
	 * The value of the card
	 * 
	 * @var integer
	 */
	protected $value;

	/**
	 * The suit of the card
	 * 
	 * @var string
	 */
	protected $suit;

	protected $cardValues = [
		1 => 'Ace',
		2 => 'Two',
		3 => 'Three',
		4 => 'Four',
		5 => 'Five',
		6 => 'Six',
		7 => 'Seven',
		8 => 'Eight',
		9 => 'Nine',
		10 => 'Ten',
		11 => 'Jack',
		12 => 'Queen',
		13 => 'King'
	];

	protected $cardSuits = [
		'Club',
		'Spade',
		'Diamond',
		'Heart'
	];

	/**
	 * Returns a legible description of the card
	 * suit and value
	 * 
	 * @return string
	 */
	public function getDescription()
	{
		return $this->cardValues[$this->getValue()] . ' of ' . $this->getSuit() . 's';
	}

	public function getValue()
	{
		return $this->value;
	}

	public function getSuit()
	{
		return $this->suit;
	}

	public function setValue($value)
	{
		if ( ! $this->isValidValue($value)) {
			throw new InvalidCardPropertyException("An invalid value was set for a card: $value");
		}

		$this->value = $value;
	}

	public function setSuit($suit)
	{
		if ( ! $this->isValidSuit($suit)) {
			throw new InvalidCardPropertyException("An invalid suit was set for a card: $suit");
		}

		$this->suit = $suit;
	}

	protected function isValidValue($value)
	{
		return array_key_exists($value, $this->cardValues);
	}

	protected function isValidSuit($suit)
	{
		return in_array($suit, $this->cardSuits);
	}

}
