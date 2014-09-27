<?php

class Note extends Eloquent {

	public function user() {
		return $this->belongsTo('User', 'auth_id');
	}

	public function admin() {
		return $this->belongsTo('User', 'admin_id');
	}
}