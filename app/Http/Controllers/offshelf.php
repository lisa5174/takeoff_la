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

        $already ="(
        select `a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
        from flight as a 
        INNER JOIN airplane as b ON a.fName = b.airName
        INNER JOIN location as c ON a.toPlace = c.loId
        INNER JOIN location as d ON a.foPlace = d.loId 
        where a.date <= current_date() AND a.date >= DATE_SUB(CURRENT_DATE(), INTERVAL 3 MONTH) 
        order by `a`.`date` desc,`a`.`time` desc
        )  ";
        //as already
        $airplane ="
        SELECT airName FROM airplane
        ";

        //AND a.status = 0
        $offs = DB::select( $off );
        $alreadyoffs = DB::select( $already);
        // $alreadyoffs = DB::table( DB::raw($already))->paginate(3);
        $airplanes = DB::select( $airplane );
        return view("offshelf.index",['airplanes' => $airplanes,'offs' => $offs,'alreadyoffs' => $alreadyoffs]);
        // return view("offshelf.test",['alreadyoffs' => $alreadyoffs]);
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
        $put = $request->validate([
            'editname' => 'max:15',
            'editdate' => 'required|date|after_or_equal:today'//nullable 可為空
        ]);

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

        $alreadyoffs = DB::select( $already );
        $airplanes = DB::select( $airplane );

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

            $offs = DB::select( $sql );
            //$flights =$request->putdate; 

            //isset($flights) v.s. empty($flights)

            return view("offshelf.index",['airplanes' => $airplanes,'offs' => $offs,'alreadyoffs' => $alreadyoffs]);
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

            $offs = DB::select( $sql );
            
            //isset($flights) v.s. empty($flights)
    
            //return view("offshelfs.index",['airplanes' => $airplanes],['flights' => $flights]);
            return view("offshelf.index",['airplanes' => $airplanes,'offs' => $offs,'alreadyoffs' => $alreadyoffs]);
        }

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
        if(isset($request->checkbox)){
            $num = count($request->input('checkbox'));//數陣列內容
            $delete = $request->input('checkbox');
            $i = 0;
            for($i=0;$i<$num;$i++){
                DB::table('flight')->where('fId', $delete[$i])->update(
                    [
                        'status' => 0
                    ]
                );
            }
            return redirect()->route('offshelfs.index')->with('notice','航班刪除成功!');
        }
        else
            return redirect()->route('offshelfs.index')->with('no','未選取航班!');
    }
}
