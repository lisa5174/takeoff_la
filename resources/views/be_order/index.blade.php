@extends('layouts.be_buy')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/be_all.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|後台_填寫訂單</title>
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

    <form action="{{ route('pay.index')}}" method="GET">
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
        
        <input type="hidden" name="quantity2" value="{{$quantity2}}">
        
        <div class=" col-md-12 col-lg-10 col-xl-6 text-center p-0 mt-5 mb-3">  
            <form id="msform">  
                <!-- progressbar -->  
                <ul id="progressbar">  
                   <li class="active" id="account"><strong>選擇航班</strong></li>  
                    <li id="personal" class="active"><strong>填寫訂單</strong></li>  
                    <li id="payment"><strong>付款</strong></li>  
                    <li id="confirm"><strong>完成訂單</strong></li>      
                </ul> <!-- fieldsets -->
                <fieldset>  
                    <div class="form-card">  
                        <h4 class="fs-title">填寫訂單</h4>
                        <div class="row">
                          <h4 class="fs-title2">旅客</h4> <br>
                            
                        @if(empty($passengers))
                          <div class="col-3"> 
                            姓名：<input type="text" name="pname" value="{{ old('pname') }}"></div>
                          <div class="col-2">   
                            性別：<br>
                            <select name="pgender" class="list-dt"> 
                                <option selected></option>
                                <option value="1">男</option>
                                <option value="0">女</option>
                            </select></div>
                          <div class="col-3">   
                            身分證字號：<input type="text" name="pid" value="{{ old('pid') }}"></div>
                          <div class="col-4"> 
                            生日：<input type="date" name="pbirth" value="{{ old('pbirth') }}"></div>
                        </div>
                        @else
                          <div class="col-3"> 
                            @foreach ($passengers as $passenger)
                            姓名：<input type="text" name="pname" value="{{$passenger->pName}}"></div>
                            {{-- 性別：{{$gender}}<br> --}}
                          <div class="col-2">
                            性別：
                            <select name="pgender"> 
                                <option value="1" {{$passenger->pId == '1' ? 'selected' : ''}}>男</option>
                                <option value="0" {{$passenger->pId == '0' ? 'selected' : ''}}>女</option>
                            </select></div>
                          <div class="col-3">
                            身分證字號：<input type="text" name="pid" value="{{$passenger->pId}}"></div>
                          <div class="col-4">
                            生日：<input type="date" name="pbirth" value="{{$passenger->birthday}}"></div>
                            @endforeach
                    </div>
                        @endif
                          <div class="row">
                            <h4 class="fs-title2">聯絡人</h4> <br>
                             
                            @if(empty($contacts))
                            <div class="col-3"> 
                                姓名：<input type="text" name="cname" value="{{ old('cname') }}"></div>
                            <div class="col-3">
                                行動電話：<input type="text" name="cphone" value="{{ old('cphone') }}"></div>
                            <div class="col-3">
                                電子信箱：<input type="text" name="cemail" value="{{ old('cemail') }}"></div>
                            </div>
                              @else
                              <div class="row">
                                @foreach ($contacts as $contact)
                            <div class="col-3"> 
                                姓名：<input type="text" name="cname" value="{{$contact->cName}}"></div>
                            <div class="col-3">     
                                行動電話：<input type="text" name="cphone" value="{{$contact->cPhone}}"></div>
                            <div class="col-3"> 
                                電子信箱：<input type="text" name="cemail" value="{{$contact->cEmail}}"></div>
                            </div>
                                @endforeach
                            </div>
                            @endif
                        <button type="submit" class="previous action-button-previous">上一步</button>
                        <button type="submit" class="next action-button">下一步</button>
                </fieldset>
            </form>  
        </div>  
                <footer class="footer row ">
                    <label class="col align-self-center">Copyright © 2021 Take off 空 products. 版權所有</label>
                   </footer>
    </form>
    @endsection
