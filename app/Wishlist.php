<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlist';
    public $incrementing = false;

    public function Pembeli()
    {
        return $this->hasMany('App\Pembeli','id','pembelis_id');
    }

    public function Baju()
    {
        return $this->hasMany('App\Baju','id','bajus_id');
    }

}
