@extends('layouts.member_center')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/be_all.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|會員中心_會員資料更改</title>
@endsection
@section('name')
<style>
  #chc1,#chc3 {
    height: 50px;
    color: black;
    font-size: 20px;
    background-color: #fdd85d;
} 
#chc2 {
    height: 50px;
    color: black;
    font-size: 20px;
    background-color: #ffd23e;
    /* box-shadow:1px 1px 3px 2px rgba(20%,20%,40%,0.5) inset; */
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

    <form id="msform" action="{{ route('member.updatemember')}}" method="POST">
      @csrf
      <fieldset style="background: transparent;"> 
        <div class="form-card"> 
          <h5 class="fs-title">會員資料</h5> <br>
          @foreach ($members as $member)
          <div class="row offset-md-1">
            <div class="col-4">
              電子信箱：<input type="text" name="mEmail" value="{{$member->mEmail}}"><br>
            </div>
            <div class="col-4">
              手機號碼：<input type="text" name="mPhone" value="{{$member->mPhone}}"><br>
            </div>
          </div>
              @endforeach
        </div>
            <button class="previous action-button-previous" type="button" onclick="location.href='{{route('member.index')}}'">取消</button>
            <button class="next action-button" type="submit">確定修改</button>
      </fieldset>
    </form>
    
@endsection