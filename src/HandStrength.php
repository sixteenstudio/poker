<?php namespace Sixteenstudio\Poker;

/****
 * NOTE TO SELF:
 ****/
// I keep thinking that I need to somehow check all possibilities of 5 card
// hands to actually make a handstrength, but I should be able to check for
// pairs, trips, full houses, flushes etc within all 7 cards. This should not
// be an issue. A game where probability has to come into play is in omaha,
// but not hold'em. Basically, save that complicated stuff for Omaha!

class HandStrength extends Deck {

    /**
     * The hand that this hand strength is bound to
     * 
     * @var integer
     */
    protected $hand;

    /** @var Card */
    protected $kicker;
    protected $highEnd;
    protected $flushSuit;

    protected $hands = [
        'High Card',
        'Pair',
        'Two Pair',
        'Three of a Kind',
        'Straight',
        'Flush',
        'Full House',
        'Quads',
        'Straight Flush',
        'Royal Flush'
    ];

    /**
     * Returns the cards based on the strongest
     * hand that can be made with the cards
     * available
     * 
     * @return Poker\Table\Deck
     */
    public function getHandCards()
    {
        $cards = $this->getCards();

        $this->calculateHandStrength();
    }

    /**
     * Initializes this HandStrength instance by calculating,
     * depending on the cards provided, the strength of the
     * hand and placing it onto the object to be evaluated
     * by other methods that require it
     * 
     * @return void
     */
    public function calculateHandStrength()
    {
        $this->sortCards();

        if ($this->isHighCard()) {
            $this->hand = 0;
        }

        if ($this->isPair()) {
            $this->hand = 1;
        }

        if ($this->isTwoPair()) {
            $this->hand = 2;
        }

        if ($this->isThreeOfAKind()) {
            $this->hand = 3;
        }

        if ($this->isStraight()) {
            $this->hand = 4;
        }

        if ($this->isFlush()) {
            $this->hand = 5;
        }

        if ($this->isFullHouse()) {
            $this->hand = 6;
        }

        if ($this->isFourOfAKind()) {
            $this->hand = 7;
        }

        if ($this->isStraightFlush()) {
            $this->hand = 8;
        }

        if ($this->isRoyalFlush()) {
            $this->hand = 9;
        }
    }

    public function isRoyalFlush()
    {

    }

    public function isStraightFlush()
    {
        if ($this->isFlush())
        {
            $flushCards = [];
            foreach ($this->cards as $card)
            {
                if ($card->getSuit() == $this->flushSuit)
                {
                    $flushCards[] = clone $card;
                }
            }
            $handStrength = new HandStrength($flushCards);
            $handStrength->sortCards();
            if ($handStrength->isStraight())
            {
                $this->highEnd = $handStrength->getHighEnd();
                return true;
            }
        }
        return false;
    }

    public function isFourOfAKind()
    {
        // We always want to flip aces to high aces
        // for any type of multiple card hand
        $this->flipAces();

        $valueTally = [];

        foreach ($this->cards as $card) {
            empty($valueTally[$card->getValue()]) ? $valueTally[$card->getValue()] = 1 : $valueTally[$card->getValue()]++;
        }

        foreach ($valueTally as $tally) {
            if ($tally === 4) {
                $this->flipAces();

                return true;
            }
        }

        $this->flipAces();

        return false;
    }

    public function isFullHouse()
    {
        return $this->isPair() && $this->isThreeOfAKind();
    }

    public function isFlush()
    {
        $suitTally = [];

        foreach ($this->cards as $card) {
            empty($suitTally[$card->getSuit()]) ? $suitTally[$card->getSuit()] = 1 : $suitTally[$card->getSuit()]++;
        }

        foreach ($suitTally as $suit => $tally) {
            if ($tally >= 5) {
                $this->flushSuit = $suit;
                return true;
            }
        }

        return false;
    }

    /**
     * Returns the highest straight that can be found
     * 
     * @return boolean
     */
    public function isStraight()
    {
        $lowStraight = $this->findStraight();
        
        // Flip aces to high aces to look for high
        // straight
        $this->flipAces();

        $highStraight = $this->findStraight();

        // Back to low aces
        $this->flipAces();

        return $highStraight ?: $lowStraight;
    }

    public function sortCards()
    {
        $this->cards->sortByDesc(function($card)
        {
            return $card->getValue();
        });
    }

    protected function findStraight()
    {
        $consecutiveCount = 1;

        $isStraight = false;
        $lastValue = -1;
        $high = '';

        foreach ($this->cards as $card) {
            if ($card->getValue() == $lastValue) {
                // We need to ignore this card
            }
            elseif ($card->getValue() == $lastValue - 1) {
                // Found a consecutive card, add one to
                // the count
                $consecutiveCount++;

                // We've found a straight if we have counted
                // five consecutive cards
                if ($consecutiveCount >= 5) {
                    $isStraight = true;
                    $this->highEnd = ! isset($this->highEnd) || ($high->getValue() > $this->highEnd->getValue()) ? $high : $this->highEnd;
                }
            } else {
                // Lost consecutive streak, reset the count
                $consecutiveCount = 1;
                $high = clone $card;
            }

            $lastValue = $card->getValue();
        }

        return $isStraight;
    }

    public function isThreeOfAKind()
    {
        // We always want to flip aces to high aces
        // for any type of multiple card hand
        $this->flipAces();

        $valueTally = [];

        foreach ($this->cards as $card) {
            empty($valueTally[$card->getValue()]) ? $valueTally[$card->getValue()] = 1 : $valueTally[$card->getValue()]++;
        }

        foreach ($valueTally as $cardValue => $tally) {
            // Flip the aces back
            $this->flipAces();

            if ($tally === 3) {
                $findHand = clone $this->cards;
                foreach ($findHand as $idx => $card)
                {
                    if ($card->getValue == $cardValue)
                    {
                        $this->madeHand[] = $card;
                        unset($findHand[$idx]);
                    }
                }
                $this->madeHand[] = $card[0];
                $this->madeHand[] = $card[1];
                return true;
            }
        }

        // Flip the aces back
        $this->flipAces();

        return false;
    }

    /**
     * Determines whether this hand contains at least
     * two pairs
     * @return boolean
     */
    public function isTwoPair()
    {
        // We always want to flip aces to high aces
        // for any type of multiple card hand
        $this->flipAces();

        // An array of values that are found. The loop
        // will use this array to determine if a second
        // card of the same value is found by checking
        // if it is already set in this array
        $values = [];

        // A value will only be set in this if a card
        // is found to be already in the values array
        // when one is found, which means at least 2
        // are found. This lets us count the pairs in
        // this array
        $pairs = [];

        foreach ($this->cards as $card) {
            // Pair found
            if ( ! empty($values[$card->getValue()])) {
                $pairs[$card->getValue()] = true;
            }

            // Value is set. This will trigger the above
            // block if this value is found again
            $values[$card->getValue()] = true;
        }

        // Flip the aces back
        $this->flipAces();

        return count($pairs) > 1;
    }

    /**
     * Determines whether this hand contains a pair
     * 
     * @return boolean
     */
    public function isPair()
    {
        // We always want to flip aces to high aces
        // for any type of multiple card hand
        $this->flipAces();

        $values = [];

        foreach ($this->cards as $card) {
            if ( ! empty($values[$card->getValue()])) {
                $this->flipAces();

                return true;
            }

            $values[$card->getValue()] = true;
        }

        $this->flipAces();
        return false;
    }

    /**
     * Determines whether this hand contains a pair
     * 
     * @return boolean
     */
    public function isHighCard()
    {

        return true;
    }

    public function getDescription()
    {
        return $this->getHandType() . $this->getKickerDescription();
    }

    public function getHandType()
    {
        $this->calculateHandStrength();
        return $this->hands[$this->hand];
    }

    public function getKicker()
    {
        return $this->kicker;
    }

    public function getKickerDescription()
    {
        if ($kicker = $this->getKicker())
        {
            return ' ' . $this->kicker . ' Kicker';
        }

        if ($high = $this->getHighEndWord())
        {
            return ' ' . $high . ' High';
        }
    }

    protected function getHighEnd()
    {
        return $this->highEnd;
    }

    protected function getHighEndWord()
    {
        if ($this->highEnd)
        {
            return $this->highEnd->getValueWord();
        }
    }

    public function getHandDescription()
    {
    }

    /**
     * Flips the ace values from 1 to 14 or vice-versa,
     * to allow straight calculators to account for
     * high aces
     * 
     * @return void
     */
    protected function flipAces()
    {
        foreach ($this->cards as $key => $card) {
            if ($card->getValue() === 1 || $card->getValue() === 14) {
                $card->setValue($card->getValue() === 1 ? 14 : 1);

                $this->cards->put($key, $card);
            }
        }
    }

}