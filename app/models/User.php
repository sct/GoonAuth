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

	public function scopeAuthed($query) {
        return $query->where('sa_username', '!=', '')->where('linked_at', '!=', '');
    }

    public function scopeSponsored($query) {
    	return $query->where('is_sponsored', '1');
    }
}
