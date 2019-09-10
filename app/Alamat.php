<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{   
    protected $table = "alamat";

    public function Pembeli()
    {
        return $this->belongsTo('App\Pembeli');
    }

    public function Kota()
    {
        return $this->hasOne('App\City','id','kota');
    }

    public function Provinsi()
    {
        return $this->hasOne('App\Province','id','provinsi');
    }
}
