<?php namespace Sixteenstudio\Poker\Contracts;

/*
 * This file is part of the Poker package.
 *
 * (c) Matthew Collison <matthew@sixteenstudio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

interface Game {

    /**
     * The name of the game
     * 
     * @var string
     */
    public function getName();

    /**
     * Get the current state of the game
     * 
     * @var Sixteenstudio\Poker\Contracts\Game\State
     */
    public function getState();

    /**
     * Returns an array of players
     * 
     * @var array
     */
    public function getPlayers();

    /**
     * Begin the game
     * 
     * @var string
     */
    public function start();

    /**
     * Finish the game
     * 
     * @var string
     */
    public function halt();

}