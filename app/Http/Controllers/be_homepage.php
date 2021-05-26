<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class be_homepage extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("be_homepage.index");
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
        $searchflights = $request->all();
        $put = $request->validate([
            'be_apto' => 'required|integer|between:1,7',
            'be_apfo' => 'required|integer|between:1,7',
            'dateto' => 'required|date|after_or_equal:today',
            'datefo' => 'nullable|date|after_or_equal:today|after_or_equal:dateto',
            'quantity' => 'required|integer|between:1,4',
            'quantity2' => 'required|integer|between:0,4|lte:quantity'
        ]);

        if(isset($request->be_apfo)){
            $to ="
            select `a`.`fId`,`a`.`date`,`a`.`fName`, `a`.`time`, `c`.`loName` as `toplace`, `d`.`loName` as `foplace`, `b`.`airSeat`, `a`.`unboughtSeat`, `a`.`status`, `a`.`fprice`, LEFT(a.time,5) AS Ltime 
            from flight as a 
            INNER JOIN airplane as b ON a.fName = b.airName
            INNER JOIN location as c ON a.toPlace = c.loId
            INNER JOIN location as d ON a.foPlace = d.loId 
            where a.toPlace = '$request->be_apto' and  a.foPlace = '$request->be_apfo' and  
            a.date = '$request->dateto'
            order by `a`.`date` ASC,`a`.`time` asc
            ";
            //'2021-05-10' 記得加分號
            //不要用重音符，有時會有錯

            $toflights = DB::select( $to );
            //$flights =$request->putdate; 

            // return dd($searchflights);
            // return view("be_choose.index",['toflights' => $toflights]);
            $x = 'aaa';
            return redirect()->route("choose.index",['id' => 1]);//router會帶參數
        }
        else{
            return dd($searchflights);


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
