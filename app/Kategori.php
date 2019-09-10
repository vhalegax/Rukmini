<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    public function baju()
      {
        return $this->belongsToMany('App\Baju','kategori_pakaian','kategori_id','pakaian_id');
      }
}
