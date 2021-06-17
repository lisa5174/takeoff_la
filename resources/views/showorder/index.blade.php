{{-- showorder --}}
@extends('layouts.flights')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/b_today.css')}}"/>
@endsection

@section('title')
  <title>Take off 空|後台_查看訂單</title>
@endsection
@section('name')
<style>
  #chc2,#chc3, #chc4,#chc5, #chc1 {
    height: 50px;
    color: black;
    font-size: 20px;
    background-color: #fdd85d;
} 
#chc6 {
    height: 50px;
    color: black;
    font-size: 20px;
    background-color: #ffd23e;
    border:2px #af8c19 solid;
    border-bottom-width:3px 
} 
</style>
@endsection
@section('main')



  <span class="col-10" id="g1">
      <nav class="nav nav-tabs ">    
        <div  id="nav-tab " role="tablist" >
          <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#" role="tab" aria-controls="nav-home" aria-selected="true">訂單</a>
       </div>
      </nav>

     <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <section class="table table-hover">
          <div > <!--時間表-->
            <table cellpadding="0" cellspacing="0" >
              <thead>
                <tr class="tbl-header">
                  <th><h6><b> 訂單編號</th>
                  <th><h6><b> 會員編號</th>
                  <th><h6><b> 訂購票種</th>
                  <th><h6><b> 機票價格</th>
                  <th><h6><b> 飛機名稱</th>
                  <th><h6><b> 起飛時間</th>
                  <th><h6><b> 起飛地點</th>
                  <th><h6><b> 降落地點</th>
                </tr>
              </thead>
            </div>
            <div class="tbl-content">
              <tbody>
                @foreach($flights as $flight)
                  <tr>
                    <td>{{ $flight->aId}}</td>
                    <td>{{ $flight->mId}}</td>
                    <td>{{ $flight->tName}}</td>
                    <td>{{ $flight->price}}</td>
                    <td>{{ $flight->fName}}</td>
                    <td>{{ $flight->Ltime }}</td>  
                    <td>{{ $flight->toplace}}</td>
                    <td>{{ $flight->foplace}}</td>
                  </tr>
                @endforeach
              </tbody>
           </table>
            </div>
        </section>
      </div>
    </div>
  </span>
@endsection