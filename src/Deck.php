<?php namespace Sixteenstudio\Poker;

/*
 * This file is part of the Poker package.
 *
 * (c) Matthew Collison <matthew@sixteenstudio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Deck {

    /**
     * The collection of cards within this deck
     * 
     * @var Sixteenstudio\Poker\Collection
     */
    protected $cards;

    public function __construct(array $cards = [])
    {
        $this->setCards($cards);
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
     * Takes a card off the top of the deck
     * 
     * @return Sixteenstudio\Poker\Contracts\Card
     */
    public function takeCard()
    {
        return $this->cards->shift();
    }

    /**
     * Places a card at the top of the deck
     *
     * @param  Sixteenstudio\Poker\Contracts\Card $card
     * @return void
     */
    public function addCard(Contracts\Card $card)
    {
        $this->cards->prepend($card);
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
     * @return Sixteenstudio\Poker\Collection
     */
    public function getCards()
    {
        return $this->cards;
    }

}