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
        if (($passengers[0]->pId == $request->pid)&&($passengers[0]->pName == $request->pname)&&
        ($passengers[0]->gender == $request->pgender)&&($passengers[0]->birthday == $request->pbirth)) {
            $p = 0;//沒變更會員儲存的旅客資料
        }
        else $p = 1;//有變更

        if (($contacts[0]->cName == $request->cname)&&($contacts[0]->cPhone == $request->cphone)&&
        ($contacts[0]->cEmail == $request->cemail)) {
            $c = 0;
        }
        else $c = 1;

        $period = $request->camonth.substr("$request->cayear", -2);//信用卡日期
        if (($pays[0]->caNumber == $request->caid)&&($pays[0]->creType == $request->cretype)&&
        ($pays[0]->validityPeriod == $period)&&($pays[0]->checkCode == $request->cacheckcode)) {
            $card = 0;
        }
        else $card = 1;
        // return dd($p,$c,$card);
        
        $pid = 0;
        $cid = 0;
        $cardid = 0;

        if ($p==1) {
            DB::table('airpassenger')->Insert(
                [
                    'apId' => $request->pid,
                    'apName' => $request->pname,
                    'apgender' => $request->pgender,
                    'apbirthday' => $request->pbirth,
                ]
            );
            $pid = DB::select('SELECT LAST_INSERT_ID() as id;');
        }

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

        $d = "SELECT COUNT(*) as todaynum FROM airtickets WHERE date = CURRENT_DATE";
        $date = DB::select( $d );

        // return dd($today.($date[0]->todaynum+1));

        $dlen = strlen($date[0]->todaynum+1);
        // return dd($dlen);
        
        $zero = '';
        for ($i=0; $i < (7-$dlen); $i++) { 
            $zero .= '0';
        }
        // return dd($today.$zero.$date[0]->todaynum);

        $dlen2 = strlen(($date[0]->todaynum)+2);
        // return dd($dlen2);
        
        $zero2 = '';
        for ($i=0; $i < (7-$dlen2); $i++) { 
            $zero2 .= '0';
        }
        // return dd($zero2);

        $aidto = $today.$zero.($date[0]->todaynum+1);
        $aidfo = $today.$zero2.($date[0]->todaynum+2);

        DB::table('airtickets')->Insert(
            [
                'aId' => $aidto,
                'aprice' => $request->tprice,
                'fId' => $request->toId,
                'mId' => $mId,
                'airpId'=> ($p==1 ? $pid[0]->id : null),
                'acId' => ($c==1 ? $cid[0]->id : null),
                'apayId' => ($card==1 ? $cardid[0]->id : null),
                'date' => $today,
            ]
        );

        for ($i=1; $i < 5; $i++) { 
            $t = 'toticket'.$i;
            if (!empty($request->$t[0])) {
                // return dd($request->$t[0]);
                // return dd($airticketidt[0]);
                DB::table('atickettype')->Insert(
                    [
                        'aId' => $aidto,
                        'tId' => $request->$t[0],
                        'aNum' => $request->$t[1],
                    ]
                );
            }
        }

        if (!empty($request->quantity2)) {
            DB::table('atickettype')->Insert(
                [
                    'aId' => $aidto,
                    'tId' => '1',
                    'aNum' => $request->quantity2,
                ]
            );
        }

        if (isset($request->foId)) {
            DB::table('airtickets')->Insert(
                [
                    'aId' => $aidfo,
                    'aprice' => $request->tprice,
                    'fId' => $request->foId,
                    'mId' => $mId,
                    'airpId'=> ($p==1 ? $pid[0]->id : null),
                    'acId' => ($c==1 ? $cid[0]->id : null),
                    'apayId' => ($card==1 ? $cardid[0]->id : null),
                    'date' => $today,
                ]
            );
    
            for ($i=1; $i < 5; $i++) { 
                $t = 'foticket'.$i;
                if (!empty($request->$t[0])) {
                    DB::table('atickettype')->Insert(
                        [
                            'aId' => $aidfo,
                            'tId' => $request->$t[0],
                            'aNum' => $request->$t[1],
                        ]
                    );
                }
            }

            if (!empty($request->quantity2)) {
                DB::table('atickettype')->Insert(
                    [
                        'aId' => $aidfo,
                        'tId' => '1',
                        'aNum' => $request->quantity2,
                    ]
                );
            }
        }

        // return view("be_membersearch.index");
        return redirect()->route('membersearch.index')->with('notice','機票購買成功!');
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
