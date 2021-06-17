@extends('layouts.member_center')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/be_all.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|會員中心_會員基本資料</title>
@endsection
@section('name')
<style>
  #chc1,#chc3 {
    height: 50px;
    color: black;
    font-size: 20px;
    background-color: #fdd85d;
} 
#chc2 {
    height: 50px;
    color: black;
    font-size: 20px;
    background-color: #ffd23e;
    /* box-shadow:1px 1px 3px 2px rgba(20%,20%,40%,0.5) inset; */
    border:2px #af8c19 solid;
    border-bottom-width:3px 
} 

</style>
@endsection
@section('main')
<form id="msform">  
  <fieldset> 
    @if (session()->has('notice')) 
        <div class="m-2 bg-green-300 px-3 py-2 rounded">
            {{ session()->get('notice')}}
        </div>
    @endif
    
    {{-- <button type="button" onclick="location.href='{{route('login.logout')}}'">登出</button> --}}
    {{-- <a href="{{ route('login.logout')}}">登出</a> --}}
    <div class="form-card"> 
      <h2 class="fs-title">會員基本資料</h2>    
        <div class="container">
          <div class="row">
            <h5 class="fs col  align-self-center">會員資料</h5>
            <button class="next action-button" style="width: 150px;font-size:16px;" type="button" onclick="location.href='{{route('member.editmember')}}'">修改會員資料</button></div><br>
            @foreach ($members as $member)
            <div class="row offset-md-1">
              <div class="col-md-6">
                電子信箱：{{($member->mEmail == "") ? '--' : $member->mEmail}}
              </div>
              <div class="col-md-6">
                手機號碼：{{($member->mPhone == "") ? '--' : $member->mPhone}}
              </div>
            </div>
            @endforeach
        </div><br>

        <div class="container">
          <div class="row">
            <h5 class="fs col  align-self-center">旅客資料</h5>
            <button class="next action-button" style="width: 150px;font-size:16px" type="button" onclick="location.href='{{route('member.editpassenger')}}'">編輯旅客資料</button></div> <br>
            {{-- {{dd($passengers)}} --}}
            @if(empty($passengers))
            <div class="row offset-md-1">
              <div class="col-md-6">
                姓名：--
              </div>
              <div class="col-md-6">
                身分證字號：--
              </div>
            </div><br>
            <div class="row offset-md-1">
              <div class="col-md-6">
                性別：--
              </div>
              <div class="col-md-6">
                生日：--
              </div>
            </div>
            @else
              @foreach ($passengers as $passenger)
              <div class="row offset-md-1">
                <div class="col-md-6">
                  姓名：{{$passenger->pName}}
                </div>
                <div class="col-md-6">
                  身分證字號：{{$passenger->pId}}
                </div>
              </div><br>
              <div class="row offset-md-1">
                <div class="col-md-6">
                  性別：{{$gender}}
                </div>
                <div class="col-md-6">
                  生日：{{$passenger->birthday}}
                </div>
              </div>
              @endforeach
            @endif
        </div><br>
            
        <div class="container">
          <div class="row">
            <h5 class="fs col  align-self-center">聯絡人資料</h5>
            <button class="next action-button" style="width: 150px;font-size:16px" type="button" onclick="location.href='{{route('member.editcontact')}}'">編輯聯絡人資料</button></div> <br>
            @if(empty($contacts))
            <div class="row offset-md-1">
              <div class="col-md-6">
                姓名：--
              </div>
              <div class="col-md-6">
                行動電話：--
              </div>
            </div><br>
            <div class="row offset-md-1">
              <div class="col-md-12">
                電子信箱：--
              </div>
            </div>
            @else
              @foreach ($contacts as $contact)
              <div class="row offset-md-1">
                <div class="col-md-6">
                  姓名：{{$contact->cName}}
                </div>
                <div class="col-md-6">
                  行動電話：{{$contact->cPhone}}
                </div>
              </div><br>
              <div class="row offset-md-1">
                <div class="col-md-12">
                  電子信箱：{{$contact->cEmail}}
                </div>
              </div>
              @endforeach
            @endif
        </div><br>
            
        <div class="container">
          <div class="row">
            <h5 class="fs col  align-self-center">信用卡資料</h5>
            <button class="next action-button" style="width: 150px;font-size:16px" type="button" onclick="location.href='{{route('member.editpay')}}'">編輯信用卡資料</button></div> <br>
            @if(empty($pays))
            <div class="row offset-md-1">
              <div class="col-md-6">
                卡別：--
              </div>
              <div class="col-md-6">
                有效日期(月/年)：--
              </div>
            </div><br>
            <div class="row offset-md-1">
              <div class="col-md-6">
                卡號：--
              </div>
              <div class="col-md-6">
                檢查碼：--
              </div>
            </div>
            @else
              @foreach ($pays as $pay)
              <div class="row offset-md-1">
                <div class="col-md-6">
                  卡別：{{$pay->creName}}
                </div>
                <div class="col-md-6">
                  有效日期(月/年)：{{substr("$pay->validityPeriod",0,2)}}/{{substr("$pay->validityPeriod", -2)}}
                </div>
              </div><br>
              <div class="row offset-md-1">
                <div class="col-md-6">
                  卡號：{{substr("$pay->caNumber",0,4)}}-{{substr("$pay->caNumber",4,4)}}-{{substr("$pay->caNumber",8,4)}}-{{substr("$pay->caNumber",-4)}}
                </div>
                <div class="col-md-6">
                  檢查碼：{{$pay->checkCode}}
                </div>
              </div>
              @endforeach
            @endif
        </div>
    </div>
  </fieldset>
</form>


    
@endsection