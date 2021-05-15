<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class updateflight extends Controller
{
    public function index()
    {
        $sql ="
        select `a`.`fId`,`a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
        from flight as a 
        INNER JOIN airplane as b ON a.fName = b.airName
        INNER JOIN location as c ON a.toPlace = c.loId
        INNER JOIN location as d ON a.foPlace = d.loId 
        where a.date >= current_date() AND a.date <= DATE_ADD(CURRENT_DATE(), INTERVAL 3 MONTH) AND a.status = 1
        order by `a`.`date` ASC,`a`.`time` asc
        ";

        $airplane ="
        SELECT airName FROM airplane
        ";
        //不要用重音符，有時會有錯

        $flights = DB::select( $sql );
        $airplanes = DB::select( $airplane );
        return view("updateflight.index",['airplanes' => $airplanes],['flights' => $flights]);

    }

    public function store(Request $request)
    {
        $put = $request->validate([
            'updatename' => 'max:15',
            'updatedate' => 'required|date|after_or_equal:today'//nullable 可為空
        ]);

        if($request->updatename == ''){
            $sql ="
            select `a`.`fId`,`a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`status`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
            from flight as a 
            INNER JOIN airplane as b ON a.fName = b.airName
            INNER JOIN location as c ON a.toPlace = c.loId
            INNER JOIN location as d ON a.foPlace = d.loId 
            where a.date = '$request->updatedate' AND a.status = 1
            order by `a`.`date` ASC,`a`.`time` asc
            ";
            //'2021-05-10' 記得加分號
            $airplane ="
            SELECT airName FROM airplane
            ";

            $flights = DB::select( $sql );
            $airplanes = DB::select( $airplane );
            //$flights =$request->putdate; 

            //isset($flights) v.s. empty($flights)

            return view("updateflight.index",['airplanes' => $airplanes],['flights' => $flights]);
        }
        else{
            $sql ="
            select `a`.`fId`,`a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`status`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
            from flight as a 
            INNER JOIN airplane as b ON a.fName = b.airName
            INNER JOIN location as c ON a.toPlace = c.loId
            INNER JOIN location as d ON a.foPlace = d.loId 
            where a.date = '$request->updatedate' AND a.fName = '$request->updatename' AND a.status = 1
            order by `a`.`date` ASC,`a`.`time` asc
            ";
            //'2021-05-10' 記得加分號
            $airplane ="
            SELECT airName FROM airplane
            ";
    
            $flights = DB::select( $sql );
            $airplanes = DB::select( $airplane );
            //isset($flights) v.s. empty($flights)
    
            return view("updateflight.index",['airplanes' => $airplanes],['flights' => $flights]);
        }

    }
    public function edit($id)
    {

        // return view("updateflight.edit",['id' => $id]);
        return dd($id);
    }
    public function update(Request $request, $id)
    {
        return 'I am update.';
    }
}
