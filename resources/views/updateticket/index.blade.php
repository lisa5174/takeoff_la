@extends('layouts.flights')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/b_today.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|後台_修改</title>
@endsection

@section('main')

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

<span class="col-10" id="g1"> <br>
          <div class="container">
            <div class="row"><h4>訂單資訊</h4></div><br>
            <div class="row offset-md-1">
              <div class="col-4">姓名：</div>
              <div class="col-6">身分證字號：</div>
            </div><br>
            <div class="row offset-md-1">
              <div class="col-4">性別：</div>
              <div class="col-6">生日：</div>
            </div><br>
            <div class="row offset-md-1">
              <div class="col-4">票種：</div>
            </div><br>
            <div class="row offset-md-1">
              <div class="col-4">航班資訊：</div>
            </div>
          </div><br>
          
          <div class="d-grid gap-2 col-2 mx-auto">
         <button type="submit" class="btn btn-primary">修改</button>
      </div>



@endsection