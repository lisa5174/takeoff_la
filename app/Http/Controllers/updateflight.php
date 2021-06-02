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

    public function store(Request $request)//查詢的結果
    {
        $put = $request->validate([
            'editname' => 'max:15',
            'editdate' => 'required|date|after_or_equal:today'//nullable 可為空
        ]);

        if($request->editname == ''){
            $sql ="
            select `a`.`fId`,`a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`status`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
            from flight as a 
            INNER JOIN airplane as b ON a.fName = b.airName
            INNER JOIN location as c ON a.toPlace = c.loId
            INNER JOIN location as d ON a.foPlace = d.loId 
            where a.date = '$request->editdate' AND a.status = 1
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
            where a.date = '$request->editdate' AND a.fName = '$request->editname' AND a.status = 1
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
    public function edit($id)//航班詳細資訊，以這個跳轉畫面onclick="location.href='{{route('updateflight.edit',$flight->fId)}}'"
    {
        $sql ="
        select `a`.`fId`,`a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`status`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
        from flight as a 
        INNER JOIN airplane as b ON a.fName = b.airName
        INNER JOIN location as c ON a.toPlace = c.loId
        INNER JOIN location as d ON a.foPlace = d.loId 
        where a.fID = '$id' AND a.date >= current_date() AND a.status = 1
        order by `a`.`date` ASC,`a`.`time` asc
        ";
        //'2021-05-10' 記得加分號
    
        $flights = DB::select( $sql );
        //isset($flights) v.s. empty($flights)

        return view("updateflight.edit",['flights' => $flights]);
    }
    public function update(Request $request, $id)//edit頁面，更新航班詳細資訊，可更改日期和時間
    {
        $put = $request->validate([
            'updatedate' => 'required|date|after_or_equal:today',//nullable 可為空
            'updatetime' => 'required'
        ]);

        
        DB::table('flight')->where('fId', $id)->update(
            [
                'date' => $request->updatedate,//'2021-04-08'
                'time' => $request->updatetime,//'07:36:00'
            ]
        );

        return redirect()->route('updateflight.index')->with('notice','航班修改成功!');
    }
}
