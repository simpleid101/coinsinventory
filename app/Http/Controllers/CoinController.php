<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\CoinRequest;

class CoinController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('coins.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('coins.create')->with('coin', new \App\Coin);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CoinRequest $request)
    {
        //

        $coin = new \App\Coin;
        
        
        $this->setFields($coin, $request);
        $op = $coin->storePhoto($request->file('obverse_photo'));
        $rp = $coin->storePhoto($request->file('reverse_photo'));
        
        $coin->obverse_photo = $op['url'];
        $coin->obverse_photo_pid = $op['public_id'];
        $coin->reverse_photo = $rp['url'];
        $coin->reverse_photo_pid = $rp['public_id'];

        if ($op && $rp && $coin->save()) {
            \Session::flash('status', [ 'state' => 'success', 'msg' => 'Coin saved']);
        } else {
            \Session::flash('status', [ 'state' => 'danger', 'Failed to save coin']);
        }

        return redirect()->action('CoinController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        return view('coins.show')->with('coin', \App\Coin::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $coin = \App\Coin::find($id);
        return view('coins.edit')->with('coin', $coin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CoinRequest $request, $id)
    {
        //

        $coin = \App\Coin::find($id);
        
        $this->setFields($coin, $request);
        $coin->replacePhoto('obverse_photo', $request);
        $coin->replacePhoto('reverse_photo', $request);

        if ($coin->save()){
            \Session::flash('status', [ 'state' => 'success', 'msg' => 'Changes saved']);
        } else {
            \Session::flash('status', [ 'state' => 'danger', 'Edit failed']);
        }

        return redirect()->action('CoinController@index') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $coin = \App\Coin::find($id);
        if ($coin->delete()){
            \Session::flash('status', [ 'state' => 'success', 'msg' => 'Coin deleted']);
        } else {
            \Session::flash('status', [ 'state' => 'danger', 'Deletion failed']);
        }
        return redirect()->action('CoinController@index');
    }


    private function setFields($coin, $request)
    {
        $coin->bag_number = $request->input('bag_#');
        $coin->field_inventory = $request->input('field_#');
        $coin->emperor = $request->input('emperor');
        $coin->denomination = $request->input('denomination');
        $coin->obverse = $request->input('obverse');
        $coin->reverse = $request->input('reverse');
        $coin->mint_id = $request->input('mint');
        $coin->mintmark_id = $request->input('mintmark');
        $coin->weight = $request->input('weight');
        $coin->diameter = $request->input('diameter');
        $coin->emission = $request->input('emission');
        $coin->axis = $request->input('axis');
        $coin->reference = $request->input('reference');
        $coin->location = $request->input('location');
        $coin->square = $request->input('square');
        $coin->find_date = $request->input('date');
    }

}
