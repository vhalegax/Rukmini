<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table='pengiriman';

    public function Tr_penjualan()
    {
        return $this->belongsTo('App\Tr_penjualan');
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
