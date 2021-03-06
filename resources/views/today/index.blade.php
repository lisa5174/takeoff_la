@extends('layouts.flights')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/b_today.css')}}"/>
@endsection

@section('title')
  <title>Take off 空|後台_今日航班</title>
@endsection
@section('name')
<style>
  #chc2,#chc3, #chc4,#chc5, #chc6,#chc7 {
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
@section('main')



  <span class="col-10" id="g1">
      <nav class="nav nav-tabs ">    
        <div  id="nav-tab " role="tablist" >
          <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#" role="tab" aria-controls="nav-home" aria-selected="true">今日航班</a>
       </div>
      </nav>

     <div class="tab-content" id="nav-tabContent">
         <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <section class="table table-hover">
          <div > <!--時間表-->
            <table cellpadding="0" cellspacing="0" >
              <thead>
                <tr class="tbl-header">
                  <th><h6><b> 飛機名稱</th>
                  <th><h6><b> 起飛時間</th>
                  <th><h6><b> 起飛地點</th>
                  <th><h6><b> 降落地點</th>
                  <th><h6><b> 座位數量</th>
                  <th><h6><b> 已售座位</th>
                  <th><h6><b> 機票價格</th>
                </tr>
              </thead>
          </div>
          <div class="tbl-content">
              <tbody>
                  @foreach($flights as $flight)
                      <tr>
                          <td>{{ $flight->fName}}</td>
                          <td>{{ $flight->Ltime }}</td>  
                          <td>{{ $flight->toplace}}</td>
                          <td>{{ $flight->foplace}}</td>
                          <td>{{ $flight->airSeat}}</td>
                          <td>{{ $flight->unboughtSeat}}</td>
                          <td>{{ $flight->fprice}}</td>
                      </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </section>

        <script>$(window).on("load resize ", function() {
          var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
          $('.tbl-header').css({'padding-right':scrollWidth});
        }).resize();</script>
        </div>
     </div>
    </span>
@endsection

{{-- 
@section('main')
    <h1 class="font-thin text-4xl">今日航班</h1>

    @foreach($flights as $flight)
        <div>
            <h2 class="text-2xl">飛機名稱{{ $flight->fName}}</h2>
            @php
                require 'vendor/autoload.php';
                use Carbon\Carbon;
                $tt = new Carbon($flight->time);
            @endphp
            date('Y-m-d H:i:s', time())
            <p>起飛時間{{ $flight->time }}</p>
            <p>起飛地點{{ $flight->toplace}}</p>
            <p>降落地點{{ $flight->foplace}}</p>
            <p>座位{{ $flight->airSeat}}</p>
            <p>已售座位{{ $flight->unboughtSeat}}</p>
        </div>
    @endforeach




@endsection --}}