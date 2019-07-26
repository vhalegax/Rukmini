<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pembeli extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['username',  'password'];

    protected $hidden = ['password',  'remember_token'];

    public function Tr_penjualan()
    {
        return $this->hasMany('App\Tr_penjualan','pembeli_id');
    }

    public function Alamat()
    {
        return $this->hasMany('App\Alamat','id_pembeli');
    }

    public function Wishlist()
    {
        return $this->hasMany('App\Wishlist','pembelis_id','id');
    }
}
