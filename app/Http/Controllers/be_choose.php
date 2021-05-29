<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class be_choose extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apto = $_GET["apto"];
        $apfo = $_GET["apfo"];
        $dateto = $_GET["dateto"];
        $quantity = $_GET["quantity"];
        $quantity2 = $_GET["quantity2"];
        
        if(!isset($_GET["datefo"])){  //如果回程日期是不存在
            $to ="
            select `a`.`fId`,`a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`status`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
            from flight as a 
            INNER JOIN airplane as b ON a.fName = b.airName
            INNER JOIN location as c ON a.toPlace = c.loId
            INNER JOIN location as d ON a.foPlace = d.loId 
            where a.toPlace = '$apto' and  a.foPlace = '$apfo' and  
            a.date = '$dateto'
            order by `a`.`date` ASC,`a`.`time` asc
            ";
            //'2021-05-10' 記得加分號
            //不要用重音符，有時會有錯

            $toflights = DB::select( $to );

            // return dd($toflights);
            return view("be_choose.index",['toflights' => $toflights]);
        }
        else{
            $datefo = $_GET["datefo"];
            $to ="
            select `a`.`fId`,`a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`status`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
            from flight as a 
            INNER JOIN airplane as b ON a.fName = b.airName
            INNER JOIN location as c ON a.toPlace = c.loId
            INNER JOIN location as d ON a.foPlace = d.loId 
            where a.toPlace = '$apto' and  a.foPlace = '$apfo' and  
            a.date = '$dateto'
            order by `a`.`date` ASC,`a`.`time` asc
            ";
            $fo ="
            select `a`.`fId`,`a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`status`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
            from flight as a 
            INNER JOIN airplane as b ON a.fName = b.airName
            INNER JOIN location as c ON a.toPlace = c.loId
            INNER JOIN location as d ON a.foPlace = d.loId 
            where a.toPlace = '$apfo' and  a.foPlace = '$apto' and  
            a.date = '$datefo'
            order by `a`.`date` ASC,`a`.`time` asc
            ";
            //'2021-05-10' 記得加分號
            //不要用重音符，有時會有錯

            $toflights = DB::select( $to );
            $foflights = DB::select( $fo );
            $toplace = DB::table('location')->select('loName')->where('loId',$apto)->get();
            $foplace = DB::table('location')->select('loName')->where('loId',$apfo)->get();

            // return dd($toplace);
            return view("be_choose.index",['toflights' => $toflights,'foflights' => $foflights,
            'toplace' => $toplace,'foplace' => $foplace,'dateto' => $dateto,'datefo' => $datefo]);
            // return dd($toflights,$foflights);
        }
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
        // $id = $_POST["id"];
        // return dd($id);
        return "store";
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
        return "edit";
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
