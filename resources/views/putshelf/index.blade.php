@extends('layouts.flights')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/p2.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|後台_上架</title>
@endsection

@section('main')
    {{-- <a href="{{ route('putshelfs.create')}}">新增上架</a> --}}
    
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

    <nav>
        <div class="nav nav-tabs col-md-10" id="nav-tab" role="tablist" >
            <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">已上架</a>
            <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">新增上架</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"><!--上架-->
            <div id=h1></div>
            <form action="{{ url('/putshelf/date')}} " method="POST">
                @method('GET')
                @csrf
                <input type="date" value="{{ old('apdate') }}" name="putdate" class="form-control">
                <button type="submit" class="m-2 bg-blue-300 px-3 py-2 rounded" >搜尋</button>
            </form>

            <script>
                $(function(){
                    //得到当前时间
                    var date_now = new Date();
                    //得到当前年份
                    var year = date_now.getFullYear();
                    //得到当前月份
                    //注：
                    //  1：js中获取Date中的month时，会比当前月份少一个月，所以这里需要先加一
                    //  2: 判断当前月份是否小于10，如果小于，那么就在月份的前面加一个 '0' ， 如果大于，就显示当前月份
                    var month = date_now.getMonth()+1 < 10 ? "0"+(date_now.getMonth()+1) : (date_now.getMonth()+1);
                    //得到当前日子（多少号）
                    var date = date_now.getDate() < 10 ? "0"+date_now.getDate() : date_now.getDate();
                    //设置input标签的max属性
                    var month1 = date_now.getMonth()+2 < 10 ? "0"+(date_now.getMonth()+1) : (date_now.getMonth()+1);
                    //设置input标签的max属性
                    $("#birthday").attr("min",year+"-"+month+"-"+date);}) 
            </script>

            @if (session()->has('flights')) 
                <div class="m-2 bg-green-300 px-3 py-2 rounded">
                    {{ session()->get('flights')}}
                </div>
            @endif

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
                    </tr>
                    </thead>
                </div>
                <div class="tbl-content ">
                    <tbody>
                    @foreach($flights as $flight)
                    <tr>
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
        </div>

        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"><!--增新上架-->

            <form action="{{ route('putshelfs.store')}} " method="POST">
                @csrf
                    <div class="col-md-6 offset-md-3">
                        <label for="inputPassword4" class="form-label ">飛機名稱：</label>
                        <input type="text" value="{{ old('apname') }}" name="apname" class="form-control" id="apname">
                    </div>
                    <div class="col-6 offset-md-3">
                        <label for="inputAddress" class="form-label">起飛日期：</label>
                        <input type="date" value="{{ old('apdate') }}" name="apdate" class="form-control" id="apdate" >
                    </div>
                    <div class="col-6 offset-md-3">
                        <label for="inputAddress" class="form-label">起飛時間：</label>
                        <input type="time" value="{{ old('aptime') }}" name="aptime" class="form-control" id="aptime" >
                    </div>
                    <div class="col-6 offset-md-3">
                        <label for="inputAddress" class="form-label">起飛地點：</label>
                        <select name="apto" class="form-select" aria-label="Default select example">
                            <option selected></option>
                            <option>松山(TSA)</option>
                            <option>高雄(KHH)</option>
                            <option>台中(RMQ)</option>
                            <option>花蓮(HUN)</option>
                            <option>台東(TTT)</option>
                            <option> 澎湖(MZG)</option>
                            <option> 金門(KNH)</option>
                        </select>
                    </div>
                    <div class="col-6 offset-md-3">
                        <label for="inputAddress" class="form-label">降落地點：</label>
                        <select  name="apfo" class="form-select" aria-label="Default select example">
                            <option selected ></option>
                            <option>松山(TSA)</option>
                            <option>高雄(KHH)</option>
                            <option>台中(RMQ)</option>
                            <option>花蓮(HUN)</option>
                            <option>台東(TTT)</option>
                            <option> 澎湖(MZG)</option>
                            <option> 金門(KNH)</option>
                        </select>
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <label for="inputPassword4" class="form-label ">機票價格：</label>
                        <input type="text" value="{{ old('apprice') }}" name="apprice" class="form-control" id="apname">
                    </div>
                    <br>
                    <div class="d-grid gap-2 col-2 mx-auto">
                    <!-- Button trigger modal -->
                    <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">新增</button>
                    </div>
            </form>
        </div>    
    </div>    

@endsection