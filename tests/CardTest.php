<?php

/*
 * This file is part of the Poker package.
 *
 * (c) Matthew Collison <matthew@sixteenstudio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sixteenstudio\Poker;

class CardTest extends \PHPUnit_Framework_TestCase {

	/**
     * @covers            \Sixteenstudio\Poker\Card::setValue
     * @covers            \Sixteenstudio\Poker\Card::setSuit
     * @covers            \Sixteenstudio\Poker\Card::getValue
     * @covers            \Sixteenstudio\Poker\Card::getSuit
     * @covers            \Sixteenstudio\Poker\Card::isValidValue
     * @covers            \Sixteenstudio\Poker\Card::isValidSuit
     */
    public function testValidCardInstantiatesAndGetsCorrectValues()
    {
        $card = new Card();
        $card->setValue(5);
        $card->setSuit('Club');

        $this->assertEquals($card->getValue(), 5);
        $this->assertEquals($card->getSuit(), 'Club');
    }

    /**
     * @covers            \Sixteenstudio\Poker\Card::setValue
     * @covers            \Sixteenstudio\Poker\Card::isValidValue
     * @expectedException \Sixteenstudio\Poker\InvalidCardPropertyException
     */
    public function testInvalidValueDetected()
    {
        $card = new Card();
        $card->setValue(15);
        $card->setSuit('Club');
    }

    /**
     * @covers            \Sixteenstudio\Poker\Card::setSuit
     * @covers            \Sixteenstudio\Poker\Card::isValidSuit
     * @expectedException \Sixteenstudio\Poker\InvalidCardPropertyException
     */
    public function testInvalidSuitDetected()
    {
        $card = new Card();
        $card->setValue(9);
        $card->setSuit('Axe');
    }

}