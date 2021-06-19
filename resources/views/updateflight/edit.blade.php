@extends('layouts.flights')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/b_today.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|後台_修改</title>
@endsection
@section('name')
<style>
  #chc2,#chc3, #chc1,#chc5, #chc6,#chc7 {
    height: 50px;
    color: black;
    font-size: 20px;
    background-color: #fdd85d;
} 
#chc4 {
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

    @if ($errors->any())
    <div class="errors m-2 p-1 bg-red-500 text-red-100 font-thin rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif  
    <span class="col-10" id="g1">
    <div class="container">
        <br><div class="row"><h4>航班資訊</h4></div><br>
        @if(!isset($flights))
            發生嚴重錯誤!<br>
        @elseif(empty($flights))
            <h4>發生錯誤!<br>此航班已下架所以不可修改或不存在，請返回上一頁</h4>
        @else
            @foreach($flights as $flight)
                @if($flight->date == date('Y-m-d', strtotime('+8HOUR')) 
                && $flight->Ltime < date('H:i', strtotime('+8HOUR')))
                    <h4>發生錯誤!<br>此航班已下架所以不可修改或不存在，請返回上一頁</h4>
                @else    
                    <form action="{{ route('updateflight.update',$flight->fId)}} " method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row offset-md-1">
                            <div class="col-5">飛機名稱：{{ $flight->fName}}</div>
                          </div><br>
                          <div class="row offset-md-1">
                            <div class="col-5">起飛日期：<input type="date" value="{{ $flight->date }}" name="updatedate" class="form-control"id="fapdate" max="2030-12-31" min=""></div>
                            <div class="col-5">起飛時間：<input type="time" value="{{ $flight->Ltime }}" name="updatetime" class="form-control"></div>
                          </div><br>
                          <div class="row offset-md-1">
                            <div class="col-5">起飛地點：{{ $flight->toplace}}</div>
                            <div class="col-5">降落地點：{{ $flight->foplace}}</div>
                          </div><br>
                          <div class="row offset-md-1">
                            <div class="col-5">座位數量：{{ $flight->airSeat}}</div>
                            <div class="col-5">已售座位：{{ $flight->unboughtSeat}}</div>
                          </div><br>
                          <div class="row offset-md-1">
                            <div class="col-5">機票價格：{{ $flight->fprice}}</div>
                          </div>
                        </div>
                        <div class="d-grid gap-2 col-2 mx-auto">
                            <!-- Button trigger modal -->
                            <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">修改航班</button>
                        </div>
                        </div><br>
                    </form>
                @endif    
            @endforeach
        @endif
    </div>
    </span>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(function(){
            //得到當前時間
          var date_now = new Date();
          //得到當前年份
          var year = date_now.getFullYear();
          //得到當前月份
          //注：
          //  1：js中獲取Date中的month時，會比當前月份少一個月，所以這裡需要先加一
          //  2: 判斷當前月份是否小於10，如果小於，那麼就在月份的前面加一個 '0' ， 如果大於，就顯示當前月份
          var month = date_now.getMonth()+1 < 10 ? "0"+(date_now.getMonth()+1) : (date_now.getMonth()+1);
          //得到當前日子（多少號）
          var date = date_now.getDate() < 10 ? "0"+date_now.getDate() : date_now.getDate();
          //設置input標籤的max屬性
          var month1 = date_now.getMonth()+2 < 10 ? "0"+(date_now.getMonth()+1) : (date_now.getMonth()+1);
          //設置input標籤的max屬性
          $("#fapdate").attr("min",year+"-"+month+"-"+date);})  </script>
    
@endsection