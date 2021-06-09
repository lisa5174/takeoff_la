<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class be_resetpw extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("be_resetpw.index");
    }

    public function updatepw(Request $request)
    {
        $choose = $request->all();
        // return dd($choose);
        $mId = session('mId');
        $put = $request->validate([
            'pwd' => 'required',
            'newpwd' => 'required|confirmed|min:8|max:15',
            // 'newpwd_confirmation ' => 'required',
        ]);

        $members = DB::select("select password from member where mId = '$mId'");

        if($members[0]->password == $request->pwd) {
            DB::table('member')->where('mId', $mId)->update(
                [
                    'password' => $request->newpwd,
                ]
            );
        }
        else{
            return back()->withErrors(['原密碼輸入錯誤。']);
        }

        return redirect()->route('member.index')->with('notice','密碼修改成功!');
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
