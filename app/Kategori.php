<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    protected $table = 'kategori';

    use SoftDeletes;

    public function baju()
      {
        return $this->belongsToMany('App\Baju','kategori_baju','kategori_id','baju_id');
      }
}
