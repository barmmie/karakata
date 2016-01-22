<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 12/28/15
 * Time: 9:12 PM
 */

class Review extends \Eloquent {


	use \Laracasts\Commander\Events\EventGenerator;

	public function author()
	{
		return $this->belongsTo('User', 'author_id');
	}

	public function user() {
		return $this->belongsTo('User', 'user_id');
	}

}