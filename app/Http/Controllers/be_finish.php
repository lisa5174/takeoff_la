<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class be_finish extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $choose = $request->all();
        // return dd($choose);
        $thisyear = date("Y", strtotime("+8HOUR"));
        $put = $request->validate([
            'toId' => 'required|integer',//去程航班
            'toticket1' => 'required|array',
            'toticket2' => 'nullable|array',
            'toticket3' => 'nullable|array',
            'toticket4' => 'nullable|array',
            'foId' => 'nullable|integer',//回程航班
            'foticket1' => 'nullable|array',
            'foticket2' => 'nullable|array',
            'foticket3' => 'nullable|array',
            'foticket4' => 'nullable|array',
            'pname' => 'required|string|max:15',
            'pgender' => 'required',
            // ['required','regex:/[m]{1}|[f]{1}/'],
            'pname' => 'required|array',
            'pname.*' => 'required|string|distinct|max:15',
            'pgender' => 'required|array',
            'pgender.*' => 'required|boolean',
            'pid' => 'required|array',
            'pid.*' => 'required|tw_id|max:10',
            'pbirth' => 'required|array', 
            'pbirth.*' => 'required|date', 

            'quantity2' => 'required|integer|between:0,4', //嬰兒

            'cretype' => 'required|integer|between:1,4', 
            'camonth' => 'required|numeric|between:1,12|digits:2',//1到12的兩位數字 
            'cayear' => 'required|numeric|gte:'.$thisyear, 
            'id1' => 'required|size:4', 
            'id2' => 'required|size:4', 
            'id3' => 'required|size:4', 
            'id4' => 'required|size:4', 
            'cacheckcode' => 'required|between:3,4'
        ]);

        // return dd(strlen($request->cacheckcode));
        if ($request->cretype == 3 && strlen($request->cacheckcode) != 4) {
            return back()->withErrors(['檢查碼必須是 4 個字元。']);
        }
        if ($request->cretype != 3 && strlen($request->cacheckcode) == 4) {
            return back()->withErrors(['檢查碼必須是 3 個字元。']);
        }

        $to ="
        select `a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
        from flight as a 
        INNER JOIN airplane as b ON a.fName = b.airName
        INNER JOIN location as c ON a.toPlace = c.loId
        INNER JOIN location as d ON a.foPlace = d.loId 
        where a.fId = '$request->toId'
        ";

        $fo ="
        select `a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
        from flight as a 
        INNER JOIN airplane as b ON a.fName = b.airName
        INNER JOIN location as c ON a.toPlace = c.loId
        INNER JOIN location as d ON a.foPlace = d.loId 
        where a.fId = '$request->foId'
        ";
        // //'2021-05-10' 記得加分號
        // //不要用重音符，有時會有錯

        $toflights = DB::select( $to );
        $foflights = DB::select( $fo );

        $totic1 = $request->toticket1[0];
        $totic2 = $request->toticket2[0];
        $totic3 = $request->toticket3[0];
        $totic4 = $request->toticket4[0];
        $toticsql1 ="SELECT tName,tPrice FROM tickettype where tId = '$totic1'";
        $toticsql2 ="SELECT tName,tPrice FROM tickettype where tId = '$totic2'";
        $toticsql3 ="SELECT tName,tPrice FROM tickettype where tId = '$totic3'";
        $toticsql4 ="SELECT tName,tPrice FROM tickettype where tId = '$totic4'";
        $totickets[1] = DB::select( $toticsql1 );
        $totickets[2] = DB::select( $toticsql2 );
        $totickets[3] = DB::select( $toticsql3 );
        $totickets[4] = DB::select( $toticsql4 );

        $toprice = $toflights[0]->fprice;
        $tprice = 0;
        $tticket = [];
        for($i = 1; $i <= 4; $i++){
            if(!empty($totickets[$i])){
                $tprice += round(($totickets[$i][0]->tPrice)*($toprice));
                $tticket[$i] = $totickets[$i][0]->tName;
            }
        }


        $fprice = 0;
        $fticket = [];
        $fotickets = [];
        if(isset($request->foId)){
            $fotic1 = $request->foticket1[0];
            $fotic2 = $request->foticket2[0];
            $fotic3 = $request->foticket3[0];
            $fotic4 = $request->foticket4[0];
            $foticsql1 ="SELECT tName,tPrice FROM tickettype where tId = '$fotic1'";
            $foticsql2 ="SELECT tName,tPrice FROM tickettype where tId = '$fotic2'";
            $foticsql3 ="SELECT tName,tPrice FROM tickettype where tId = '$fotic3'";
            $foticsql4 ="SELECT tName,tPrice FROM tickettype where tId = '$fotic4'";
            $fotickets[1] = DB::select( $foticsql1 );
            $fotickets[2] = DB::select( $foticsql2 );
            $fotickets[3] = DB::select( $foticsql3 );
            $fotickets[4] = DB::select( $foticsql4 );

            $foprice = $foflights[0]->fprice;
            for($i = 1; $i <= 4; $i++){
                if(!empty($fotickets[$i])){
                    $fprice += round(($fotickets[$i][0]->tPrice)*($foprice));
                    $fticket[$i] = $fotickets[$i][0]->tName;
                } 
            }

        }
        
        $price[0] = $tprice + $fprice;
        $price[1] = $tprice;
        $price[2] = $fprice;
        $price[3] = $tticket;
        $price[4] = $fticket;
        // return dd($price);
        // return dd(count($price[3]));

        // $showgender = '';
        // if ($request->pgender == 1) $showgender = '男';
        // elseif ($request->pgender == 0) $showgender = '女';

        $cretype ="
        select creName from creditcard 
        where creType = '$request->cretype'
        ";
        $showcretypes = DB::select( $cretype );

        $caid[0] = $request->id1.$request->id2.$request->id3.$request->id4;
        $caid[1] = $request->id1;
        $caid[2] = $request->id2;
        $caid[3] = $request->id3;
        $caid[4] = $request->id4;

        return view("be_finish.index",
        ['toflights' => $toflights,'totickets' => $totickets,
        'foflights' => $foflights,'fotickets' => $fotickets,'price' => $price,
        'toId' => $request->toId,'foId' => $request->foId,
        'toticket1' => $request->toticket1,'toticket2' => $request->toticket2,
        'toticket3' => $request->toticket3,'toticket4' => $request->toticket4,
        'foticket1' =>$request->foticket1,'foticket2' =>$request->foticket2,
        'foticket3' =>$request->foticket3,'foticket4' =>$request->foticket4]
        ,['quantity2' => $request->quantity2,
        'pname' => $request->pname,'pgender' => $request->pgender,//'showgender' => $showgender,
        'pid' => $request->pid,'pbirth' => $request->pbirth,
        'cname' => $request->cname,'cphone' => $request->cphone,'cemail' => $request->cemail,
        'cretype' => $request->cretype,'showcretypes' => $showcretypes,
        'camonth' => $request->camonth,'cayear' => $request->cayear,'caid' => $caid,
        'cacheckcode' => $request->cacheckcode]);
        // return view("be_finish.index");
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
