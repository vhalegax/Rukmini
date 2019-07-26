<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jumlah extends Model
{
    protected $table= "jumlahs";

    public function baju()
    {
        return $this->belongsTo('App\Baju');
    }
}
