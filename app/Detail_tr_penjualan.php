<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_tr_penjualan extends Model
{
    protected $table='detail_tr_penjual';

    public function Baju()
    {
        return $this->belongsTo('App\Baju','pakaian_id');
    }

    public function Tr_penjualan()
    {
        return $this->belongsTo('App\Tr_penjualan');
    }
}
