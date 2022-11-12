<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = "messages";
    protected $fillable = ['message'];
    public function fromUser() {
        return $this->belongsTo('App\User', 'username', 'from_username');
    }
    public function toUser() {
        return $this->belongsTo('App\User', 'username', 'to_username');
    }
    public $timestamps = false;
}
