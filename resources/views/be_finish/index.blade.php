@extends('layouts.be_member')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/be_all.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|完成訂單</title>
@endsection

@section('main')
<div class="container-fluid" id="grad1">
  <div class="row justify-content-center mt-0">
<div class=" col-md-12 col-lg-10 col-xl-8 text-center p-0 mt-5 mb-3">  
    <form id="msform" action="{{ route('membersearch.checkoutsuccess')}}" method="GET">
        @csrf 
        {{-- 去程航班id --}}
        <input type="hidden" name="toId" value="{{$toId}}">
        <input type="hidden" name="toticket1[]" value="{{$toticket1[0]}}">
        <input type="hidden" name="toticket1[]" value="{{$toticket1[1]}}">
        <input type="hidden" name="toticket2[]" value="{{$toticket2[0]}}">
        <input type="hidden" name="toticket2[]" value="{{$toticket2[1]}}">
        <input type="hidden" name="toticket3[]" value="{{$toticket3[0]}}">
        <input type="hidden" name="toticket3[]" value="{{$toticket3[1]}}">
        <input type="hidden" name="toticket4[]" value="{{$toticket4[0]}}">
        <input type="hidden" name="toticket4[]" value="{{$toticket4[1]}}">

        @if(isset($foId))
            <input type="hidden" name="foticket1[]" value="{{$foticket1[0]}}">
            <input type="hidden" name="foticket1[]" value="{{$foticket1[1]}}">
            <input type="hidden" name="foticket2[]" value="{{$foticket2[0]}}">
            <input type="hidden" name="foticket2[]" value="{{$foticket2[1]}}">
            <input type="hidden" name="foticket3[]" value="{{$foticket3[0]}}">
            <input type="hidden" name="foticket3[]" value="{{$foticket3[1]}}">
            <input type="hidden" name="foticket4[]" value="{{$foticket4[0]}}">
            <input type="hidden" name="foticket4[]" value="{{$foticket4[1]}}">
            {{-- 回程航班id --}}
            <input type="hidden" name="foId" value="{{$foId}}">
        @endif
        
        <input type="hidden" name="tprice" value="{{$price[1]}}">
        <input type="hidden" name="fprice" value="{{$price[2]}}">

        <input type="hidden" name="quantity2" value="{{$quantity2}}">

        @for ($i = 0; $i < count($price[3]); $i++)
          <input type="hidden" name="pname[]" value="{{$pname[$i]}}">
          <input type="hidden" name="pgender[]" value="{{$pgender[$i]}}">
          <input type="hidden" name="pid[]" value="{{$pid[$i]}}">
          <input type="hidden" name="pbirth[]" value="{{$pbirth[$i]}}">
        @endfor

        <input type="hidden" name="cname" value="{{$cname}}">
        <input type="hidden" name="cphone" value="{{$cphone}}">
        <input type="hidden" name="cemail" value="{{$cemail}}">
        
        <input type="hidden" name="cretype" value="{{$cretype}}">
        <input type="hidden" name="camonth" value="{{$camonth}}">
        <input type="hidden" name="cayear" value="{{$cayear}}">
        <input type="hidden" name="caid" value="{{$caid[0]}}">
        <input type="hidden" name="cacheckcode" value="{{$cacheckcode}}">
        <!-- progressbar -->  
        <ul id="progressbar"  style="padding:0px">  
          <li class="active" id="account"><strong>選擇航班</strong></li>  
          <li id="personal" class="active"><strong>填寫訂單</strong></li>  
          <li id="payment" class="active"><strong>付款</strong></li>  
          <li id="confirm" class="active"><strong>完成訂單</strong></li>      
        </ul> <!-- fieldsets -->
        
        <fieldset style="background: transparent;"> 
        <div class="form-card"> 
          <h2 class="fs-title">訂票資訊</h2>
            <div class="container">
              <div class="row">
                <h5 class="fs">航班</h5></div><br>
                @foreach ($toflights as $toflight)
                <div class="row offset-md-1">
                  <b class="fs" style="font-size: 18px">去程</b><br>
                  <div class="col-md-6">飛機名稱：{{$toflight->fName}}</div>
                </div><br>
                <div class="row offset-md-1">
                  <div class="col-md-6">出發機場：{{$toflight->toplace}}</div>
                  <div class="col-md-6">目的機場：{{$toflight->foplace}}</div>
                </div><br>
                <div class="row offset-md-1">
                  <div class="col-md-6">起飛日期：{{$toflight->date}}</div>
                  <div class="col-md-6">起飛時間：{{$toflight->Ltime}}</div>
                </div><br>
                @endforeach
                <div class="row offset-md-1">
                  <div class="col-md-6">人數票種：<br>
                @foreach ($totickets[1] as $toticket)
                    <div style="padding-left:80px">{{$toticket->tName}}票種{{$toticket1[1]}}張</div>
                @endforeach  
                @foreach ($totickets[2] as $toticket)
                    <div style="padding-left:80px">{{$toticket->tName}}票種{{$toticket2[1]}}張</div>
                @endforeach  
                @foreach ($totickets[3] as $toticket)
                    <div style="padding-left:80px">{{$toticket->tName}}票種{{$toticket3[1]}}張</div>
                @endforeach  
                @foreach ($totickets[4] as $toticket)
                    <div style="padding-left:80px">{{$toticket->tName}}票種{{$toticket4[1]}}張</div>
                @endforeach
                @if ($quantity2 != 0)
                    <div style="padding-left:80px">嬰兒票種{{$quantity2}}張</div>
                @endif 
              </div>
                  <div class="col-md-6">機票價格：{{$price[1]}}</div><br>
                </div><br>
                
                @if(isset($foId))
                <div class="row offset-md-1">
                  <b class="fs" style="font-size: 18px">回程</b><br>
                  @foreach ($foflights as $foflight)
                  <div class="col-md-6">飛機名稱：{{$foflight->fName}}</div>
                </div><br>
                <div class="row offset-md-1">
                  <div class="col-md-6">出發機場：{{$foflight->toplace}}</div>
                  <div class="col-md-6">目的機場：{{$foflight->foplace}}</div>
                </div><br>
                <div class="row offset-md-1">
                  <div class="col-md-6">起飛日期：{{$foflight->date}}</div>
                  <div class="col-md-6">起飛時間：{{$foflight->Ltime}}</div>
                </div><br>
                @endforeach
                <div class="row offset-md-1">
                  <div class="col-md-6">人數票種：<br>
                    @foreach ($fotickets[1] as $foticket)
                        <div style="padding-left:80px">{{$foticket->tName}}票種{{$foticket1[1]}}張</div>
                    @endforeach  
                    @foreach ($fotickets[2] as $foticket)
                        <div style="padding-left:80px">{{$foticket->tName}}票種{{$foticket2[1]}}張</div>
                    @endforeach  
                    @foreach ($fotickets[3] as $foticket)
                        <div style="padding-left:80px">{{$foticket->tName}}票種{{$foticket3[1]}}張</div>
                    @endforeach  
                    @foreach ($fotickets[4] as $foticket)
                        <div style="padding-left:80px"> {{$foticket->tName}}票種{{$foticket4[1]}}張</div>
                    @endforeach
                    @if ($quantity2 != 0)
                        <div style="padding-left:80px">嬰兒票種{{$quantity2}}張</div>
                    @endif 
                  </div>
                  <div class="col-md-6">機票價格：{{$price[2]}}</div><br>
                </div></div><br>
                <div class="row offset-md-1">
                  <b><div class="col-md-6" style="font-size: 18px">共：{{$price[0]}}元</div></b><br> 
                </div>
                @endif
                <br>

                @php
                  $cnt = 0;
                @endphp
                {{-- {{dd($fotickets)}} --}}
            {{-- 有幾種票種 --}}
            @for ($i = 0; $i < count($price[3]); $i++)
            @php
              $ti = 'toticket'.strval($i+1);
            @endphp
            {{-- {{dd($$ti[1])}} --}}
                {{-- 這票種有幾張 --}}
              @for ($j = 0; $j < $$ti[1]; $j++)
                <div class="container">
                  <div class="row">
                    <h5 class="fs">旅客{{$cnt+1}}&nbsp;(<i class="fas fa-plane"></i> {{$totickets[$i+1][0]->tName}}票種
                      {{isset($foId)?'--->':''}}
                      <i class="fas fa-plane fa-flip-horizontal" style={{isset($foId)?'':'display:none'}} ></i>
                      {{isset($foId)?$fotickets[$i+1][0]->tName.'票種':''}})</h5></div><br>
                  <div class="row offset-md-1">
                    <div class="col-md-6">姓名：{{$pname[$cnt]}}</div>
                    <div class="col-md-6">身分證字號：{{$pid[$cnt]}}</div>
                  </div><br>
                  <div class="row offset-md-1">
                    <div class="col-md-6">性別：{{($pgender[$cnt])==0?'女':'男'}}</div>
                    <div class="col-md-6">生日：{{$pbirth[$cnt]}}</div>
                  </div><br>
                </div><br>
                @php
                  $cnt += 1;
                @endphp
              @endfor
            @endfor

            <div class="container">
              <div class="row">
                <h5 class="fs">聯絡人</h5></div><br>
              <div class="row offset-md-1">
                <div class="col-md-6">姓名：{{$cname}}</div>
                <div class="col-md-6">行動電話：{{$cphone}}</div>
              </div><br>
              <div class="row offset-md-1">
                <div class="col-md-12">電子信箱：{{$cemail}}</div>
              </div><br>
            </div><br>
            <div class="container">
              <div class="row">
                <h5 class="fs">信用卡</h5></div><br>
              <div class="row offset-md-1">
                <div class="col-md-6"> 卡別：
                @foreach ($showcretypes as $showcretype)
                    {{$showcretype->creName}}</div>
                @endforeach
                <div class="col-md-6">有效日期(月/年)：{{$camonth}}/{{$cayear}}</div>
              </div><br>
              <div class="row offset-md-1">
                <div class="col-md-6">卡號：{{$caid[1]}}-{{$caid[2]}}-{{$caid[3]}}-{{$caid[4]}}</div>
                <div class="col-md-4">檢查碼：{{$cacheckcode}}</div>
              </div><br>
            </div><br>
        </div>
      </fieldset>
          <input type="button" class="previous action-button-previous" id='back' value='上一步'>
          <script>
              document.getElementById('back').onclick = function () {
                  window.history.back();
              }
          </script>
          <button class="next action-button" type="submit">完成</button>
        
    </form>
  </div>  
 
@endsection