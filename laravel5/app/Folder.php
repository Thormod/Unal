<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model {

	//
    protected $table = 'folders';

    public function files(){
    	return $this->hasMany('App\File');
    }

}
