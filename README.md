Poker
=====

A PHP-based Poker library capable of hand calculations, Texas Hold'em game logic and more

Cards and Decks
--------------------

The poker library retains a fairly simplified class structure, providing you with a simple card class which can be swapped out for any card implementation that follows its interface, allowing you to implement your own suits and even your own description translations.

    $cards = [
        new Card('Club', 1),
        new Card('Spade', 2),
        new Card('Club', 3),
        new Card('Heart', 4),
        new Card('Diamond', 5),
    ];

    $deck = new Deck($cards);

A Deck is a collection of cards that provides shuffle, take card, card count functions and any other functions that might be necessary when building a poker game.

A standard 52 card deck can be instantiated using the static newStandardDeck method

    $52CardDeck = Deck::newStandardDeck();

Hands and HandStrengths
--------------------------------

Hands are made from a particular number of cards, of which the limit depends on the type of game. The default Hand class sets a limit of **2 cards**, as this is the standard Texas Hold'em hand card count.

    $hand = new Hand([$deck->takeCard(), $deck->takeCard()]);

If an invalid hand is made (i.e. more than 2 cards are added to the hand), an **Sixteenstudio\Poker\InvalidHandException** will be thrown.

A hand is not to be confused with a hand strength, which is where the strongest hand dependant on a player's hand and any community cards is calculated. This class is currently still under development.

HandStrength instances will be useful because they can calculate, using any provided playable cards, what the strongest hand is that can be made, using only a small amount of method calls.

It will also allow a comparison between other HandStrength classes, which allows a Game class to calculate who the winning player is in any given situation.

Game
-------

The Game class, which is currently under development, is an abstract class which will provide a framework for card based games (that means not only Poker!) that can be re-used for any number of games.

It will hold player information, game states and essentially the backend gameplay logic required to run a game server.

An Laravel 4.2 based application built using Socketier, MongoDB and this Poker library will be available soon, which will be an example of how an online poker room solution can be achieved using PHP.

Example
-------

The environment application will be found in the sixteenstudio/poker-environment repository. This provides a vagrant-based environment built on Laravel 4.2 to fully test out the features of the poker library and the texas hold'em functionality.