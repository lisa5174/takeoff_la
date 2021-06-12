@extends('layouts.member_center')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/be_all.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|會員中心_聯絡人資料更改</title>
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

    <form action="{{ route('member.updatecontact')}}" method="POST">
        @csrf

        聯絡人資料<br>
        @if(empty($contacts))
            姓名：<input type="text" name="cName"><br>
            行動電話：<input type="text" name="cPhone"><br>
            電子信箱：<input type="text" name="cEmail"><br>
        @else
            @foreach ($contacts as $contact)
            姓名：<input type="text" name="cName" value="{{$contact->cName}}"><br>
            行動電話：<input type="text" name="cPhone" value="{{$contact->cPhone}}"><br>
            電子信箱：<input type="text" name="cEmail" value="{{$contact->cEmail}}"><br>
            @endforeach
        @endif
        
        <button type="button" onclick="location.href='{{route('member.index')}}'">取消</button><br>
        <button type="submit">確定修改</button>
    </form>
    
@endsection