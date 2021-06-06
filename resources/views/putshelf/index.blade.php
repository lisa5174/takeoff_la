@extends('layouts.flights')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/b_today.css')}}"/>
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
    
    <span class="col-10" id="g1"> <br>
    <nav>
        <div class="nav nav-tabs col-md-10" id="nav-tab" role="tablist" >
            <a class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">新增上架</a>
            <a class="nav-link" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">已上架</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"><br><!--增新上架-->
            <form action="{{ route('putshelfs.store')}} " method="POST" name="myForm">
                @csrf
                    <div class="col-md-6 offset-md-3">
                        <label for="inputPassword4" class="form-label ">飛機名稱：</label>
                        <select name="apname" class="form-select" aria-label="Default select example">
                            <option selected></option>
                            @foreach($airplanes as $airplane)
                                <option>{{ $airplane->airName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <label for="inputAddress" class="form-label">起飛日期：</label>
                        <input type="date" value="{{ old('apdate') }}" name="apdate" class="form-control" id="apdate" max="2030-12-31" min="">
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <label for="inputAddress" class="form-label">起飛時間：</label>
                        <input type="time" value="{{ old('aptime') }}" name="aptime" class="form-control" id="aptime" >
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <label for="inputAddress" class="form-label">起飛地點：</label>
                        <select name="apto" class="form-select" onChange="renew(this.selectedIndex);" aria-label="Default select example">
                            <option selected></option>
                            <option>松山(TSA)</option>
                            <option>高雄(KHH)</option>
                            <option>台中(RMQ)</option>
                            <option>花蓮(HUN)</option>
                            <option>台東(TTT)</option>
                            <option>澎湖(MZG)</option>
                            <option>金門(KNH)</option>
                        </select>
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <label for="inputAddress" class="form-label">降落地點：</label>
                        <select  name="apfo" class="form-select" aria-label="Default select example">
                            <option selected ></option>
                        </select>
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <label for="inputPassword4" class="form-label ">機票價格：</label>
                        <input type="text" value="{{ old('apprice') }}" name="apprice" class="form-control" id="apname">
                    </div>
                    <br>
                    <div class="d-grid gap-2 col-md-2 mx-auto">
                    <!-- Button trigger modal -->
                    <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">新增</button>
                    </div>
            </form>
        </div>    
        <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"><!--上架-->

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
{{-- {{dd(date('H:i', strtotime('+8HOUR')))}} --}}

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
                        @endif
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </section>
        </div>
    </div>    
    <script> //地點篩選
        department=new Array();
        department[0]=[];	// 空白
        department[1]=["台東(TTT)", "澎湖(MZG)", "金門(KNH)"];	// 松山(TSA)
        department[2]=["花蓮(HUN)", "澎湖(MZG)"];	// 高雄(KHH)
        department[3]=["花蓮(HUN)", "澎湖(MZG)", "金門(KNH)"];// 台中(RMQ)
        department[4]=["高雄(KHH)", "台中(RMQ)"];	//花蓮(HUN)
        department[5]=["松山(TSA)"];	// 台東(TTT)	
        department[6]=["松山(TSA)", "高雄(KHH)", "台中(RMQ)"];// 澎湖(MZG)
        department[7]=["松山(TSA)", "台中(RMQ)"];	//金門(KNH)
        
        
        function renew(index){
          for(var i=0;i<department[index].length;i++)
            document.myForm.apfo.options[i]=new Option(department[index][i], department[index][i]);	// 設定新選項
          document.myForm.apfo.length=department[index].length;	// 刪除多餘的選項
        }
        </script>
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
              $("#apdate").attr("min",year+"-"+month+"-"+date);})  </script>
@endsection