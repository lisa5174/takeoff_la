<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class be_membersearch extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mId = session('mId');

        $airticket = DB::select("SELECT * FROM airtickets where mId = '$mId' order by aId asc");
        $airticketnum = DB::select("SELECT COUNT(*) AS num FROM airtickets where mId = '$mId'");
        
        $tickettypenum = [];
        $flight = [];
        $passengers = [];
        $contacts = [];
        $pays = [];
        for ($i=0; $i < $airticketnum[0]->num; $i++) {
            $fid = $airticket[$i]->fId;
            $f ="
            select `a`.`date`,`a`.`fName`,`c`.`loName` as `toplace`, `d`.`loName` as `foplace`,`a`.`fprice`, LEFT(a.time,5) AS Ltime 
            from flight as a 
            INNER JOIN airplane as b ON a.fName = b.airName
            INNER JOIN location as c ON a.toPlace = c.loId
            INNER JOIN location as d ON a.foPlace = d.loId 
            where a.fId = '$fid'
            ";
            $ff = DB::select($f);
            // $ff = array_map(function ($value) { //object轉array
            //     return (array)$value;
            // }, $ff);
            $flight[$i] = $ff[0];//讀取航班資料

            $aid = $airticket[$i]->aId;//讀取票種人數資料
            $t = 
            "SELECT b.tName,a.aNum
            FROM atickettype AS a
            INNER JOIN tickettype as b ON a.tId = b.tId
            WHERE aId = '$aid'";
            $tickettypenum[$i] = DB::select($t);


            if (($airticket[$i]->airpId) == null){ //讀取旅客資料
                $p = DB::select("select * from passenger where mId = '$mId'");
                $passengers[$i]=$p[0];
            }
            else{
                $pid = $airticket[$i]->airpId;
                $p = DB::select("select apId as pId,apName as pName,apgender as gender,apbirthday as birthday  
                from airpassenger where airpId = '$pid'");
                $passengers[$i]=$p[0];
            }

            if (($airticket[$i]->acId) == null){ //讀取聯絡人資料
                $p = DB::select("select * from contactperson where mId = '$mId'");
                $contacts[$i]=$p[0];
            }
            else{
                $pid = $airticket[$i]->acId;
                $p = DB::select("select acName as cName,acPhone as cPhone,acEmail as cEmail  
                from aircontactperson where acId = '$pid'");
                $contacts[$i]=$p[0];
            }

            if (($airticket[$i]->apayId) == null){ //讀取付款資料
                $p = DB::select("select * from payment as a INNER JOIN creditcard as b ON a.creType = b.creType where a.mId = '$mId'");
                $pays[$i]=$p[0];
            }
            else{
                $pid = $airticket[$i]->apayId;
                $p = DB::select(
                "select a.apayNumber as caNumber,a.apayValidityPeriod as validityPeriod,a.apayCheckCode as checkCode,b.creName 
                from airpayment as a
                INNER JOIN creditcard as b ON a.apayType = b.creType
                where a.apayId = '$pid'");
                $pays[$i]=$p[0];
            }

        }
        // $airticketnum[0]->num
        // return dd($airticketnum,$airticket,$flight,$tickettypenum,$passengers,$contacts,$pays);
        return view("be_membersearch.index",['airticketnum' => $airticketnum,
        'airticket' => $airticket,'flight' => $flight,'tickettypenum' => $tickettypenum,
        'passengers' => $passengers,'contacts' => $contacts,'pays' => $pays]);
    }

    public function checkoutsuccess(Request $request)
    {
        $choose = $request->all();
        // return dd(count($request->pid));
        // return dd($choose);
        $today = date('Ymd',strtotime("+8HOUR"));
        // return dd($today);
        $mId = session('mId');
        $passengers = DB::select("select * from passenger where mId = '$mId'");
        $contacts = DB::select("select * from contactperson where mId = '$mId'");
        $pays = DB::select("select * from payment where mId = '$mId'");

        $p=0;
        $c=0;
        $card=0;
        if (isset($passengers[0])){ //會員儲存的旅客資料存在!!!!
            if (($passengers[0]->pId == $request->pid[0])&&($passengers[0]->pName == $request->pname[0])&&
            ($passengers[0]->gender == $request->pgender[0])&&($passengers[0]->birthday == $request->pbirth[0])) {
                //旅客0沒變更會員儲存的旅客資料
                if (count($request->pid)==1) {//且只有一位旅客
                    $p = 0;
                }
                else $p = 2; //不只有一位旅客
            }
            else $p = 1;//全部有變更
        }
        else $p = 1;//全部有變更
        
        // return dd($p);

        if (isset($contacts[0])){ //會員儲存的聯絡人資料存在!!!!
            if (($contacts[0]->cName == $request->cname)&&($contacts[0]->cPhone == $request->cphone)&&
            ($contacts[0]->cEmail == $request->cemail)) {
                $c = 0;
            }
            else $c = 1;
        }
        else $c = 1;//有變更

        $period = $request->camonth.substr("$request->cayear", -2);//信用卡日期
        if (isset($contacts[0])){ //會員儲存信用卡資料存在!!!!
            if (($pays[0]->caNumber == $request->caid)&&($pays[0]->creType == $request->cretype)&&
            ($pays[0]->validityPeriod == $period)&&($pays[0]->checkCode == $request->cacheckcode)) {
                $card = 0;
            }
            else $card = 1;
        }
        else $card = 1;//有變更

        // return dd($p,$c,$card);
        
        $pid = [];
        $cid = 0;
        $cardid = 0;

        if ($p!=0) {
            $p==1?$x=0:$x=1;
            for ($i=$x; $i < count($request->pid); $i++) { 
                DB::table('airpassenger')->Insert(
                    [
                        'apId' => $request->pid[$i],
                        'apName' => $request->pname[$i],
                        'apgender' => $request->pgender[$i],
                        'apbirthday' => $request->pbirth[$i],
                    ]
                );
                $pid[$i+1] = DB::select('SELECT LAST_INSERT_ID() as id;'); //名稱一律都是id
            }
        }
        // return dd($pid[2]);

        if ($c==1) {
            DB::table('aircontactperson')->Insert(
                [
                    'acName' => $request->cname,
                    'acPhone' => $request->cphone,
                    'acEmail' => $request->cemail,
                ]
            );
            $cid = DB::select('SELECT LAST_INSERT_ID() as id;');
        }

        if ($card==1) {
            DB::table('airpayment')->Insert(
                [
                    'apayNumber' => $request->caid,
                    'apayType' => $request->cretype,
                    'apayValidityPeriod' => $period,
                    'apayCheckCode' => $request->cacheckcode,
                ]
            );
            $cardid = DB::select('SELECT LAST_INSERT_ID() as id;');
        }

        $d = "SELECT COUNT(*) as todaynum FROM airtickets WHERE date = CURRENT_DATE"; //todaynum今天已經有幾筆訂單
        $date = DB::select( $d );

        // return dd($today.($date[0]->todaynum+1));

        // $dlen = strlen($date[0]->todaynum+1); //今天訂單長度+1
        // return dd($dlen);
        
        // $zero = '';
        // for ($i=0; $i < (7-$dlen); $i++) { //7位元減今天訂單長度，要補幾個0
        //     $zero .= '0';
        // }
        // return dd($today.$zero.$date[0]->todaynum);

        // $dlen2 = strlen(($date[0]->todaynum)+2);
        // return dd($dlen2);
        
        // $zero2 = '';
        // for ($i=0; $i < (7-$dlen2); $i++) { 
        //     $zero2 .= '0';
        // }
        // return dd($zero2);

        // $aidto = $today.$zero.($date[0]->todaynum+1);
        // $aidfo = $today.$zero2.($date[0]->todaynum+2);
        // count($request->pid)

        $allnum=0;//全部新增機票數量
        for ($i=1; $i < 5; $i++) { //4圈ticket
            $t = 'toticket'.$i;
            if (isset($request->$t[0]) && ($request->$t[0]) != null) $num = $request->$t[1]; 
            //如果票種存在"而且"不等於null，num就等於此票種的數量
            else $num=0; //否則等於0
            // return dd($request->$t[0]);
            // return dd($num);

            for ($j=0; $j < $num; $j++) { //num是票種數量
                $allnum += 1;
                if (($i==1) && ($j==0) && ($p==2)) { //當旅客0 ($i==1) && ($j==0) 沒變更會員儲存的旅客資料($p==2)
                    $apid = null;
                }
                elseif($p==0) $apid = null; //旅客0沒變更會員儲存的旅客資料，且只有一位旅客
                else {
                    if (isset($pid[$i][0])) { //重要!!!否則會壞掉，需先判斷是否存在
                        $apid = $pid[$i][0]->id; //$pid從[1]儲存Insert進airpassenger的id
                    }
                    else $apid = null;
                }
                // return dd($pid[2][0]);
                // return dd($apid);
                
                if (($i==1) && ($j==0)) {
                    $bb = $request->quantity2; //在第一筆機票儲存嬰兒資料
                }
                else $bb = null;
                // return dd($bb);

                $dlen = strlen(($date[0]->todaynum)+$allnum); //今天訂單長度+這次購買第幾張

                $zero = '';
                for ($qq=0; $qq < (7-$dlen); $qq++) { //7位元減訂單長度，要補幾個0
                    $zero .= '0';
                }

                $aidto = $today.$zero.($date[0]->todaynum+$allnum); //訂單編號 = 今天date+0+今天訂單長度+這次購買第幾張

                DB::table('airtickets')->Insert(
                    [
                        'aId' => $aidto,
                        'fId' => $request->toId,
                        'tId' => $request->$t[0],
                        'baby' => $bb,
                        'mId' => $mId,
                        'airpId'=> $apid,
                        'acId' => ($c==1 ? $cid[0]->id : null),
                        'apayId' => ($card==1 ? $cardid[0]->id : null),
                        'date' => $today,
                    ]
                );
                
                $unseat = DB::select("select unboughtSeat from flight where fId = '$request->toId'");
                $addunseat = ($unseat[0]->unboughtSeat)+1;

                DB::table('flight')->where('fId', $request->toId)->update(
                    ['unboughtSeat' => $addunseat]
                );
        
            }
        }

        if (isset($request->foId)) {
            for ($i=1; $i < 5; $i++) { //4圈ticket
                $t = 'foticket'.$i;
                if (isset($request->$t[0]) && ($request->$t[0]) != null) $num = $request->$t[1]; 
                //如果票種存在"而且"不等於null，num就等於此票種的數量
                else $num=0; //否則等於0
                // return dd($request->$t[0]);
                // return dd($num);
    
                for ($j=0; $j < $num; $j++) { //num是票種數量
                    $allnum += 1;
                    if (($i==1) && ($j==0) && ($p==2)) { //當旅客0 ($i==1) && ($j==0) 沒變更會員儲存的旅客資料($p==2)
                        $apid = null;
                    }
                    elseif($p==0) $apid = null; //旅客0沒變更會員儲存的旅客資料，且只有一位旅客
                    else {
                        if (isset($pid[$i][0])) { //重要!!!否則會壞掉，需先判斷是否存在
                            $apid = $pid[$i][0]->id; //$pid從[1]儲存Insert進airpassenger的id
                        }
                        else $apid = null;
                    }
                    // return dd($pid[2][0]);
                    // return dd($apid);
                    
                    if (($i==1) && ($j==0)) {
                        $bb = $request->quantity2; //在第一筆機票儲存嬰兒資料
                    }
                    else $bb = null;
                    // return dd($bb);
    
                    $dlen = strlen(($date[0]->todaynum)+$allnum); //今天訂單長度+這次購買第幾張
    
                    $zero = '';
                    for ($qq=0; $qq < (7-$dlen); $qq++) { //7位元減訂單長度，要補幾個0
                        $zero .= '0';
                    }
    
                    $aidto = $today.$zero.($date[0]->todaynum+$allnum); //訂單編號 = 今天date+0+今天訂單長度+這次購買第幾張
    
                    DB::table('airtickets')->Insert(
                        [
                            'aId' => $aidto,
                            'fId' => $request->foId,
                            'tId' => $request->$t[0],
                            'baby' => $bb,
                            'mId' => $mId,
                            'airpId'=> $apid,
                            'acId' => ($c==1 ? $cid[0]->id : null),
                            'apayId' => ($card==1 ? $cardid[0]->id : null),
                            'date' => $today,
                        ]
                    );

                    $unseat = DB::select("select unboughtSeat from flight where fId = '$request->foId'");
                    $addunseat = ($unseat[0]->unboughtSeat)+1;
    
                    DB::table('flight')->where('fId', $request->foId)->update(
                        ['unboughtSeat' => $addunseat]
                    );
                }
            }
        }

        // return view("be_membersearch.index");
        // return redirect()->route('membersearch.index')->with('notice','機票購買成功!');
        return dd('機票購買成功');
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
