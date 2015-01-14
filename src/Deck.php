<?php namespace Sixteenstudio\Poker;

use Collection;

class Deck {

	/**
	 * The collection of cards within this deck
	 * 
	 * @var Poker\Table\Collection
	 */
	protected $cards;

	public function __construct(array $cards = [])
	{
		$this->cards = new Collection($cards);
	}

	public static function newMerged(array $decks)
	{
		$merged = new Collection;

		foreach ($decks as $deck) {
			$merged->merge($deck);
		}

		return new static($merged);
	}

	/**
	 * Returns the number of cards in this deck
	 * 
	 * @return integer
	 */
	public function cardCount()
	{
		return $this->cards->count();
	}

	/**
	 * Shuffles the deck
	 * 
	 * @return void
	 */
	public function shuffle()
	{
		$this->cards->shuffle();
	}

	/**
	 * Takes a card off the top of the pile
	 * 
	 * @return Poker\Table\Contracts\Card
	 */
	public function takeCard()
	{
		return $this->cards->shift();
	}

	/**
	 * Places a card into the deck
	 *
	 * @return void
	 */
	public function addCard(Contracts\Card $card)
	{
		$this->cards->add($card);
	}

	/**
	 * Sets the collection of cards in this deck
	 * 
	 * @param array $cards
	 * @return void
	 */
	public function setCards(array $cards)
	{
		$this->cards = new Collection($cards);
	}

	/**
	 * Retrieves the collection of cards in this deck
	 * 
	 * @return Poker\Table\Collection
	 */
	public function getCards()
	{
		return $this->cards;
	}

}