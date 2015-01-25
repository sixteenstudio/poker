<?php namespace Sixteenstudio\Poker;

/*
 * This file is part of the Poker package.
 *
 * (c) Matthew Collison <matthew@sixteenstudio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class InvalidHandException extends Exception {}

class Hand extends Deck implements Hand {

    /**
     * The cards in this hand
     * 
     * @var Poker\Table\Collection
     */
    protected $cards;

    /**
     * The limit to the amount of cards that can
     * be held in this type of hand
     * 
     * @var integer
     */
    protected $cardLimit;

    public function __construct(array $cards = [])
    {
        parent::__construct($cards);
        $this->cardLimit = 2;
    }

    /**
     * Adds a card to this hand
     *
     * @param Poker\Table\Contracts\Card $card
     */
    public function addCard(Contracts\Card $card)
    {
        if ($this->cardLimit == $this->cardCount()) {
            throw new InvalidHandException("An attempt was made to add a card to a hand which had already hit it\'s legal limit of cards");
        }

        parent::addCard($card);
    }

}