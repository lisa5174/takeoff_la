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
        $mId = session('mId');

        $apto = $_GET["apto"];
        $apfo = $_GET["apfo"];
        $dateto = $_GET["dateto"];
        $quantity = $_GET["quantity"]; //成人
        $quantity2 = $_GET["quantity2"]; //嬰兒
        $differto = round(((strtotime($dateto) - strtotime("now"))/(60*60*24)),1); //相差去程時間
        $earlybirdto = 0; //早鳥
        $localearlybirdto = 0; //居民早鳥，提早15天

        if($differto > 30) {$earlybirdto = 6; $localearlybirdto = 12;}
        elseif($differto > 20) {$earlybirdto = 5; $localearlybirdto = 12;}
        elseif($differto > 15) {$earlybirdto = 4; $localearlybirdto = 12;}
        elseif($differto > 10) $earlybirdto = 3;
        
        $to ="
        select `a`.`fId`,`a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`status`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
        from flight as a 
        INNER JOIN airplane as b ON a.fName = b.airName
        INNER JOIN location as c ON a.toPlace = c.loId
        INNER JOIN location as d ON a.foPlace = d.loId
        INNER JOIN airplane as e ON a.fName = e.airName  
        where a.toPlace = '$apto' and  a.foPlace = '$apfo' and  
        a.date = '$dateto' AND a.status = 1 AND (a.unboughtSeat+$quantity) <= e.airSeat
        order by `a`.`date` ASC,`a`.`time` asc
        ";
        //'2021-05-10' 記得加分號
        //不要用重音符，有時會有錯

        $toflights = DB::select( $to );
        $toplace = DB::table('location')->select('loName')->where('loId',$apto)->get();
        $foplace = DB::table('location')->select('loName')->where('loId',$apfo)->get();
        $ticket1 = DB::table('tickettype')->select('tPrice')->where('tName','兒童')->get();// ->where('tId',16)
        $ticket2 = DB::table('tickettype')->select('tPrice')->where('tName','敬老')->get();
        $ticket3 = DB::table('tickettype')->select('tPrice')->where('tName','軍人')->get();
        $ticket4 = DB::table('tickettype')->select('tPrice')->where('tName','愛心')->get();
        $ticket5 = DB::table('tickettype')->select('tPrice')->where('tName','愛心陪同')->get();
        $ticket6 = DB::table('tickettype')->select('tName','tPrice')->where('tName','促銷(早鳥)優惠')->where('tId',$earlybirdto)->get();
        $ticket7 = DB::table('tickettype')->select('tPrice')->where('tName','離島居民')->get();
        $ticket8 = DB::table('tickettype')->select('tPrice')->where('tName','離島居民敬老')->get();
        $ticket9 = DB::table('tickettype')->select('tPrice')->where('tName','離島居民愛心')->get();
        $ticket10 = DB::table('tickettype')->select('tPrice')->where('tName','離島居民愛陪')->get();
        $ticket11 = DB::table('tickettype')->select('tName','tPrice')->where('tName','離島居民促銷優惠')->where('tId',$localearlybirdto)->get();

        if(!isset($_GET["datefo"])){  //如果回程日期不存在
            return view("be_choose.index",['toflights' => $toflights,'toplace' => $toplace,'foplace' => $foplace,'dateto' => $dateto,
            'ticket1' => $ticket1,'ticket2' => $ticket2,'ticket3' => $ticket3,'ticket4' => $ticket4,'ticket5' => $ticket5,
            'ticket6' => $ticket6,'ticket7' => $ticket7,'ticket8' => $ticket8,'ticket9' => $ticket9,'ticket10' => $ticket10,
            'ticket11' => $ticket11]
            ,['quantity' => $quantity,'quantity2' => $quantity2,'mId' => $mId]);
        }
        else{
            $datefo = $_GET["datefo"];

            return view("be_choose.index",['toflights' => $toflights,'toplace' => $toplace,'foplace' => $foplace,'dateto' => $dateto,
            'ticket1' => $ticket1,'ticket2' => $ticket2,'ticket3' => $ticket3,'ticket4' => $ticket4,'ticket5' => $ticket5,
            'ticket6' => $ticket6,'ticket7' => $ticket7,'ticket8' => $ticket8,'ticket9' => $ticket9,'ticket10' => $ticket10,
            'ticket11' => $ticket11]
            ,['quantity' => $quantity,'quantity2' => $quantity2,'apfo' => $apto,'apto' => $apfo,'datefo' => $datefo,'mId' => $mId]);
        }
    }



    public function index2(Request $request)
    {
        $mId = session('mId');

        $choose = $request->all();
        // return dd($choose);
        $put = $request->validate([
            'apId' => 'required|integer',//去程航班
            'apto' => 'nullable|integer', //回程出發地點
            'apfo' => 'nullable|integer', //回程目的地點
            'datefo' => 'nullable|date|after:today', //回程日期
            'ticket2' => 'required|integer|between:0,4',
            'ticket3' => 'nullable|integer|between:0,4',
            'ticket4' => 'nullable|integer|between:0,4',
            'ticket5' => 'nullable|integer|between:0,4', 
            'ticket6' => 'nullable|integer|between:0,4', 
            'ticket7' => 'nullable|integer|between:0,4',
            'ticket8' => 'nullable|integer|between:0,4',
            'ticket9' => 'nullable|integer|between:0,4',//愛心
            'ticket10' => 'nullable|integer|between:0,4', //愛陪
            'ticket11' => 'nullable|integer|between:0,4', 
            'ticket12' => 'nullable|integer|between:0,4',
            'ticket13' => 'nullable|integer|between:0,4',
            'ticket14' => 'nullable|integer|between:0,4',//愛心
            'ticket15' => 'nullable|integer|between:0,4',//愛陪
            'ticket16' => 'nullable|integer|between:0,4',//兒童
            'quantity' => 'required|integer|between:1,4', //成人
            'quantity2' => 'required|integer|between:0,4|lte:quantity' //嬰兒
        ]);

        $i = 1;
        $cnt = 0;
        $hasnumto = 0;
        $haspeopleto = [];
        for($i = 2; $i <= 16; $i++) {
            $t = "ticket";
            $x = $t.$i;
            $cnt += $request->$x; //計算總人數
            if(($request->$x) != 0){
                $haspeopleto[$hasnumto] = $i; //統計哪些票種有訂購
                $hasnumto += 1;
            }
        }

        if ($cnt != $request->quantity) {
            return back()->withErrors(['旅客人數不符， 總人數應為'.$request->quantity.'人。您現選擇'.$cnt.'人']);
        }
        if($request->ticket10 != 0){
            if($request->ticket9 == 0) return back()->withErrors(['愛心陪同票必須與愛心票同時訂購']);
            elseif($request->ticket10 > $request->ticket9) return back()->withErrors(['每一名愛心票，僅可享有一名愛心陪同票優惠']);
        }
        if($request->ticket15 != 0){
            if($request->ticket14 == 0) return back()->withErrors(['愛心陪同票必須與愛心票同時訂購']);
            elseif($request->ticket15 > $request->ticket14) return back()->withErrors(['每一名愛心票，僅可享有一名愛心陪同票優惠']);
        }

        // return dd($haspeopleto);
        // return dd($request->ticket + $request->ticket2);
        // return dd($choose);

        $numto = count($haspeopleto);//數陣列內容

        // return dd($numto);
        if((!isset( $request->datefo)) && (!isset( $request->apto)) && (!isset( $request->apfo))){  //如果回程不存在
            switch($numto)
            {
                case 1:
                    $a = "ticket".$haspeopleto[0];
                    return redirect()->route("order.index",['toId' => $request->apId,'toticket1' =>[$haspeopleto[0],$request->$a],
                    'toticket2' =>['',''],'toticket3' =>['',''],'toticket4' =>['',''],'quantity' => $request->quantity,
                    'quantity2' => $request->quantity2]);//router會帶參數
                case 2:
                    $a = "ticket".$haspeopleto[0];
                    $b = "ticket".$haspeopleto[1];
                    return redirect()->route("order.index",['toId' => $request->apId,'toticket1' =>[$haspeopleto[0],$request->$a],
                    'toticket2' =>[$haspeopleto[1],$request->$b],'toticket3' =>['',''],'toticket4' =>['',''],
                    'quantity' => $request->quantity,'quantity2' => $request->quantity2]);//router會帶參數
                case 3:
                    $a = "ticket".$haspeopleto[0];
                    $b = "ticket".$haspeopleto[1];
                    $c = "ticket".$haspeopleto[2];
                    return redirect()->route("order.index",['toId' => $request->apId,'toticket1' =>[$haspeopleto[0],$request->$a],
                    'toticket2' =>[$haspeopleto[1],$request->$b],'toticket3' =>[$haspeopleto[2],$request->$c],'toticket4' =>['',''],
                    'quantity' => $request->quantity,'quantity2' => $request->quantity2]);//router會帶參數
                case 4:
                    $a = "ticket".$haspeopleto[0];
                    $b = "ticket".$haspeopleto[1];
                    $c = "ticket".$haspeopleto[2];
                    $d = "ticket".$haspeopleto[3];
                    return redirect()->route("order.index",['toId' => $request->apId,'toticket1' =>[$haspeopleto[0],$request->$a],
                    'toticket2' =>[$haspeopleto[1],$request->$b],'toticket3' =>[$haspeopleto[2],$request->$c],
                    'toticket4' =>[$haspeopleto[3],$request->$d],'quantity' => $request->quantity,
                    'quantity2' => $request->quantity2]);//router會帶參數
            }
            
            // return dd($request->$a);
            // return redirect()->route("order.index",['toId' => $request->apId,'toticket1' =>[$haspeopleto[0],$request->$a],
            // 'toticket2' =>[$haspeopleto[1],$request->$b],'quantity2' => $request->quantity2]);//router會帶參數
            // return "不存在";
            
        }
        elseif((isset( $request->datefo)) && (isset( $request->apto)) && (isset( $request->apfo))){ //如果回程存在
            
            $differfo =round(((strtotime($request->datefo) - strtotime("now"))/(60*60*24)),1); //相差回程時間
            $earlybirdfo = 0;
            $localearlybirdfo = 0;
            
            if($differfo > 30) {$earlybirdfo = 6; $localearlybirdfo = 12;}
            elseif($differfo > 20) {$earlybirdfo = 5; $localearlybirdfo = 12;}
            elseif($differfo > 15) {$earlybirdfo = 4; $localearlybirdfo = 12;}
            elseif($differfo > 10) $earlybirdfo = 3;

            // return dd($differfo);
            // return dd($differfo,$earlybirdfo,$localearlybirdfo);

            $fo ="
            select `a`.`fId`,`a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`status`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
            from flight as a 
            INNER JOIN airplane as b ON a.fName = b.airName
            INNER JOIN location as c ON a.toPlace = c.loId
            INNER JOIN location as d ON a.foPlace = d.loId 
            where a.toPlace = '$request->apto' and  a.foPlace = '$request->apfo' and  
            a.date = '$request->datefo' AND a.status = 1
            order by `a`.`date` ASC,`a`.`time` asc
            ";
            // //'2021-05-10' 記得加分號
            // //不要用重音符，有時會有錯

            $foflights = DB::select( $fo );
            $toplace = DB::table('location')->select('loName')->where('loId',$request->apto)->get();
            $foplace = DB::table('location')->select('loName')->where('loId',$request->apfo)->get();
            $ticket1 = DB::table('tickettype')->select('tPrice')->where('tName','兒童')->get();// ->where('tId',16)
            $ticket2 = DB::table('tickettype')->select('tPrice')->where('tName','敬老')->get();
            $ticket3 = DB::table('tickettype')->select('tPrice')->where('tName','軍人')->get();
            $ticket4 = DB::table('tickettype')->select('tPrice')->where('tName','愛心')->get();
            $ticket5 = DB::table('tickettype')->select('tPrice')->where('tName','愛心陪同')->get();
            $ticket6 = DB::table('tickettype')->select('tName','tPrice')->where('tName','促銷(早鳥)優惠')->where('tId',$earlybirdfo)->get();
            $ticket7 = DB::table('tickettype')->select('tPrice')->where('tName','離島居民')->get();
            $ticket8 = DB::table('tickettype')->select('tPrice')->where('tName','離島居民敬老')->get();
            $ticket9 = DB::table('tickettype')->select('tPrice')->where('tName','離島居民愛心')->get();
            $ticket10 = DB::table('tickettype')->select('tPrice')->where('tName','離島居民愛陪')->get();
            $ticket11 = DB::table('tickettype')->select('tName','tPrice')->where('tName','離島居民促銷優惠')->where('tId',$localearlybirdfo)->get();

            //to用hidden傳，fo到login.blade.php(order)判斷，並以hidden傳

            $tvalue = [];
            $vtype = ['','2','16','7','8','9','10',[],'11','13','14','15','12'];
            $vtype[7] = ['3','4','5','6'];
            // return ($vtype);
            for ($i=1; $i <= 12; $i++) {
                if ($i == 7) {
                    for ($j=0; $j < 4; $j++) {
                        $t = "ticket";
                        $x = $t.$vtype[$i][$j]; 
                        if(isset($request->$x)) $tvalue[$i] = $request->$x;
                    }
                    if(empty($tvalue[$i])) $tvalue[$i] = '0';
                }
                else{
                    $t = "ticket";
                    $x = $t.$vtype[$i];
                    if(isset($request->$x)) $tvalue[$i] = $request->$x;
                    else $tvalue[$i] = '0';
                }
            
            }
            // return dd($tvalue);

            switch($numto)
            {
                case 1:
                    $a = "ticket".$haspeopleto[0];
                    return view("be_choose.index2",['foflights' => $foflights,'toplace' => $toplace,'foplace' => $foplace,'dateto' => $request->datefo,
                    'ticket1' => $ticket1,'ticket2' => $ticket2,'ticket3' => $ticket3,'ticket4' => $ticket4,'ticket5' => $ticket5,
                    'ticket6' => $ticket6,'ticket7' => $ticket7,'ticket8' => $ticket8,'ticket9' => $ticket9,'ticket10' => $ticket10,
                    'ticket11' => $ticket11]
                    ,['tvalue' => $tvalue,
                    'quantity' => $request->quantity,
                    'toId' => $request->apId,'toticket1' =>[$haspeopleto[0],$request->$a],
                    'toticket2' =>['',''],'toticket3' =>['',''],'toticket4' =>['',''],'quantity2' => $request->quantity2,'mId' => $mId]);//router會帶參數
                case 2:
                    $a = "ticket".$haspeopleto[0];
                    $b = "ticket".$haspeopleto[1];
                    return view("be_choose.index2",['foflights' => $foflights,'toplace' => $toplace,'foplace' => $foplace,'dateto' => $request->datefo,
                    'ticket1' => $ticket1,'ticket2' => $ticket2,'ticket3' => $ticket3,'ticket4' => $ticket4,'ticket5' => $ticket5,
                    'ticket6' => $ticket6,'ticket7' => $ticket7,'ticket8' => $ticket8,'ticket9' => $ticket9,'ticket10' => $ticket10,
                    'ticket11' => $ticket11]
                    ,['tvalue' => $tvalue,
                    'quantity' => $request->quantity,
                    'toId' => $request->apId,'toticket1' =>[$haspeopleto[0],$request->$a],
                    'toticket2' =>[$haspeopleto[1],$request->$b],'toticket3' =>['',''],'toticket4' =>['',''],
                    'quantity2' => $request->quantity2,'mId' => $mId]);
                case 3:
                    $a = "ticket".$haspeopleto[0];
                    $b = "ticket".$haspeopleto[1];
                    $c = "ticket".$haspeopleto[2];
                    return view("be_choose.index2",['foflights' => $foflights,'toplace' => $toplace,'foplace' => $foplace,'dateto' => $request->datefo,
                    'ticket1' => $ticket1,'ticket2' => $ticket2,'ticket3' => $ticket3,'ticket4' => $ticket4,'ticket5' => $ticket5,
                    'ticket6' => $ticket6,'ticket7' => $ticket7,'ticket8' => $ticket8,'ticket9' => $ticket9,'ticket10' => $ticket10,
                    'ticket11' => $ticket11]
                    ,['tvalue' => $tvalue,
                    'quantity' => $request->quantity,
                    'toId' => $request->apId,'toticket1' =>[$haspeopleto[0],$request->$a],
                    'toticket2' =>[$haspeopleto[1],$request->$b],'toticket3' =>[$haspeopleto[2],$request->$c],'toticket4' =>['',''],
                    'quantity2' => $request->quantity2,'mId' => $mId]);
                case 4:
                    $a = "ticket".$haspeopleto[0];
                    $b = "ticket".$haspeopleto[1];
                    $c = "ticket".$haspeopleto[2];
                    $d = "ticket".$haspeopleto[3];
                    return view("be_choose.index2",['foflights' => $foflights,'toplace' => $toplace,'foplace' => $foplace,'dateto' => $request->datefo,
                    'ticket1' => $ticket1,'ticket2' => $ticket2,'ticket3' => $ticket3,'ticket4' => $ticket4,'ticket5' => $ticket5,
                    'ticket6' => $ticket6,'ticket7' => $ticket7,'ticket8' => $ticket8,'ticket9' => $ticket9,'ticket10' => $ticket10,
                    'ticket11' => $ticket11]
                    ,['tvalue' => $tvalue,
                    'quantity' => $request->quantity,
                    'toId' => $request->apId,'toticket1' =>[$haspeopleto[0],$request->$a],
                    'toticket2' =>[$haspeopleto[1],$request->$b],'toticket3' =>[$haspeopleto[2],$request->$c],
                    'toticket4' =>[$haspeopleto[3],$request->$d],'quantity2' => $request->quantity2,'mId' => $mId]);
            }
        }
        else{
            return "抱歉，出現不可預期的錯誤，請返回上一頁或關閉網頁重新進入";
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
