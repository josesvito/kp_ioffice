<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perjanjian extends Model
{
    protected $table = 'perjanjian';

    protected $primaryKey = 'id_perjanjian';

    public $timestamps = false;

    public function mitra()
    {
        return $this->belongsTo('App\Mitra', 'Mitra_id_mitra');
    }

    public function pks()
    {
        return $this->belongsTo('App\PKS', 'Aktivitas_PKS_id_aktivitas');
    }
}
