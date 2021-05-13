@extends('layouts.flights')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/b_offshelf.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|後台_下架</title>
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
            <a class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">下架</a>
            <a class="nav-link" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">已下架</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"><!--下架-->
            <div id=h1></div>
            
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
                        @if ($flight->date == date('Y-m-d', strtotime('+8HOUR') ))
                            @if ($flight->Ltime < date('H:i', strtotime('+8HOUR') ))
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

        <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"><!--已上架-->
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
                    <th><h6><b> 刪除</th>
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
                        <td><input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">刪除</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </section>

            <div class="d-grid gap-2 col-2 mx-auto">
                <!-- Button trigger modal -->
                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">刪除</button>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">確認刪除</h5>
                            <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            確定要刪除嗎?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                            <button type="submit" class="btn btn-primary">確認</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>    

@endsection