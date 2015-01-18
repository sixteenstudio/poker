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

class HandStrengthTest extends \PHPUnit_Framework_TestCase {

    /**
     * @uses              \Sixteenstudio\Poker\Card
     * @covers            \Sixteenstudio\Poker\HandStrength::__construct
     * @covers            \Sixteenstudio\Poker\HandStrength::setCards
     * @covers            \Sixteenstudio\Poker\HandStrength::getCards
     * @covers            \Sixteenstudio\Poker\HandStrength::cardCount
     */
    public function testDeckInstantiatesWithCardsAndReturnsCorrectCardsAndCounts()
    {
        $cards = $this->getArrayOfCards1();

        $handStrength = new HandStrength($cards);

        foreach ($handStrength->getCards() as $key => $card) {
            $this->assertEquals($card, $cards[$key]);
        }

        $this->assertEquals($handStrength->cardCount(), count($cards));
    }


}