<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['videoName','videoDesc'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
