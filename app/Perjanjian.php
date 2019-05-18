<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perjanjian extends Model
{
    protected $table = 'perjanjian';

    public $timestamps = false;

    protected $primaryKey = 'id_perjanjian';
    
    public function mitra()
    {
        return $this->belongsTo('App\Mitra', 'Mitra_id_mitra');
    }

    public function dokumen()
    {
        return $this->belongsTo('App\Dokumen', 'dokumen_no_dokumen');
    }
}
