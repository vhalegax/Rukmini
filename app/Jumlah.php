<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jumlah extends Model
{
    protected $table= "jumlah";

    public function baju()
    {
        return $this->belongsTo('App\Baju');
    }
}
