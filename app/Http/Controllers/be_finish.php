<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'pid' => 'required|tw_id',
            'pbirth' => 'required|date', 
            'cname' => 'required|string|max:15', 
            'cphone' => 'required|numeric|regex:/(09)[0-9]/|digits:10',
            'cemail' => 'required|email|max:35',
            'quantity2' => 'required|integer|between:0,4', //嬰兒

            'cretype' => 'required|integer|between:1,4', 
            'camonth' => 'required|numeric|between:1,12', 
            'cayear' => 'required|numeric|gte:'.$thisyear, 
            'id1' => 'required|size:4', 
            'id2' => 'required|size:4', 
            'id3' => 'required|size:4', 
            'id4' => 'required|size:4', 
            'cacheckcode' => 'required|size:3'
        ]);

        

        $caid[0] = $request->id1.$request->id2.$request->id3.$request->id4;
        $caid[1] = $request->id1;
        $caid[2] = $request->id2;
        $caid[3] = $request->id3;
        $caid[4] = $request->id4;

        return view("be_finish.index",
        ['toId' => $request->toId,'foId' => $request->foId,'toticket1' => $request->toticket1,'toticket2' => $request->toticket2,
        'toticket3' => $request->toticket3,'toticket4' => $request->toticket4,
        'foticket1' =>$request->foticket1,
        'foticket2' =>$request->foticket2,'foticket3' =>$request->foticket3,
        'foticket4' =>$request->foticket4,'quantity2' => $request->quantity2]
        ,['pname' => $request->pname,'pgender' => $request->pgender,'pid' => $request->pid,'pbirth' => $request->pbirth,
        'cname' => $request->cname,'cphone' => $request->cphone,'cemail' => $request->cemail,
        'cretype' => $request->cretype,'camonth' => $request->camonth,'cayear' => $request->cayear,'caid' => $caid,
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
