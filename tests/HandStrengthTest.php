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
            $this->assertEquals($cards[$key], $card);
        }

        $this->assertEquals(count($cards), $handStrength->cardCount());
    }

    public function testHandStrengthStraight()
    {
        $handStrength = new HandStrength([
            new Card('Spade', 2),
            new Card('Club', 3),
            new Card('Heart', 3),
            new Card('Club', 4),
            new Card('Diamond', 5),
            new Card('Spade', 6),
            new Card('Club', 6),
        ]);
        $this->assertEquals('Straight Six High', $handStrength->getDescription());

        $handStrength = new HandStrength([
            new Card('Spade', 2),
            new Card('Club', 3),
            new Card('Heart', 9),
            new Card('Club', 5),
            new Card('Diamond', 6),
            new Card('Spade', 7),
            new Card('Spade', 8),
        ]);
        $this->assertEquals('Straight Nine High', $handStrength->getDescription());

        $handStrength = new HandStrength([
            new Card('Spade', 10),
            new Card('Club', 11),
            new Card('Heart', 12),
            new Card('Club', 13),
            new Card('Diamond', 14),
            new Card('Spade', 7),
            new Card('Spade', 8),
        ]);
        $this->assertEquals('Straight Ace High', $handStrength->getDescription());

        $handStrength = new HandStrength([
            new Card('Spade', 8),
            new Card('Club', 9),
            new Card('Heart', 10),
            new Card('Club', 11),
            new Card('Diamond', 12),
            new Card('Spade', 13),
            new Card('Spade', 14),
        ]);
        $this->assertEquals('Straight Ace High', $handStrength->getDescription());
    }


    public function testHandWithFlushAndStraightThatIsNotStraightFlush()
    {
        $handStrength = new HandStrength([
            new Card('Spade', 10),
            new Card('Club', 11),
            new Card('Club', 12),
            new Card('Club', 13),
            new Card('Diamond', 14),
            new Card('Club', 7),
            new Card('Club', 8),
        ]);
        $this->assertEquals('Flush Ace High', $handStrength->getDescription());
    }

    public function testHandWithLongStraightDifferentFlushes()
    {
        $handStrength = new HandStrength([
            new Card('Spade', 7),
            new Card('Club', 8),
            new Card('Club', 9),
            new Card('Club', 10),
            new Card('Diamond', 11),
            new Card('Club', 12),
            new Card('Club', 13),
        ]);
        $this->assertEquals('Flush King High', $handStrength->getDescription());

        $handStrength = new HandStrength([
            new Card('Heart', 1),
            new Card('Heart', 8),
            new Card('Heart', 9),
            new Card('Heart', 10),
            new Card('Heart', 11),
            new Card('Heart', 12),
            new Card('Heart', 13),
        ]);
        $this->assertEquals('Straight Flush Ace High', $handStrength->getDescription());

        $handStrength = new HandStrength([
            new Card('Club', 7),
            new Card('Club', 8),
            new Card('Club', 9),
            new Card('Club', 10),
            new Card('Club', 11),
            new Card('Club', 12),
            new Card('Diamond', 13),
        ]);
        $this->assertEquals('Straight Flush Queen High', $handStrength->getDescription());
    }




    public function testHandStrengthFlush()
    {
        $handStrength = new HandStrength([
            new Card('Spade', 2),
            new Card('Spade', 10),
            new Card('Spade', 12),
            new Card('Spade', 5),
            new Card('Spade', 9),
            new Card('Spade', 7),
            new Card('Spade', 8),
        ]);
        $this->assertEquals('Flush', $handStrength->getDescription());
    }

    protected function getArrayOfCards1()
    {
        return [
            new Card('Spade', 2),
            new Card('Spade', 3),
            new Card('Spade', 4),
            new Card('Spade', 5),
            new Card('Spade', 6),
            new Card('Spade', 7),
            new Card('Spade', 8),
        ];
    }

}