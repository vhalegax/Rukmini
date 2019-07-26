<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kupon extends Model
{
    protected $table = 'kupon';

    public function Tr_penjualan()
    {
        return $this->hasMany('App\Tr_penjualan','kupon_id','id');
    }
}
