<?php

namespace App\Http\Controllers;

use App\DTSearch\DTSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Coin;

class SearchController extends Controller
{
    //
    public function search(Request $data, DTSearch $dt)
    {
        $d = $dt->get();
        return response()->json(
            [
                'draw' => $data['draw'],
                'data' => $d['data']->all(),
                'recordsTotal' => Coin::count(),
                'recordsFiltered' => $d['filtered'],
                ]
        );
    }

    public function square(Request $request)
    {
        $square =  $request->square;
        
        $emperors = DB::table('coins')
            ->selectRaw('emperor as label, count(emperor) as count')
            ->where('square', $square)
            ->groupBy('emperor')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();
        
        $denominations = DB::table('coins')
            ->selectRaw('denomination as label, count(denomination) as count')
            ->where('square', $square)
            ->groupBy('denomination')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        $date = DB::table('coins')
            ->selectRaw('find_date as label, count(find_date) as count')
            ->where('square', $square)
            ->groupBy('find_date')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();
    

        return response()->json(
            [
            'emperors'      => $emperors,
            'denominations' => $denominations,
            'dates'          => $date
            ]
        );
    }
}
