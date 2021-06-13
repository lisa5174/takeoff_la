@extends('layouts.member_center')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/be_all.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|會員中心_查看訂單</title>
@endsection

@section('main')
<form id="msform">  
    <fieldset> 
      <div class="form-card"> 
    @if (session()->has('notice')) 
        <div class="m-2 bg-green-300 px-3 py-2 rounded">
            {{ session()->get('notice')}}
        </div>
    @endif

    @for ($i = 0; $i < $airticketnum[0]->num; $i++)
    <div class="container">
      <div class="row">
        <h5 class="fs">訂單編號：{{$airticket[$i]->aId}}</h5></div>
      </div><br>
      <div class="row">
        <h5 class="fs">航班</h5></div> <br>
      <div class="row offset-md-1">
        <div class="col-6">飛機名稱：{{$flight[$i]->fName}}</div>
      </div>
        <div class="row offset-md-1">
        <div class="col-6">出發機場：{{$flight[$i]->toplace}}</div>
        <div class="col-6">目的機場：{{$flight[$i]->foplace}}</div>
      </div><br>
      <div class="row offset-md-1">
        <div class="col-6">起飛日期：{{$flight[$i]->date}}</div>
        <div class="col-6">起飛時間：{{$flight[$i]->Ltime}}</div>
      </div><br>
      <div class="row offset-md-1">
        <div class="col-6">人數票種：</div><br>
        @foreach ($tickettypenum[$i] as $tn)
        <div class="col-6">
            {{$tn->tName}}票種{{$tn->aNum}}張</div><br>
        @endforeach
        <div class="col-6">機票價格：{{$airticket[$i]->aprice}}</div><br>
      </div><br>
      <div class="container">
        <div class="row">
          <h5 class="fs">旅客</h5></div> <br>
        <div class="row offset-md-1">
          <div class="col-6">姓名：{{$passengers[$i]->pName}}</div>
          <div class="col-6">身分證字號：{{$passengers[$i]->pId}}</div>
        </div><br>
        <div class="row offset-md-1">
          <div class="col-6">性別：{{(($passengers[$i]->gender)==0 ? '女' : '男')}}</div>
          <div class="col-6">生日：{{$passengers[$i]->birthday}}</div>
        </div><br>
      </div><br>
      
      <div class="container">
        <div class="row">
          <h5 class="fs">聯絡人</h5></div> <br>
        <div class="row offset-md-1">
          <div class="col-6">姓名：{{$contacts[$i]->cName}}</div>
          <div class="col-6">行動電話：{{$contacts[$i]->cPhone}}</div>
        </div><br>
        <div class="row offset-md-1">
          <div class="col-6">電子信箱：{{$contacts[$i]->cEmail}}</div>
        </div><br>
      </div><br>
      <div class="container">
        <div class="row">
          <h5 class="fs">信用卡</h5></div> <br>
          
          @php
            $p = $pays[$i]->caNumber;
            $validity = $pays[$i]->validityPeriod
          @endphp

        <div class="row offset-md-1">
          <div class="col-6">卡別：{{$pays[$i]->creName}}</div>
          <div class="col-4">有效日期(月/年)：{{substr("$validity",0,2)}}/{{substr("$validity",-2)}}</div>
        </div> <br>
        <div class="row offset-md-1">
        <div class="col-6">卡號：{{substr("$p",0,4)}}-{{substr("$p",4,4)}}-{{substr("$p",8,4)}}-{{substr("$p",-4)}}</div>
        <div class="col-4">檢查碼：{{$pays[$i]->checkCode}}</div>
      </div><br>
    </div><br>
    @endfor
    </div>
  </fieldset>
</form>
@endsection