<?php namespace Poker\Table;

/****
 * NOTE TO SELF:
 ****/
// I keep thinking that I need to somehow check all possibilities of 5 card
// hands to actually make a handstrength, but I should be able to check for
// pairs, trips, full houses, flushes etc within all 7 cards. This should not
// be an issue. A game where probability has to come into play is in omaha,
// but not hold'em. Basically, save that complicated stuff for Omaha!

class HandStrength extends Deck {

	/**
	 * The hand that this hand strength is bound to
	 * 
	 * @var [type]
	 */
	protected $hand;

	protected $hands = ['Pair', 'Two Pair', 'Trips', 'Straight', 'Flush', 'Full House', 'Quads', 'Straight Flush'];

	/**
	 * Returns the cards based on the strongest
	 * hand that can be made with the cards
	 * available
	 * 
	 * @return Poker\Table\Deck
	 */
	public function getHandCards()
	{
		$cards = $this->getCards();

		$this->calculateHandStrength();
	}

	/**
	 * Initializes this HandStrength instance by calculating,
	 * depending on the cards provided, the strength of the
	 * hand and placing it onto the object to be evaluated
	 * by other methods that require it
	 * 
	 * @return void
	 */
	public function calculateHandStrength()
	{

	}

	public function getDescription()
	{
		return $this->getHandType() . ' ' . $this->getKicker() ' Kicker';
	}

	public function getHandDescription()
	{
		$this->getHandType()
		{

		}	
	}

}