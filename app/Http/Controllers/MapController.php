<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Map;

class MapController extends Controller
{
    //
    public function index()
    {
        $map = Map::first();
        return view('map.index')->with('map', $map);
    }

    public function edit()
    {
        $map = Map::first() ?  Map::first() : new Map;
        return view('map.edit')->with('map', $map);
    }

    public function update(Request $request)
    {
        $request->validate(
            [
            'mapImg' => 'file|image',
            'grid-size' => 'required|integer'
            ]
        );

        $map = Map::first() ?  Map::first() : new Map;

        if ($request->hasFile('mapImg')) 
        {
            $path = $request->file('mapImg')->store('public');
            $map->map_image = $path;
        }
            
        $map->grid_size = $request->input('grid-size');
        $map->save();
        

    }


}
