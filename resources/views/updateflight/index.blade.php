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

    @if (session()->has('notice')) 
      <div class="m-2 bg-green-300 px-3 py-2 rounded">
          {{ session()->get('notice')}}
      </div>
    @endif

    @if ($errors->any())
    <div class="errors m-2 p-1 bg-red-500 text-red-100 font-thin rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif  

<span class="col-10" id="g1"> <br>
    <nav>
        <div class="nav nav-tabs col-md-10" id="nav-tab" role="tablist" >
            <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">航班</a>
            
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"><!--航班-->
            
                <form action="{{ url('/updateflights') }} " method="POST">
                  {{-- @method('GET') --}}
                    @csrf
                  <div class="row g-3 align-items-center float-right" style="padding: 0px;">
                    <div class="col-auto">
                        <label for="inputPassword6" class="col-form-label">航班名稱：</label>
                    </div>
                    <div class="col-auto">
                        <select name="editname" class="form-select" aria-label="Default select example">
                            <option selected></option>
                            @foreach($airplanes as $airplane)
                                <option>{{ $airplane->airName}}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" value="{{ old('updatename') }}" name="updatename" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline"> --}}
                    </div>

                    <div class="col-auto">
                        <label for="inputAddress" class="col-form-label"><span style="color: red;">*</span>起飛日期：</label>
                    </div>
                    <div class="col-auto">
                        <input type="date" value="{{ old('editdate') }}" name="editdate" class="form-control"max="2030-12-31" min="" id="fapdate">
                    </div>
                    
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">搜尋</button>
                    </div>
                  </div><br>
                </form>

            @if(!isset($flights))
                請搜尋欲修改的航班
            @elseif(empty($flights))
                <h4>查無航班!</h4>
            @else
                <section class="table table-hover">
                    <div > <!--時間表-->
                    <table cellpadding="0" cellspacing="0" >
                        <thead>
                        <tr class="tbl-header">
                            <th><h6><b> 飛機名稱</th>
                            <th><h6><b> 起飛日期</th>    
                            <th><h6><b> 起飛時間</th>
                            <th><h6><b> 起飛地點</th>
                            <th><h6><b> 降落地點</th>
                            <th><h6><b> 座位數量</th>
                            <th><h6><b> 已售座位</th>
                            <th><h6><b> 機票價格</th>
                            <th><h6><b> 修改</th>
                        </tr>
                        </thead>
                    </div>
                    <div class="tbl-content ">
                        <tbody>
                            @foreach($flights as $flight)
                            <tr>
                                @if ($flight->date == date('Y-m-d', strtotime('+8HOUR') ))
                                    @if ($flight->Ltime > date('H:i', strtotime('+8HOUR') ))
                                        <td>{{ $flight->fName}}</td>
                                        <td>{{ $flight->date }}</td>
                                        <td>{{ $flight->Ltime }}</td>  
                                        <td>{{ $flight->toplace}}</td>
                                        <td>{{ $flight->foplace}}</td>
                                        <td>{{ $flight->airSeat}}</td>
                                        <td>{{ $flight->unboughtSeat}}</td>
                                        <td>{{ $flight->fprice}}</td>
                                        <td>
                                            <div>
                                                <button type="button" class="btn btn-primary" 
                                                onclick="location.href='{{route('updateflight.edit',$flight->fId)}}'">修改</button>
                                                {{-- <a href=" ">修改</a> --}}
                                            </div>
                                        </td>
                                    @endif
                                @else
                                    <td>{{ $flight->fName}}</td>
                                    <td>{{ $flight->date }}</td>
                                    <td>{{ $flight->Ltime }}</td>  
                                    <td>{{ $flight->toplace}}</td>
                                    <td>{{ $flight->foplace}}</td>
                                    <td>{{ $flight->airSeat}}</td>
                                    <td>{{ $flight->unboughtSeat}}</td>
                                    <td>{{ $flight->fprice}}</td>
                                    <td>
                                        <div>
                                            <button type="submit" class="btn btn-primary" 
                                            onclick="location.href='{{ route('updateflight.edit',$flight->fId)}}'">修改</button>
                                            {{-- {{ route('updateflight.edit',['updateflight' => $flight->fId])}} 這也可以 --}}
                                            {{-- {{ url('/updateflights',[$flight->fId],'/edit' )}} --}}
                                            {{-- {{ url('/updateflights/{updateflight}/edit',[$flight->fId] )}} --}}
                                        </div>
                                    </td>
                                @endif
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </section>
            @endif
        </div>
        

      </div>

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