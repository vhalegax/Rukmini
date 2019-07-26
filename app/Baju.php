<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Baju extends Model
{
    use SoftDeletes;
    
    public function jumlah()
    {
        return $this->hasMany('App\Jumlah','id_baju','id');
    }

    public function kategori()
    {
        return $this->belongsToMany('App\Kategori','kategori_baju','baju_id','kategori_id');
    }

    public function Detail_tr_penjualan()
    {
        return $this->hasMany('App\Detail_tr_penjualan');
    }
}
