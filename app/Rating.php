<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table="rating";

    public function nama_pembeli()
    {
        return $this->belongsTo('App\Pembeli','baju_id','id');
    }
}
