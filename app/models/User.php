<?php

class User extends Eloquent {
	public $timestamps = false;
	public $table = "auth";
	
	public function characters() {
		return $this->hasMany('Character', 'auth_id');
	}

	public function sponsors() {
		return $this->belongsToMany('User', 'sponsors', 'auth_id', 'sponsor_id');
	}

	public function sponsoree() {
		return $this->belongsToMany('User', 'sponsors', 'sponsor_id', 'auth_id');
	}
}
