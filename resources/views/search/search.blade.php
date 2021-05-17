@extends('layouts.flights')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/p2.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|後台_查詢</title>
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

    <form action="{{ url('/search') }} " method="POST">
        {{-- @method('GET') --}}
        @csrf
        <label for="inputPassword4" class="form-label ">飛機名稱：</label>
        <select name="putname" class="form-select" aria-label="Default select example">
            <option selected></option>
            @foreach($airplanes as $airplane)
                <option>{{ $airplane->airName}}</option>
            @endforeach
        </select>
        <input type="date" value="{{ old('putdate') }}" name="putdate" class="form-control">
        <button type="submit" class="m-2 bg-blue-300 px-3 py-2 rounded" >搜尋</button>
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
            <div class="tbl-content ">
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