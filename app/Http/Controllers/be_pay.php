<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class be_pay extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mId = session('mId');

        $pays = DB::select(
        "select * from payment where mId = '$mId'");

        $choose = $request->all();
        // return dd($choose);
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

            'pname' => 'required|array',
            'pname.*' => 'required|string|distinct|max:15',
            'pgender' => 'required|array',
            'pgender.*' => 'required|boolean',
            'pid' => 'required|array',
            'pid.*' => 'required|tw_id|max:10',
            'pbirth' => 'required|array', 
            'pbirth.*' => 'required|date', 

            'cname' => 'required|string|max:15', 
            'cphone' => 'required|numeric|regex:/(09)[0-9]/|digits:10',
            'cemail' => 'required|email|max:35',
            'quantity' => 'required|integer|between:1,4', //成人
            'quantity2' => 'required|integer|between:0,4' //嬰兒
        ]);

        // return dd("YESSSSSSS");

        return view("be_pay.index",
        ['toId' => $request->toId,'foId' => $request->foId,'toticket1' => $request->toticket1,'toticket2' => $request->toticket2,
        'toticket3' => $request->toticket3,'toticket4' => $request->toticket4,
        'foticket1' =>$request->foticket1,'foticket2' =>$request->foticket2,
        'foticket3' =>$request->foticket3,'foticket4' =>$request->foticket4,
        'quantity' => $request->quantity,'quantity2' => $request->quantity2]
        ,['pname' => $request->pname,'pgender' => $request->pgender,'pid' => $request->pid,'pbirth' => $request->pbirth,
        'cname' => $request->cname,'cphone' => $request->cphone,'cemail' => $request->cemail,'pays' => $pays]);
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
