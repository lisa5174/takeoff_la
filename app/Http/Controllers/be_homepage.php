<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class be_homepage extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mId = session('mId');
        return view('be_homepage.index', ['mId' => $mId]);
        // return view("be_homepage.index");
    }
    
    public function index2()
    {
        $mId = session('mId');
        return view('be_homepage.index2', ['mId' => $mId]);
        // return view("be_homepage.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $searchflights = $request->all();
        // return dd($searchflights);
        $put = $request->validate([
            'be_apto' => 'required|integer|between:1,7',
            'be_apfo' => 'required|integer|between:1,7',
            'dateto' => 'required|date|after_or_equal:today',
            'datefo' => 'nullable|date|after_or_equal:dateto',
            'quantity' => 'required|integer|between:1,4',
            'quantity2' => 'required|integer|between:0,4|lte:quantity'
        ]);

        return redirect()->route("choose.index",['apto' => $request->be_apto,'apfo' => $request->be_apfo,'dateto' => $request->dateto,
        'datefo' => $request->datefo,'quantity' => $request->quantity,'quantity2' => $request->quantity2]);//router會帶參數
        // return dd($searchflights);
        
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}