@extends('layouts.member_center')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/be_all.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|會員中心_會員資料更改</title>
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

    <form action="{{ route('member.updatemember')}}" method="POST">
        @csrf
        會員資料<br> 
        @foreach ($members as $member)
        電子信箱：<input type="text" name="mEmail" value="{{$member->mEmail}}"><br>
        手機號碼：<input type="text" name="mPhone" value="{{$member->mPhone}}"><br>
        @endforeach
        <button type="button" onclick="location.href='{{route('member.index')}}'">取消</button><br>
        <button type="submit">確定修改</button>
    </form>
    
@endsection