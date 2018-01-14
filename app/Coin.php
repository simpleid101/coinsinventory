<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    //
        protected $fillable = ["bag_number", 'field_inventory', 'emperor', 'denomination', 'obverse', 'reverse', 'mint_id', 
    'mintmark_id', 'weight', 'diameter', 'emission', 'axis', 'find_date', 'square', 'location'];

    public function mintmark()
    {
        return $this->belongsTo('App\Mintmark');
    }

    public function mint(){
        return $this->belongsTo('App\Mint');
    }
}
