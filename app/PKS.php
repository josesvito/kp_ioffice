<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PKS extends Model
{
    protected $table = 'aktivitas_pks';

    protected $primaryKey = 'id_aktivitas';
}
