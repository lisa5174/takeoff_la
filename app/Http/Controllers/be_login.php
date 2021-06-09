<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class be_login extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mId = session('mId');
        if(!isset($mId)) return view('be_login.index');
        else return back();//如果已經登入，就返回上一頁
    }

    public function login(Request $request)
    {
        $choose = $request->all();
        // return dd($choose);
        $put = $request->validate([
            'macount' => 'required',
            'mpw' => 'nullable|between:8,15', 
        ]);

        $userDataPhone = DB::select("SELECT * FROM member WHERE mPhone=?", [$request->macount]);
        $userDataEmail = DB::select("SELECT * FROM member WHERE mEmail=?", [$request->macount]);
        // return dd($userData);
        if(!isset($userDataPhone[0]->mId) && !isset($userDataEmail[0]->mId)){
            return back()->withErrors(['出現錯誤!該用戶不存在']);
        }
        elseif(isset($userDataPhone[0]->mId) && ($request->mpw == $userDataPhone[0]->password)){ //電話登入
            session(['mId' => $userDataPhone[0]->mId]);
            return redirect('/homepage');
        }
        elseif(isset($userDataEmail[0]->mId) && ($request->mpw == $userDataEmail[0]->password)) //電子信箱登入
        {
            session(['mId' => $userDataEmail[0]->mId]);
            return redirect('/homepage');
        }
        else
        {
            return back()->withErrors(['帳號或密碼錯誤']);
        }
    }

    public function logout()
    {
        session()->forget('mId');
        return redirect('/homepage');
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
