<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $guarded = [];

    public function booking(){
        return $this->hasMany('App\booking');
    }
}
