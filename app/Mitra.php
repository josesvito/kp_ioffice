<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mitra extends Model {

    protected $table = 'mitra';
    protected $primaryKey = 'id_mitra';
    public $timestamps = false;

    public function kategoriMitra() {
        return $this->belongsTo('App\KategoriMitra', 'kategori_mitra_id');
    }

}
