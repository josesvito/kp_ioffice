<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $primaryKey = 'no_dokumen';

    public $incrementing = false;

    protected $table = 'dokumen';

    public $timestamps = false;

    public function mitra()
    {
        return $this->belongsTo('App\Mitra', 'kategori_mitra_id');
    }

    public function jenisDokumen()
    {
        return $this->belongsTo('App\JenisDokumen', 'jenis_dokumen_id');
    }
}
