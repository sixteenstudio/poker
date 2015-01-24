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

    public function testHandStrengthStraight()
    {
        $handStrength = new HandStrength([
            new Card('Spade', 2),
            new Card('Club', 3),
            new Card('Heart', 9),
            new Card('Club', 5),
            new Card('Diamond', 6),
            new Card('Spade', 7),
            new Card('Spade', 8),
        ]);
        $this->assertEquals($handStrength->getDescription(), 'Straight Nine of Hearts High');

        $handStrength = new HandStrength([
            new Card('Spade', 10),
            new Card('Club', 11),
            new Card('Heart', 12),
            new Card('Club', 13),
            new Card('Diamond', 14),
            new Card('Spade', 7),
            new Card('Spade', 8),
        ]);
        $this->assertEquals($handStrength->getDescription(), 'Straight Ace of Diamonds High');
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
        $this->assertEquals($handStrength->getDescription(), 'Flush');
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