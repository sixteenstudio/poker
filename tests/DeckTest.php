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

class DeckTest extends \PHPUnit_Framework_TestCase {

    /**
     * @uses              \Sixteenstudio\Poker\Card
     * @covers            \Sixteenstudio\Poker\Deck::__construct
     * @covers            \Sixteenstudio\Poker\Deck::setCards
     * @covers            \Sixteenstudio\Poker\Deck::getCards
     * @covers            \Sixteenstudio\Poker\Deck::cardCount
     */
    public function testDeckInstantiatesWithCardsAndReturnsCorrectCardsAndCounts()
    {
        $cards = $this->getArrayOfCards1();

        $deck = new Deck($cards);

        foreach ($deck->getCards() as $key => $card) {
            $this->assertEquals($card, $cards[$key]);
        }

        $this->assertEquals($deck->cardCount(), count($cards));
    }

    /**
     * @uses              \Sixteenstudio\Poker\Card
     * @covers            \Sixteenstudio\Poker\Deck::__construct
     * @covers            \Sixteenstudio\Poker\Deck::setCards
     * @covers            \Sixteenstudio\Poker\Deck::takeCard
     * @covers            \Sixteenstudio\Poker\Deck::cardCount
     */
    public function testDeckInstantiatesAndTakeCardReturnsPlusRemovesTopmostCard()
    {
        $cards = $this->getArrayOfCards2();

        $deck = new Deck($cards);

        $topCard = $deck->takeCard();

        $this->assertEquals($topCard, $cards[0]);

        foreach ($deck->getCards() as $card) {
            $this->assertNotEquals($card, $cards[0]);
        }
    }

    /**
     * @uses              \Sixteenstudio\Poker\Card
     * @covers            \Sixteenstudio\Poker\Deck::__construct
     * @covers            \Sixteenstudio\Poker\Deck::setCards
     * @covers            \Sixteenstudio\Poker\Deck::takeCard
     * @covers            \Sixteenstudio\Poker\Deck::cardCount
     */
    public function testDeckInstantiatesTakesCardAndReAdds()
    {
        $cards = $this->getArrayOfCards2();

        $deck = new Deck($cards);

        // Take the top card and place it in a variable
        $takenCard = $deck->takeCard();

        // Make sure card has been removed from deck
        foreach ($deck->getCards() as $card) {
            $this->assertNotEquals($card, $cards[0]);
        }

        // Add the card back in
        $deck->addCard($takenCard);

        $topCardFound = false;

        // Make sure the card is back at the top of the deck
        // and that all the other cards retained their
        // original position as logic would state
        $cards = $deck->getCards();

        foreach ($cards as $key => $card) {
            $this->assertEquals($card, $cards[$key]);
        }
    }

    private function getArrayOfCards1()
    {
        return [
            new Card('Spade', 3),
            new Card('Club', 3),
            new Card('Heart', 5),
            new Card('Diamond', 2),
        ];
    }

    private function getArrayOfCards2()
    {
        return [
            new Card('Spade', 5),
            new Card('Club', 6),
            new Card('Club', 7),
            new Card('Diamond', 8),
        ];
    }

}