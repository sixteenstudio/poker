<?php namespace Sixteenstudio\Poker\Contracts;

interface Card {

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
