<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class be_member extends Controller
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
        $mId = session('mId');

        $members = DB::select("select * from member where mId = '$mId'");
        $passengers = DB::select("select * from passenger where mId = '$mId'");
        $contacts = DB::select("select * from contactperson where mId = '$mId'");
        $pays = DB::select(
        "select * from payment as a 
        INNER JOIN creditcard as b ON a.creType = b.creType
        where mId = '$mId'");

        // return dd($member);
        
        //'2021-05-10' 記得加分號
        //不要用重音符，有時會有錯

        $gender = '';
        if ($passengers[0]->gender == 1) {
            $gender = '男';
        }
        elseif($passengers[0]->gender == 0){
            $gender = '女';
        }
        

        return view('be_member.index', 
        ['mId' => $mId,'members' => $members,'passengers' => $passengers,
        'contacts' => $contacts,'pays' => $pays,
        'gender' => $gender]);
    }
    
    public function editmember(Request $request)
    {
        $choose = $request->all();
        // return dd($choose);
        $mId = session('mId');
        return view('be_member.index', ['mId' => $mId]);
    }

    public function updatemember(Request $request)
    {
        $choose = $request->all();
        // return dd($choose);
        $mId = session('mId');
        return view('be_member.index', ['mId' => $mId]);
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
