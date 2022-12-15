<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/29/15
 * Time: 5:28 PM
 */

namespace Karakata\Item\Event;


class ItemWasReviewed
{

	public $review;

	public function __construct($review)
	{
		$this->review = $review;
	}
}