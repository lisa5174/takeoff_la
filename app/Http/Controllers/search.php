<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class search extends Controller
{
    public function index()
    {
        //$flights = '還沒搜尋';
        $airplane ="
        SELECT airName FROM airplane
        ";
        //不要用重音符，有時會有錯

        $airplanes = DB::select( $airplane );

        return view('search.search',['airplanes' => $airplanes]);//,['flights' => $flights]
    }
    public function store(Request $request)
    {
        $put = $request->validate([
            'putname' => 'max:15',
            'putdate' => 'required|date',
        ]);

        if($request->putname == ''){
            $sql ="
            select `a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`status`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
            from flight as a 
            INNER JOIN airplane as b ON a.fName = b.airName
            INNER JOIN location as c ON a.toPlace = c.loId
            INNER JOIN location as d ON a.foPlace = d.loId 
            where a.date = '$request->putdate' 
            order by `a`.`date` ASC,`a`.`time` asc
            ";
            //'2021-05-10' 記得加分號

            $airplane ="
            SELECT airName FROM airplane
            ";
            //不要用重音符，有時會有錯

            $flights = DB::select( $sql );
            //$flights =$request->putdate; 
            $airplanes = DB::select( $airplane );
            //isset($flights) v.s. empty($flights)

            return view("search.search",['airplanes' => $airplanes],['flights' => $flights]);
            //return redirect()->route('putshelf'); 
        }
        else{
            $sql ="
            select `a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`status`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
            from flight as a 
            INNER JOIN airplane as b ON a.fName = b.airName
            INNER JOIN location as c ON a.toPlace = c.loId
            INNER JOIN location as d ON a.foPlace = d.loId 
            where a.date = '$request->putdate' AND a.fName = '$request->putname'
            order by `a`.`date` ASC,`a`.`time` asc
            ";
            //'2021-05-10' 記得加分號

            $airplane ="
            SELECT airName FROM airplane
            ";
            //不要用重音符，有時會有錯
    
            $flights = DB::select( $sql );
            //$flights =$request->putdate; 
            $airplanes = DB::select( $airplane );
            //isset($flights) v.s. empty($flights)

            return view("search.search",['airplanes' => $airplanes],['flights' => $flights]);
            //return redirect()->route('putshelf'); 
        }

        
    }
}
