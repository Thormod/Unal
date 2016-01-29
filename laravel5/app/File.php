<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model {

	//
	protected $table = 'files';

	protected $fillable = ['folder_id','file_name','file_nickname','file_type','file_size','file_mime', 'status', 'file_path','created_by'];

    public function folder(){
    	return $this->belongsTo('App\Folder');
    }

}
