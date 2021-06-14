@extends('layouts.member_center')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/be_all.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|會員中心_旅客資料更改</title>
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

    <form id="msform" action="{{ route('member.updatepassenger')}}" method="POST">
      @csrf
      <fieldset> 
        <div class="form-card"> 
          <h2 class="fs-title">旅客資料</h2>
        @if(empty($passengers))
        <div class="row offset-md-1">
          <div class="col-4">
            姓名：<input type="text" name="pName" >
          </div>
          <div class="col-5">
            身分證字號：<input type="text" name="pId" >
          </div>
        </div><br>
        <div class="row offset-md-1">
          <div class="col-4">
            性別：<br>
            <select  class="list-dt" name="gender"> 
                <option selected></option>
                <option value="1" >男</option>
                <option value="0" >女</option>
            </select>
          </div>
          <div class="col-6">
            生日：<br><input type="date" name="birthday">
          </div>
        </div>
        @else
          @foreach ($passengers as $passenger)
          <div class="row offset-md-1">
            <div class="col-4">
              姓名：<input type="text" name="pName" value="{{$passenger->pName}}">
            </div>
            <div class="col-5">
              身分證字號：<input type="text" name="pId" value="{{$passenger->pId}}">
            </div>
          </div><br>
          <div class="row offset-md-1">
            <div class="col-4">
              性別：<br>
              <select name="gender"> 
                  {{-- <option selected></option> --}}
                  <option value="1" {{ (($passenger->gender) == "1" ? "selected":"") }}>男</option>
                  <option value="0" {{ (($passenger->gender) == "0" ? "selected":"") }}>女</option>
              </select>
            </div>
            <div class="col-6">
              生日：<br><input type="date" name="birthday" value="{{$passenger->birthday}}">
            </div>
          </div>
            @endforeach
        @endif
        </div>
        
        <button type="button" class="previous action-button-previous" onclick="location.href='{{route('member.index')}}'">取消</button>
        <button type="submit" class="next action-button">確定修改</button>
      </fieldset>
    </form>
    
    
@endsection