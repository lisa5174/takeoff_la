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
        // select * from flight
        // WHERE date >= current_date() AND date <= DATE_ADD(CURRENT_DATE(), INTERVAL 3 MONTH)
        
        // select `a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
        // from flight as a,airplane as b,location as c,location as d 
        // where a.date >= current_date() AND a.date <= DATE_ADD(CURRENT_DATE(), INTERVAL 3 MONTH) AND a.fName = b.airName AND a.toPlace = c.loId AND a.foPlace = d.loId 
        // order by `a`.`date` ASC,`a`.`time` asc
        
        //上下兩個方法是相等的

        $sql ="
        select `a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
        from flight as a 
        INNER JOIN airplane as b ON a.fName = b.airName
        INNER JOIN location as c ON a.toPlace = c.loId
        INNER JOIN location as d ON a.foPlace = d.loId 
        where a.date >= current_date() AND a.date <= DATE_ADD(CURRENT_DATE(), INTERVAL 3 MONTH)
        order by `a`.`date` ASC,`a`.`time` asc
        ";

        $flights = DB::select( $sql );
        return view("putshelf.index",['flights' => $flights]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function date(Request $request)
    {
        $put = $request->validate([
            'putdate' => 'required|date',
        ]);

        $sql ="
        select `a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
        from flight as a 
        INNER JOIN airplane as b ON a.fName = b.airName
        INNER JOIN location as c ON a.toPlace = c.loId
        INNER JOIN location as d ON a.foPlace = d.loId 
        where a.date = '$request->putdate'
        order by `a`.`date` ASC,`a`.`time` asc
        ";
        // //'2021-05-10' 記得加分號
        $flights = DB::select( $sql );
        //return view("putshelf.index",['flights' => $flights]);
        return redirect()->route('putshelf')->with(['flights' => $flights]); 
    }
    
    public function create()
    {
        //return view("putshelf.create");
        return view("putshelf.index");
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
            $foP = '1';
        elseif($request->apfo == '高雄(KHH)')  
            $foP = '2';  
        elseif($request->apfo == '台中(RMQ)')  
            $foP = '3';
        elseif($request->apfo == '花蓮(HUN)')  
            $foP = '4';
        elseif($request->apfo == '台東(TTT)')  
            $foP = '5';
        elseif($request->apfo == '澎湖(MZG)')  
            $foP = '6';
        elseif($request->apfo == '金門(KNH)')  
            $foP = '7';    

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
