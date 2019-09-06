<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baju extends Model
{
    protected $table = "pakaian";
    
    public function jumlah()
    {
        return $this->hasMany('App\Jumlah','pakaian_id','id');
    }

    public function kategori()
    {
        return $this->belongsToMany('App\Kategori','kategori_pakaian','pakaian_id','kategori_id');
    }

    public function Detail_tr_penjualan()
    {
        return $this->hasMany('App\Detail_tr_penjualan');
    }

    public function rating()
    {
        return $this->hasMany('App\Rating','pakaian_id','id');
    }

}
