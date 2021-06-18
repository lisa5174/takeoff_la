@extends('layouts.member_center')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/be_all.css')}}"/>
@endsection
@section('name')
<style>
  #chc2,#chc3 {
    height: 50px;
    color: black;
    font-size: 20px;
    background-color: #fdd85d;
} 
#chc1 {
    height: 50px;
    color: black;
    font-size: 20px;
    background-color: #ffd23e;
    border:2px #af8c19 solid;
    border-bottom-width:3px 
} 

</style>
@endsection
@section('title')
    <title>Take off 空|會員中心_查看訂單</title>
@endsection

@section('main')
<form id="msform">  
    <fieldset style="background: transparent;"> 
      <div class="form-card"> 
    @if (session()->has('notice')) 
        <div class="m-2 bg-green-300 px-3 py-2 rounded">
            {{ session()->get('notice')}}
        </div>
    @endif

    @if (($airticketnum[0]->num)==0)
        抱歉，您尚未購買任何機票喔~趕快去下訂吧(´･ω･`)  
    @endif
    <h5 class="fs-title">查看訂單</h5>
    @for ($i = 0; $i < $airticketnum[0]->num; $i++)
    <div class="accordion" id="accordionExample"><!--手風琴-->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button  collapsed" type="button" data-toggle="collapse" data-target="#collapseOne{{$i}}" aria-expanded="false" aria-controls="collapseOne" >
            <div class="row">
              <div class="fs" style="font-size: 16px">訂單編號：{{$airticket[$i]->aId}} &nbsp&nbsp&nbsp 日期：{{$flight[$i]->date}} &nbsp&nbsp&nbsp {{$flight[$i]->toplace}}--->{{$flight[$i]->foplace}} &nbsp&nbsp&nbsp 價格：{{$price[$i]}}</div>
            </div>
          </button>
        </h2>
        {{-- <form action="{{ route('order.index2')}}" method="GET"> --}}
          <div id="collapseOne{{$i}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
    <div class="container">
      <div class="row">
        <h5 class="fs">航班</h5></div> <br>
      <div class="row offset-md-1">
        <div class="col-md-6">飛機名稱：{{$flight[$i]->fName}}</div>
      </div><br>
        <div class="row offset-md-1">
        <div class="col-md-6">出發機場：{{$flight[$i]->toplace}}</div>
        <div class="col-md-6">目的機場：{{$flight[$i]->foplace}}</div>
      </div><br>
      <div class="row offset-md-1">
        <div class="col-md-6">起飛日期：{{$flight[$i]->date}}</div>
        <div class="col-md-6">起飛時間：{{$flight[$i]->Ltime}}</div>
      </div><br>
    </div><br>
      {{-- <div class="row offset-md-1">
        <div class="col-6">機票價格：{{$price[$i]}}</div><br>
      </div><br> --}}
      <div class="container">
        <div class="row">
          <h5 class="fs">旅客({{$tickettype[$i]->tName}}票種)</h5></div> <br>
        <div class="row offset-md-1">
          <div class="col-md-6">姓名：{{$passengers[$i]->pName}}</div>
          <div class="col-md-6">身分證字號：{{$passengers[$i]->pId}}</div>
        </div><br>
        <div class="row offset-md-1">
          <div class="col-md-6">性別：{{(($passengers[$i]->gender)==0 ? '女' : '男')}}</div>
          <div class="col-md-6">生日：{{$passengers[$i]->birthday}}</div>
        </div><br>
      </div><br>
      
      <div class="container">
        <div class="row">
          <h5 class="fs">聯絡人</h5></div> <br>
        <div class="row offset-md-1">
          <div class="col-md-6">姓名：{{$contacts[$i]->cName}}</div>
          <div class="col-md-6">行動電話：{{$contacts[$i]->cPhone}}</div>
        </div><br>
        <div class="row offset-md-1">
          <div class="col-md-6">電子信箱：{{$contacts[$i]->cEmail}}</div>
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
          <div class="col-md-6">卡別：{{$pays[$i]->creName}}</div>
          <div class="col-md-4">有效日期(月/年)：{{substr("$validity",0,2)}}/{{substr("$validity",-2)}}</div>
        </div> <br>
        <div class="row offset-md-1">
        <div class="col-md-6">卡號：{{substr("$p",0,4)}}-{{substr("$p",4,4)}}-{{substr("$p",8,4)}}-{{substr("$p",-4)}}</div>
        <div class="col-md-4">檢查碼：{{$pays[$i]->checkCode}}</div>
      </div><br>
    </div><br>
  </div></div></div></div>
    @endfor
    

  </fieldset>
</form>
@endsection