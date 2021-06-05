@extends('layouts.flights')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/b_offshelf.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|後台_修改</title>
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
                            <div class="col-5">起飛日期：<input type="date" value="{{ $flight->date }}" name="updatedate" class="form-control"></div>
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
    

    
@endsection