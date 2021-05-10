<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class todayflight extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql ="
        select `a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
        from flight as a,airplane as b,location as c,location as d 
        where current_date() = a.date AND a.status = 1 AND a.fName = b.airName AND a.toPlace = c.loId AND a.foPlace = d.loId 
        order by `a`.`time` asc
        ";

        $flights = DB::select( $sql );
        //DB::table(DB::raw('flight as a,airplane as b,location as c,location as d'))
        //->select('a.fName', 'a.time','c.loName as toplace','d.loName as foplace','b.airSeat','a.unboughtSeat',DB::raw('LEFT(a.time,5) AS Ltime'))
        //->join('airplane as b','a.fName','=','b.airName')
        //->join('location as c','a.toPlace','=','c.loId')
        //->join('location as d','a.foPlace','=','d.loId')  //value('loName')只有一個回傳
        //->where(DB::raw('current_date() = a.date'))
        //->where(DB::raw('where current_date() = a.date AND a.fName = b.airName AND a.toPlace = c.loId AND a.foPlace = d.loId'))
        //->orderBy('a.time', 'asc')->get(); 
        return view('today.index',['flights' => $flights]);
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
        //
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
