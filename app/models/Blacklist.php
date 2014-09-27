<?php

class Blacklist extends Eloquent {
	public $table = "blacklist";

	public function admin() {
		return $this->belongsTo('User', 'auth_id');
	}
}