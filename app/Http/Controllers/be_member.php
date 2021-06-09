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
    public function index()
    {
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
        ['members' => $members,'passengers' => $passengers,
        'contacts' => $contacts,'pays' => $pays,
        'gender' => $gender]);
    }
    
    public function editmember()
    {
        $mId = session('mId');
        $members = DB::select("select * from member where mId = '$mId'");
        return view('be_member.editmember', ['members' => $members]);
    }

    public function updatemember(Request $request)
    {
        $choose = $request->all();
        // return dd($choose);
        $put = $request->validate([
            'mEmail' => 'required|email|max:35',
            'mPhone' => 'required|numeric|regex:/(09)[0-9]/|digits:10',
        ]);

        $mId = session('mId');

        DB::table('member')->where('mId', $mId)->update(
            [
                'mEmail' => $request->mEmail,
                'mPhone' => $request->mPhone,
            ]
        );

        return redirect()->route('member.index')->with('notice','會員資料修改成功!');
    }

    public function editpassenger()
    {
        $mId = session('mId');
        $passengers = DB::select("select * from passenger where mId = '$mId'");
        return view('be_member.editpassenger', ['passengers' => $passengers]);
    }

    public function updatepassenger(Request $request)
    {
        $choose = $request->all();
        // return dd($choose);
        $mId = session('mId');

        $put = $request->validate([
            'pName' => 'required|string|max:15',
            'pId' => 'required|tw_id|max:10',
            'gender' => 'required|boolean',
            'birthday' => 'required|date',
        ]);

        DB::table('passenger')->where('mId', $mId)->update(
            [
                'pName' => $request->pName,
                'pId' => $request->pId,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
            ]
        );
        return redirect()->route('member.index')->with('notice','會員資料修改成功!');
    }

    public function editcontact()
    {
        $mId = session('mId');
        $contacts = DB::select("select * from contactperson where mId = '$mId'");
        return view('be_member.editcontact', ['contacts' => $contacts]);
    }

    public function updatecontact(Request $request)
    {
        $choose = $request->all();
        // return dd($choose);
        $mId = session('mId');

        $put = $request->validate([
            'cName' => 'required|string|max:15',
            'cPhone' => 'required|numeric|regex:/(09)[0-9]/|digits:10',
            'cEmail' => 'required|email|max:35',
        ]);

        DB::table('contactperson')->where('mId', $mId)->update(
            [
                'cName' => $request->cName,
                'cPhone' => $request->cPhone,
                'cEmail' => $request->cEmail,
            ]
        );
        return redirect()->route('member.index')->with('notice','聯絡人資料修改成功!');
    }

    public function editpay()
    {
        $mId = session('mId');
        $pays = DB::select(
        "select * from payment as a 
        INNER JOIN creditcard as b ON a.creType = b.creType
        where mId = '$mId'");
        return view('be_member.editpay', ['pays' => $pays]);
    }

    public function updatepay(Request $request)
    {
        $choose = $request->all();
        // return dd($choose);
        $mId = session('mId');
        $thisyear = date("Y", strtotime("+8HOUR"));

        $put = $request->validate([
            'cretype' => 'required|integer|between:1,4', 
            'camonth' => 'required|numeric|between:1,12', 
            'cayear' => 'required|numeric|gte:'.$thisyear, 
            'id1' => 'required|size:4', 
            'id2' => 'required|size:4', 
            'id3' => 'required|size:4', 
            'id4' => 'required|size:4', 
            'cacheckcode' => 'required|between:3,4'
        ]);

        if ($request->cretype == 3 && strlen($request->cacheckcode) != 4) {
            return back()->withErrors(['檢查碼必須是 4 個字元。']);
        }

        // DB::table('payment')->where('mId', $mId)->update(
        //     [
        //         'cName' => $request->cName,
        //         'cPhone' => $request->cPhone,
        //         'cEmail' => $request->cEmail,
        //     ]
        // );
        return redirect()->route('member.index')->with('notice','聯絡人資料修改成功!');
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
