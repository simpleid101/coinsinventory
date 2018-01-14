<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mint extends Model
{
    //
    public function mintmarks()
    {
        return $this->hasMany('App\Mintmark');
    }

    public function coins()
    {
        return $this->hasMany('App\Coin');
    }
}
