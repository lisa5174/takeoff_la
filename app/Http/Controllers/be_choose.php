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
        $quantity = $_GET["quantity"]; //成人
        $quantity2 = $_GET["quantity2"]; //嬰兒
        $differto = round(((strtotime($dateto) - strtotime("now"))/(60*60*24)),1); //相差去程時間
        $earlybirdto = 0; //早鳥
        $localearlybirdto = 0; //居民早鳥，提早15天

        if($differto > 10) $earlybirdto = 3;
        elseif($differto > 15) {$earlybirdto = 4; $localearlybirdto = 12;}
        elseif($differto > 20) {$earlybirdto = 5; $localearlybirdto = 12;}
        elseif($differto > 30) {$earlybirdto = 6; $localearlybirdto = 12;}

        // return dd($earlybirdto,$localearlybirdto);
        
        if(!isset($_GET["datefo"])){  //如果回程日期不存在
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
            $differfo =round(((strtotime($datefo) - strtotime("now"))/(60*60*24)),1); //相差回程時間
            $earlybirdfo = 0;
            $localearlybirdfo = 0;

            if($differfo > 10) $earlybirdfo = 3;
            elseif($differfo > 15) {$earlybirdfo = 4; $localearlybirdfo = 12;}
            elseif($differfo > 20) {$earlybirdfo = 5; $localearlybirdfo = 12;}
            elseif($differfo > 30) {$earlybirdfo = 6; $localearlybirdfo = 12;}

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
            $ticket1 = DB::table('tickettype')->select('tPrice')->where('tName','兒童')->get();// ->where('tId',16)
            $ticket2 = DB::table('tickettype')->select('tPrice')->where('tName','敬老')->get();
            $ticket3 = DB::table('tickettype')->select('tPrice')->where('tName','軍人')->get();
            $ticket4 = DB::table('tickettype')->select('tPrice')->where('tName','愛心')->get();
            $ticket5 = DB::table('tickettype')->select('tPrice')->where('tName','愛心陪同')->get();
            $ticket6 = DB::table('tickettype')->select('tPrice')->where('tName','促銷(早鳥)優惠')->where('tId',$earlybirdfo)->get();
            $ticket7 = DB::table('tickettype')->select('tPrice')->where('tName','離島居民')->get();
            $ticket8 = DB::table('tickettype')->select('tPrice')->where('tName','離島居民敬老')->get();
            $ticket9 = DB::table('tickettype')->select('tPrice')->where('tName','離島居民愛心')->get();
            $ticket10 = DB::table('tickettype')->select('tPrice')->where('tName','離島居民愛陪')->get();
            $ticket11 = DB::table('tickettype')->select('tPrice')->where('tName','離島居民促銷優惠')->where('tId',$localearlybirdfo)->get();
            
            return view("be_choose.index",['toflights' => $toflights,'toplace' => $toplace,'foplace' => $foplace,'dateto' => $dateto,
            'ticket1' => $ticket1,'ticket2' => $ticket2,'ticket3' => $ticket3,'ticket4' => $ticket4,'ticket5' => $ticket5,
            'ticket6' => $ticket6,'ticket7' => $ticket7,'ticket8' => $ticket8,'ticket9' => $ticket9,'ticket10' => $ticket10,
            'ticket11' => $ticket11]
            ,['quantity' => $quantity,'quantity2' => $quantity2,'apfo' => $apto,'apto' => $apfo,'datefo' => $datefo]);
        }
    }



    public function index2(Request $request)
    {
        $choose = $request->all();
        $put = $request->validate([
            'apId' => 'required|integer',
            'ticket1' => 'required|integer|between:0,4',
            'ticket2' => 'required|integer|between:0,4',
            'ticket3' => 'required|integer|between:0,4',
            'ticket4' => 'required|integer|between:0,4',
            'ticket5' => 'required|integer|between:0,4',
            'ticket6' => 'required|integer|between:0,4',
            'ticket7' => 'nullable|integer|between:0,4',
            'ticket8' => 'required|integer|between:0,4',
            'ticket9' => 'required|integer|between:0,4',
            'ticket10' => 'required|integer|between:0,4',
            'ticket11' => 'required|integer|between:0,4',
            'ticket12' => 'nullable|integer|between:0,4',
            'quantity' => 'required|integer|between:1,4', //成人
            'quantity2' => 'required|integer|between:0,4|lte:quantity' //嬰兒
        ]);

        // return redirect()->route("choose.index",['apto' => $request->be_apto,'apfo' => $request->be_apfo,'dateto' => $request->dateto,
        // 'datefo' => $request->datefo,'quantity' => $request->quantity,'quantity2' => $request->quantity2]);//router會帶參數

        $i = 1;
        $cnt = 0;
        for($i = 1; $i <= 12; $i++) {
            $t = "ticket";
            $x = $t.$i;
            $cnt += $request->$x;
        }

        if ($cnt != $request->quantity) {
            return back()->withErrors(['旅客人數不符， 總人數應為'.$request->quantity.'人。您現選擇'.$cnt.'人']);
            return redirect()->route('choose.index')
            ->with('no','旅客人數不符， 總人數應為'.$request->quantity.'人。您現選擇5人');
        }
        // return dd($request->ticket + $request->ticket2);
        // return dd($choose);
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
        $choose = $request->all();
        
        return dd($choose);
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
