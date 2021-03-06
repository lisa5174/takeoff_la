@extends('layouts.member_center')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/be_all.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|會員中心_重設密碼</title>
@endsection
@section('name')
<style>
  #chc1,#chc2 {
    height: 50px;
    color: black;
    font-size: 20px;
    background-color: #fdd85d;
} 
#chc3 {
    height: 50px;
    color: black;
    font-size: 20px;
    background-color: #ffd23e;
    border:2px #af8c19 solid;
    border-bottom-width:3px ;
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

    <form id="msform" action="{{ route('resetpw.updatepw')}}" method="POST">
      @csrf
			<fieldset style="background: transparent;"> 
			  <div class="form-card"> 
        <h2 class="fs-title">重設密碼</h2><br>  
				<div class="container">
				<div class="row offset-md-1">
          <div class="col-md-4 ">
            原密碼：<input type="password" name="pwd"/>
            新密碼：<input type="password" name="newpwd"/>
            確認新密碼：<input type="password" name="newpwd_confirmation"/>
          </div>
				</div>
				</div>
				</div>
        <button class="previous action-button-previous" type="button" onclick="location.href='{{route('member.index')}}'">取消</button>
        <button class="next action-button" type="submit">確定修改</button>
			</fieldset>
    </form>
    
@endsection