<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class putshelf extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("putshelf.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("putshelf.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $put = $request->validate([
            'apname' => 'required|max:15',
            'apdate' => 'required|date|after:today',
            'aptime' => 'required',
            'apto' => 'required',
            'apfo' => 'required',
            'apprice' => 'required|max:6'
        ]);

        //auth()->user()->putshelfs()->create($put);

        //SELECT MAX(fId) as id FROM `flight`
        // $fid = DB::table('flight')
        // ->select(DB::raw('MAX(fId) AS id'))
        // ->value('id');
        $toP = 0;
        $foP = 0;

        if($request->apto == '松山(TSA)')
            $toP = '1';
        elseif($request->apto == '高雄(KHH)')  
            $toP = '2';  
        elseif($request->apto == '台中(RMQ)')  
            $toP = '3';
        elseif($request->apto == '花蓮(HUN)')  
            $toP = '4';
        elseif($request->apto == '台東(TTT)')  
            $toP = '5';
        elseif($request->apto == '澎湖(MZG)')  
            $toP = '6';
        elseif($request->apto == '金門(KNH)')  
            $toP = '7';

        if($request->apfo == '松山(TSA)')
            $toP = '1';
        elseif($request->apfo == '高雄(KHH)')  
            $toP = '2';  
        elseif($request->apfo == '台中(RMQ)')  
            $toP = '3';
        elseif($request->apfo == '花蓮(HUN)')  
            $toP = '4';
        elseif($request->apfo == '台東(TTT)')  
            $toP = '5';
        elseif($request->apfo == '澎湖(MZG)')  
            $toP = '6';
        elseif($request->apfo == '金門(KNH)')  
            $toP = '7';    

        DB::table('flight')->insert(
            [//'fId' => $fid+1,
            'fName' => $request->apname,
            'toPlace' => $toP,
            'foPlace' => $foP,
            'date' => $request->apdate,//'2021-04-08'
            'time' => $request->aptime,//'07:36:00'
            'unboughtSeat' => 0,
            'boughtSeat' => 0,
            'status' => '',
            'fprice' => $request->apprice
            ]
        );
        
        
        return redirect()->route('putshelf')->with('notice','航班上架成功!'); 
        //web.php->name('putshelf')
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
