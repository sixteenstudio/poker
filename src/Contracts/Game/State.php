<?php namespace Sixteenstudio\Poker\Contracts\Game;

/*
 * This file is part of the Poker package.
 *
 * (c) Matthew Collison <matthew@sixteenstudio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

interface State {

	/**
	 * Return the name of this game state
	 * 
	 * @return string
	 */
	public function getName();

}
