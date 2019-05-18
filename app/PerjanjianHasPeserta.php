<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerjanjianHasPeserta extends Model
{
    protected $table = 'perjanjian_has_peserta';

    public $timestamps = false;

    public function peserta()
    {
        return $this->belongsTo('App\Peserta', 'peserta_no_induk_peserta');
    }

    public function perjanjian()
    {
        return $this->belongsTo('App\Perjanjian', 'perjanjian_id_perjanjian');
    }
}
