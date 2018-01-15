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

    public function storePhoto($f){
        return \Cloudinary\Uploader::upload($f);
        //return $request->file($name)->store('public');
    }

    public function replacePhoto($name, $request)
    {
        if ($request->hasFile($name)) {
            $pid = $name  . '_pid' ;
            $op = $this->storePhoto($request->file($name));
            \Cloudinary\Uploader::destroy($this[$pid]);
            $this[$name] = $op['url'];
            $this[$pid] = $op['public_id'];
        }
    } 
}
