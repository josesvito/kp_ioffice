<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'log_history';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }
}
