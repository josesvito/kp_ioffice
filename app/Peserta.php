<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'peserta';

    protected $primaryKey = 'no_induk_peserta';

    public $incrementing = false;

    public $timestamps = false;
}
