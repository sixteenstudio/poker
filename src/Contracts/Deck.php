<?php namespace Sixteenstudio\Poker\Contracts;

/*
 * This file is part of the Poker package.
 *
 * (c) Matthew Collison <matthew@sixteenstudio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

interface Deck {

	public function __construct(array $cards = []);

    public static function newMerged(array $decks);
    /**
     * Returns the number of cards in this deck
     * 
     * @return integer
     */
    public function cardCount();
    /**
     * Shuffles the deck
     * 
     * @return void
     */
    public function shuffle();

    /**
     * Takes a card off the top of the deck
     * 
     * @return Sixteenstudio\Poker\Contracts\Card
     */
    public function takeCard();

    /**
     * Places a card at the top of the deck
     *
     * @param Sixteenstudio\Poker\Contracts\Card $card
     * @return void
     */
    public function addCard(Card $card);

    /**
     * Sets the collection of cards in this deck
     * 
     * @param array $cards
     * @return void
     */
    public function setCards(array $cards);

    /**
     * Retrieves the collection of cards in this deck
     * 
     * @return Sixteenstudio\Poker\Collection
     */
    public function getCards();

}
