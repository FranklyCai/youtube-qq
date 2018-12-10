<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndexVideo extends Model
{
    //
    public function videoType(){
        return $this->belongsTo('App\VideoType');
    }
}
