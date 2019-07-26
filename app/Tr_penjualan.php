<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tr_penjualan extends Model
{
    protected $table = 'tr_penjualans';

    public function User()
    {
        return $this->belongsTo('App\User','karyawan_id');
    }

    public function Pembeli()
    {
        return $this->belongsTo('App\Pembeli','pembeli_id');
    }

    public function Pengiriman()
    {
        return $this->hasOne('App\Pengiriman','tr_penjual_id');
    }

    public function Detail_tr_penjualan()
    {
        return $this->hasMany('App\Detail_tr_penjualan','tr_penjualan_id');
    }

}
