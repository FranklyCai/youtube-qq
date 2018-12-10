<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoType extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'ename';
    public function indexVideos(){
        return $this->hasMany('App\IndexVideo','video_type');
    }
}
