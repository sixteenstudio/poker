<?php namespace Sixteenstudio\Poker;

/*
 * This file is part of the Poker package.
 *
 * (c) Matthew Collison <matthew@sixteenstudio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

abstract class Game implements Contracts\Game {

	abstract protected $name;

    /**
     * The name of the game
     * 
     * @var string
     */
    public function getName()
    {
    	return $this->name;
    }

    /**
     * Get the current state of the game
     * 
     * @var Sixteenstudio\Poker\Contracts\Game\State
     */
    abstract public function getState();

    /**
     * Returns an array of players
     * 
     * @var array
     */
    abstract public function getPlayers();

    /**
     * Begin the game
     * 
     * @var string
     */
    abstract public function start();

    /**
     * Finish the game
     * 
     * @var string
     */
    abstract public function halt();

}