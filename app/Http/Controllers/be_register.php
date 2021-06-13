<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class be_register extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mId = session('mId');
        if(isset($mId)) return back();//如果已經登入，就返回上一頁
        return view("be_register.index");
    }

    public function register(Request $request)
    {
        $choose = $request->all();
        // return dd($choose);
        $put = $request->validate([
            'rphone' => 'nullable|numeric|regex:/(09)[0-9]/|digits:10',
            'remail' => 'nullable|email|max:35', 
            'rpwd' => 'required|between:8,15', 
        ]);

        if ((empty($request->rphone)) && (empty($request->remail))) {
            return back()->withErrors(['手機號碼跟E-mail至少要輸入一個']);
        }

        // if(empty($request->remail)) return dd("fjkldsjflka");
        DB::table('member')->Insert(
            [
                'mEmail' => $request->remail,
                'mPhone' => $request->rphone,
                'password' => $request->rpwd,
            ]
        );

        $id = DB::select('SELECT LAST_INSERT_ID() as id;');
        // return dd($id);
        session(['mId' => $id[0]->id]);
        return redirect()->route('member.index')->with('notice','會員註冊成功!');

        // return view("be_register.index");
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
