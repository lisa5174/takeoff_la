@extends('layouts.flights')



@section('main')
    <h1 class="font-thin text-4xl">今日航班</h1>

    @foreach($flights as $flight)
        <div>
            <h2 class="text-2xl">飛機名稱{{ $flight->fName}}</h2>
            {{-- @php
                require 'vendor/autoload.php';
                use Carbon\Carbon;
                $tt = new Carbon($flight->time);
            @endphp --}}
            {{-- date('Y-m-d H:i:s', time()) --}}
            <p>起飛時間{{ $flight->time }}</p>
            <p>起飛地點{{ $flight->toplace}}</p>
            <p>降落地點{{ $flight->foplace}}</p>
            <p>座位{{ $flight->airSeat}}</p>
            <p>已售座位{{ $flight->unboughtSeat}}</p>
        </div>
    @endforeach


{{-- {{$flights}} --}}

@endsection