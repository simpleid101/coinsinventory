<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mintmark extends Model
{
    //
    public function mint()
    {
        return $this->belongsTo('App\Mint');
    }

    public function coins()
    {
        return $this->hasMany('App\Coin');
    }
}
