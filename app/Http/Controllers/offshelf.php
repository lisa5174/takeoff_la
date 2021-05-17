<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class offshelf extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $off ="
        select `a`.`fId`,`a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
        from flight as a 
        INNER JOIN airplane as b ON a.fName = b.airName
        INNER JOIN location as c ON a.toPlace = c.loId
        INNER JOIN location as d ON a.foPlace = d.loId 
        where a.date >= current_date() AND a.date <= DATE_ADD(CURRENT_DATE(), INTERVAL 3 MONTH) AND a.status = 1
        order by `a`.`date` asc,`a`.`time` asc
        ";

        $already ="
        select `a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
        from flight as a 
        INNER JOIN airplane as b ON a.fName = b.airName
        INNER JOIN location as c ON a.toPlace = c.loId
        INNER JOIN location as d ON a.foPlace = d.loId 
        where a.date <= current_date() AND a.date >= DATE_SUB(CURRENT_DATE(), INTERVAL 3 MONTH)
        order by `a`.`date` desc,`a`.`time` desc
        ";

        $airplane ="
        SELECT airName FROM airplane
        ";

        //AND a.status = 0
        $offs = DB::select( $off );
        $alreadyoffs = DB::select( $already );
        $airplanes = DB::select( $airplane );
        return view("offshelf.index",['airplanes' => $airplanes,'offs' => $offs,'alreadyoffs' => $alreadyoffs]);
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
        // DB::table('flight')->where('fId', $id)->update(
        //     [
        //         'status' => 1
        //     ]
        // );
        
        return dd($request->all());
        // return redirect()->route('offshelfs.index')->with('notice','航班刪除成功!');
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
        // DB::table('flight')->where('fId', $id)->update(
        //     [
        //         'status' => 1
        //     ]
        // );
        
        return dd($id);
        // return redirect()->route('offshelfs.index')->with('notice','航班刪除成功!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
    public function off(Request $request)
    {
        // DB::table('flight')->where('fId', $id)->update(
        //     [
        //         'status' => 1
        //     ]
        // );
        
        return dd($request->all());
        // return redirect()->route('offshelfs.index')->with('notice','航班刪除成功!');
    }
}
