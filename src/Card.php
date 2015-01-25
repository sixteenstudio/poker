<?php namespace Sixteenstudio\Poker;

/*
 * This file is part of the Poker package.
 *
 * (c) Matthew Collison <matthew@sixteenstudio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
        13 => 'King',
        14 => 'Ace'
    ];

    protected $cardSuits = [
        'Club',
        'Spade',
        'Diamond',
        'Heart'
    ];

    /**
     * Initialize a card
     * 
     * @param string $suit
     * @param integer $value
     */
    public function __construct($suit = null, $value = null)
    {
        if ( ! is_null($suit)) {
            $this->setSuit($suit);
        }

        if ( ! is_null($value)) {
            $this->setValue($value);
        }
    }

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

    /**
     * Returns the value of this card
     * 
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns the value of this card in english form
     * 
     * @return integer
     */
    public function getValueWord()
    {
        return $this->cardValues[$this->value];
    }

    /**
     * Returns the suit of this card
     * 
     * @return string
     */
    public function getSuit()
    {
        return $this->suit;
    }

    /**
     * Set the value of this card
     * 
     * @param integer $value
     */
    public function setValue($value)
    {
        if ( ! $this->isValidValue($value)) {
            throw new InvalidCardPropertyException("An invalid value was set for a card: $value");
        }

        $this->value = $value;
    }

    /**
     * Set the suit of this card
     * 
     * @param string $suit
     */
    public function setSuit($suit)
    {
        if ( ! $this->isValidSuit($suit)) {
            throw new InvalidCardPropertyException("An invalid suit was set for a card: $suit");
        }

        $this->suit = $suit;
    }

    /**
     * Checks if the provided value is valid
     * 
     * @param  integer  $value
     * @return boolean
     */
    protected function isValidValue($value)
    {
        return array_key_exists($value, $this->cardValues);
    }

    /**
     * Checks if the provided suit is valid
     * 
     * @param  string  $suit
     * @return boolean
     */
    protected function isValidSuit($suit)
    {
        return in_array($suit, $this->cardSuits);
    }

}
