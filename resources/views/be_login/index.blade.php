@extends('layouts.be_buy')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/be_all.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|登入</title>
@endsection

@section('main')
<div class="col">
  <div class="row justify-content-center mt-0">
    @if ($errors->any())
        <div class="errors m-2 p-1 bg-red-500 text-red-100 font-thin rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif  

    <div class="col-12 col-sm-10 col-md-6 col-lg-4  text-center p-0 mt-5 mb-3"> 
    <form id="msform" action="{{ route('login.login')}}" method="POST">
        @csrf 
        <fieldset> 
            <div class="form-card "> 
              <h2 class="fs-title">登入</h2><br>    
                <div class="container">
                  <div class="row offset-md-1">
                    <div class="col-10">
                      手機號碼或E-mail：<input type="text" name="macount" value="{{ old('macount') }}"><br>
                      密碼：<input type="password" name="mpw" value="{{ old('mpw') }}">
                    </div>
                  </div>
                  <div class="col-10" style="text-align: center;">
                    還不是會員嗎?<a onclick="location.href='{{route('register.index')}}'">點這邊吧~</a>
                 </div>
                </div>
            </div>     
            <button class="next action-button" type="submit">登入</button>
        </fieldset>       
    </form>
  </div> 
@endsection