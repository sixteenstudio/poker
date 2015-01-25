<?php namespace Sixteenstudio\Poker\Contracts;

/*
 * This file is part of the Poker package.
 *
 * (c) Matthew Collison <matthew@sixteenstudio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

interface Player {

	/**
	 * Returns the name of this player
	 * 
	 * @return string
	 */
	public function getName();

	/**
	 * Sets the name of this player
	 *
	 * @param string $name
	 */
	public function setName();

	/**
	 * Gets the player's current hand
	 * 
	 * @return Sixteenstudio\Poker\Contracts\Hand
	 */
	public function getHand();

	/**
	 * Sets the player's current hand
	 * 
	 * @param Sixteenstudio\Poker\Contracts\Hand $hand
	 */
	public function setHand(Hand $hand);

	/**
	 * Removes all cards from the player's current hand
	 */
	public function emptyHand();

	/**
	 * Adds a card to the player's current hand
	 * 
	 * @param Sixteenstudio\Poker\Contracts\Cand $card
	 */
	public function giveCard(Card $card);

}