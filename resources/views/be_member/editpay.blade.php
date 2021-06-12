@extends('layouts.member_center')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/be_all.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|會員中心_信用卡資料更改</title>
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

    <form id="msform" action="{{ route('member.updatepay')}}" method="POST">
      @csrf
      <fieldset> 
        <div class="form-card"> 
          <h2 class="fs-title">信用卡資料</h2>
        @if(empty($pays))
        <div class="row offset-md-1">
          <div class="col-6">
            <label >卡別：</label><br>
            <select class="list-dt" id="card" name="cretype"> 
                <option selected value=""></option>
                <option value="1" >Visa Card</option>
                <option value="2" >Master Card</option>
                <option value="3" >American Express</option>
                <option value="4" >JCB Card</option>
            </select>
          </div>
          <div class="col-6">
            <label class="pay">有效日期(月年)：</label> <br><!--maxlength限定字數，oninput限定打數字-->
            <input class="col-3" type="text" id="month" name="camonth" placeholder="月" maxlength="2" oninput = "value=value.replace(/[^\d]/g,'')" />
            <input class="col-4" type="text"  id="year" name="cayear" placeholder="年" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"/> 
          </div>
        </div><br>
        <div class="row offset-md-1">
          <div class="col-6">
            <label >卡號：</label><br>   
            <input class="col-2" type="text" id="id1" name="id1" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"/>–
            <input class="col-2" type="text" id="id2" name="id2" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"/>–
            <input class="col-2" type="text" id="id3" name="id3" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"/>–
            <input class="col-2" type="text" id="id4" name="id4" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"/>
          </div>
          <div class="col-6">
            <label >檢查碼：</label><br>   
            <input class="col-4" type="text"  id="check" name="cacheckcode" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"/><br>
          </div>
        </div>
        @else
            @foreach ($pays as $pay)
            <div class="row offset-md-1">
              <div class="col-6">
                <label >卡別：</label><br>
                <select class="list-dt" id="card" name="cretype"> 
                    {{-- <option selected value=""></option> --}}
                    <option value="1" {{ (($pay->creType) == "1" ? "selected":"") }}>Visa Card</option>
                    <option value="2" {{ (($pay->creType) == "2" ? "selected":"") }}>Master Card</option>
                    <option value="3" {{ (($pay->creType) == "3" ? "selected":"") }}>American Express</option>
                    <option value="4" {{ (($pay->creType) == "4" ? "selected":"") }}>JCB Card</option>
                </select>
              </div>
              <div class="col-6">
                <label class="pay">有效日期(月年)：</label> <br><!--maxlength限定字數，oninput限定打數字-->
                <input class="col-3" type="text" id="month" name="camonth" placeholder="月" maxlength="2" oninput = "value=value.replace(/[^\d]/g,'')" 
                value="{{(substr($pay->validityPeriod,0,1)) == '0' ? substr($pay->validityPeriod,1,1) : substr($pay->validityPeriod,0,2)}}"/>

                <input class="col-4" type="text"  id="year" name="cayear" placeholder="年" maxlength="4" 
                oninput = "value=value.replace(/[^\d]/g,'')" value="20{{substr("$pay->validityPeriod", -2)}}"/> 
              </div>
            </div><br>
            <div class="row offset-md-1">
              <div class="col-6">
                <label >卡號：</label><br>   
                <input class="col-2" type="text" id="id1" name="id1" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"
                value="{{substr("$pay->caNumber",0,4)}}"/>–
                <input class="col-2" type="text" id="id2" name="id2" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"
                value="{{substr("$pay->caNumber",4,4)}}"/>–
                <input class="col-2" type="text" id="id3" name="id3" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"
                value="{{substr("$pay->caNumber",8,4)}}"/>–
                <input class="col-2" type="text" id="id4" name="id4" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"
                value="{{substr("$pay->caNumber",-4)}}"/> 
              </div>
              <div class="col-6">
                <label >檢查碼：</label><br>   
                <input class="col-4" type="text"  id="check" name="cacheckcode" maxlength="4"
                oninput = "value=value.replace(/[^\d]/g,'')" value="{{$pay->checkCode}}"/><br>
                {{-- maxlength={{(($pay->creType) == "3" ? "4" : "3" )}} --}}
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