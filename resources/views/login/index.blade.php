aflogin
@extends('layouts.flights')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/b_today.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|後台_登入</title>
@endsection

@section('main')

<div id="boxForm"> <!--登入-->
    <h2 id="title">登入</h2>
    <form>
      <input class='text' type='user' name='user' placeholder='帳號' required>
      <br>
      <input class='text' id='pwd'  type='password' placeholder='密碼' required>
      <br>
      <input id='rememberMe' name='rememberMe' type='checkbox'> <label>記住我</label>
      <br>
      <input class='button' type='submit' value='登入'>
    </form>
  </div>
@endsection