@extends('layouts.flights')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/b_today.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|後台_查詢</title>
@endsection
@section('name')
<style>
  #chc2,#chc3, #chc4,#chc1, #chc6 {
    height: 50px;
    color: black;
    font-size: 20px;
    background-color: #fdd85d;
} 
#chc5 {
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
        <nav>    
          <div class="nav nav-tabs col-md-10" id="nav-tab" role="tablist">
            <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#" role="tab" aria-controls="nav-home" aria-selected="true">查詢</a>
         </div>
        </nav>
        
       <div class="tab-content" id="nav-tabContent">
           <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"><!--查詢-->
    <form action="{{ url('/search') }} " method="POST">
        {{-- @method('GET') --}}
        @csrf
        <div class="row offset-md-1">
          <div class="col-5">
            <label for="inputPassword4" class="col-form-label ">航班名稱：</label>
            <select name="putname" class="form-select" aria-label="Default select example">
                <option selected></option>
                @foreach($airplanes as $airplane)
                    <option>{{ $airplane->airName}}</option>
                @endforeach
            </select>
          </div>
          <div class="col-6">
              <label for="inputPassword6" class="col-form-label"><span style="color: red;">*</span>起飛日期：</label>
              <input type="date" value="{{ old('putdate') }}" name="putdate" class="form-control"></div>
        </div><br>
            <div class="d-grid gap-2 col-2 mx-auto">
                <!-- Button trigger modal -->               
                <button type="submit" class="m-2 bg-blue-300 px-3 py-2 rounded" >搜尋</button>
            </div><br>
    </form>               



    @if(!isset($flights))
        請搜尋
    @elseif(empty($flights))
        <h4>查無航班!</h4>
    @else
        <section class="table table-hover">
            <div > <!--時間表-->
            <table cellpadding="0" cellspacing="0" >
                <thead>
                <tr class="tbl-header">
                <th><h6><b> 航班狀態</th>
                <th><h6><b> 飛機名稱</th>
                <th><h6><b> 起飛日期</th>    
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
                        @if($flight->status==0 || $flight->date < date('Y-m-d', strtotime('+8HOUR')) )
                        {{--   getdate() --}}
                            <td>下架</td>
                        @elseif($flight->date == date('Y-m-d', strtotime('+8HOUR')) 
                            && $flight->Ltime < date('H:i', strtotime('+8HOUR')))
                            <td>下架</td>
                        @elseif($flight->status==1)
                            <td>上架</td>
                        @else
                            <td>未知</td>
                        @endif
                        <td>{{ $flight->fName}}</td>
                        <td>{{ $flight->date }}</td>
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
    @endif
@endsection