<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $table = "exercise";
    public function user() {
        return $this->belongsToMany('App\User', 'user_submit', 'topic');
    }
    public $timestamps = false;
}
