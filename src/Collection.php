<?php namespace Poker\Table;

class Collection extends \Illuminate\Support\Collection {

	/**
	 * Shuffles the items in this collection
	 * 
	 * @return void
	 */
	public function shuffle()
	{
		shuffle($this->items);
	}

}