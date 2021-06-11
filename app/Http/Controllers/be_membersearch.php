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
        return view("be_membersearch.index");
    }

    public function checkoutsuccess(Request $request)
    {
        $choose = $request->all();
        // return dd($choose);
        $today = date('YmdHis',strtotime("+8HOUR"));
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
            $p = 0;
        }
        else $p = 1;

        if (($contacts[0]->cName == $request->cname)&&($contacts[0]->cPhone == $request->cphone)&&
        ($contacts[0]->cEmail == $request->cemail)) {
            $c = 0;
        }
        else $c = 1;

        $period = $request->camonth.substr("$request->cayear", -2);
        if (($pays[0]->caNumber == $request->caid)&&($pays[0]->creType == $request->cretype)&&
        ($pays[0]->validityPeriod == $period)&&($pays[0]->checkCode == $request->cacheckcode)) {
            $card = 0;
        }
        else $card = 1;
        // return dd($p,$c,$card);
        

        DB::table('airtickets')->Insert(
            [
                'aId' => $request->mEmail,
                'aprice	' => $request->mPhone,
                'mId' => $request->mPhone,
                'fId' => $request->mPhone,
                $c==1 ? "'acId' => $request->mPhone" : "",
            ]
        );


        return view("be_membersearch.index");
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
