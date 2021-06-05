<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class be_order extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //單程
    {
        $toId = $_GET["toId"];
        $toticket1 = $_GET["toticket1"];
        $toticket2 = $_GET["toticket2"];
        $toticket3 = $_GET["toticket3"];
        $toticket4 = $_GET["toticket4"];
        $quantity2 = $_GET['quantity2'];
        // if(empty($toticket2))   
        return view("be_order.index",
        ['toId' => $toId,'toticket1' => $toticket1,'toticket2' => $toticket2,
        'toticket3' => $toticket3,'toticket4' => $toticket4,'quantity2' => $quantity2]);
        return dd($toId,$toticket1,$toticket2,$toticket3,$toticket4);
        return view("be_order.index");
    }

    public function index2(Request $request) //來回
    {
        $choose = $request->all();
        // return dd($choose);
        $put = $request->validate([
            'toId' => 'required|integer',//去程航班
            'toticket1' => 'required|array',
            'toticket2' => 'nullable|array',
            'toticket3' => 'nullable|array',
            'toticket4' => 'nullable|array',
            'foId' => 'required|integer',//回程航班
            'ticket2' => 'required|integer|between:0,4',
            'ticket3' => 'nullable|integer|between:0,4',
            'ticket4' => 'nullable|integer|between:0,4',
            'ticket5' => 'nullable|integer|between:0,4', 
            'ticket6' => 'nullable|integer|between:0,4', 
            'ticket7' => 'required|integer|between:0,4',
            'ticket8' => 'required|integer|between:0,4',
            'ticket9' => 'required|integer|between:0,4',//愛心
            'ticket10' => 'required|integer|between:0,4', //愛陪
            'ticket11' => 'required|integer|between:0,4', 
            'ticket12' => 'nullable|integer|between:0,4',
            'ticket13' => 'required|integer|between:0,4',
            'ticket14' => 'required|integer|between:0,4',//愛心
            'ticket15' => 'required|integer|between:0,4',//愛陪
            'ticket16' => 'required|integer|between:0,4',
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

        $numto = count($haspeopleto);//數陣列內容

        switch($numto)
        {
            case 1:
                $a ="ticket".$haspeopleto[0];
                return view("be_order.index",
                ['toId' => $request->toId,'foId' => $request->foId,'toticket1' => $request->toticket1,'toticket2' => $request->toticket2,
                'toticket3' => $request->toticket3,'toticket4' => $request->toticket4,
                'foticket1' =>[$haspeopleto[0],$request->$a],
                'foticket2' =>['',''],'foticket3' =>['',''],'foticket4' =>['',''],'quantity2' => $request->quantity2]);//router會帶參數
            case 2:
                $a = "ticket".$haspeopleto[0];
                $b = "ticket".$haspeopleto[1];
                return view("be_order.index",
                ['toId' => $request->apId,'foId' => $request->foId,'toticket1' => $request->toticket1,'toticket2' => $request->toticket2,
                'toticket3' => $request->toticket3,'toticket4' => $request->toticket4,
                'foticket1' =>[$haspeopleto[0],$request->$a],
                'foticket2' =>[$haspeopleto[1],$request->$b],'foticket3' =>['',''],'foticket4' =>['',''],
                'quantity2' => $request->quantity2]);
            case 3:
                $a = "ticket".$haspeopleto[0];
                $b = "ticket".$haspeopleto[1];
                $c = "ticket".$haspeopleto[2];
                return view("be_order.index",
                ['toId' => $request->apId,'foId' => $request->foId,'toticket1' => $request->toticket1,'toticket2' => $request->toticket2,
                'toticket3' => $request->toticket3,'toticket4' => $request->toticket4,
                'foticket1' =>[$haspeopleto[0],$request->$a],
                'foticket2' =>[$haspeopleto[1],$request->$b],'foticket3' =>[$haspeopleto[2],$request->$c],'foticket4' =>['',''],
                'quantity2' => $request->quantity2]);
            case 4:
                $a = "ticket".$haspeopleto[0];
                $b = "ticket".$haspeopleto[1];
                $c = "ticket".$haspeopleto[2];
                $d = "ticket".$haspeopleto[3];
                return view("be_order.index",
                ['toId' => $request->apId,'foId' => $request->foId,'toticket1' => $request->toticket1,'toticket2' => $request->toticket2,
                'toticket3' => $request->toticket3,'toticket4' => $request->toticket4,
                'foticket1' =>[$haspeopleto[0],$request->$a],
                'foticket2' =>[$haspeopleto[1],$request->$b],'foticket3' =>[$haspeopleto[2],$request->$c],
                'foticket4' =>[$haspeopleto[3],$request->$d],'quantity2' => $request->quantity2]);
        }

        // return dd($choose);
        // if(empty($toticket2))   

        return view("be_order.index");
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
