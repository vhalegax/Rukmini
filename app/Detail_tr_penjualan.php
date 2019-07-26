<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_tr_penjualan extends Model
{
    protected $table='detail_tr_penjuals';

    protected $fillable = ['size','jumlah','harga','subtotal','baju_id','tr_penjualan_id'];

    public function Baju()
    {
        return $this->belongsTo('App\Baju');
    }

    public function Tr_penjualan()
    {
        return $this->belongsTo('App\Tr_penjualan');
    }
}
