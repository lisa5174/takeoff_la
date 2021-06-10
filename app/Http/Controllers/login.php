<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class login extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adId = session('adId');
        if(!isset($adId)) return view('login.index');
        else return back();//如果已經登入，就返回上一頁
        return view("login.index");
    }

    public function aflogin(Request $request)
    {
        $choose = $request->all();
        // return dd($choose);
        $put = $request->validate([
            'adAccount' => 'required',
            'adPassword' => 'between:8,15', 
        ]);

        $adData = DB::select("SELECT * FROM administrator WHERE adAccount=?", [$request->adAccount]);
        // return dd($userData);
        if(!isset($adData[0]->adId)){
            return back()->withErrors(['出現錯誤!該用戶不存在']);
        }
        elseif(isset($adData[0]->adId) && ($request->adPassword == $adData[0]->adPassword)) //登入
        {
            session(['adId' => $adData[0]->adId]);
            return redirect('/today');
        }
        else
        {
            return back()->withErrors(['帳號或密碼錯誤']);
        }
    }

    public function aflogout()
    {
        session()->forget('adId');
        return redirect('/aflogin');
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
