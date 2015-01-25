<?php namespace Sixteenstudio\Poker\Contracts;

/*
 * This file is part of the Poker package.
 *
 * (c) Matthew Collison <matthew@sixteenstudio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

interface Card {

    /**
     * Initialize a card
     * 
     * @param string $suit
     * @param integer $value
     */
    public function __construct($suit = null, $value = null);

    /**
     * Returns a legible description of the card
     * suit and value
     * 
     * @return string
     */
    public function getDescription();

    /**
     * Returns the value of this card
     * 
     * @return integer
     */
    public function getValue();

    /**
     * Returns the value of this card in english form
     * 
     * @return integer
     */
    public function getValueWord();

    /**
     * Returns the suit of this card
     * 
     * @return string
     */
    public function getSuit();

    /**
     * Set the value of this card
     * 
     * @param integer $value
     */
    public function setValue($value);

    /**
     * Set the suit of this card
     * 
     * @param string $suit
     */
    public function setSuit($suit);

}
