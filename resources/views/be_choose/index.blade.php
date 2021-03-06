{{-- choose --}}
@extends(((isset($mId)) ? 'layouts.be_member' : 'layouts.be_buy' ))

@section('css')
    <link rel="stylesheet" href="{{ asset('css/be_all.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|選擇航班_去程</title>
@endsection

@section('main')
<div class="container-fluid warp" id="grad1">
    <div class="row justify-content-center mt-0">
<div class=" col-md-12 col-lg-10 col-xl-8 text-center p-0 mt-5 mb-3">  
    @if ($errors->any())
        <div class="errors m-2 p-1 bg-red-500 text-red-100 font-thin rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif  
  {{-- <form id="msform" action="{{ route('choose.index2')}}" method="GET"> --}}
    <div id="msform">
    <ul id="progressbar" style="padding:0px">  
        <li class="active" id="account"><strong>選擇航班</strong></li>  
        <li id="personal"><strong>填寫訂單</strong></li>  
        <li id="payment"><strong>付款</strong></li>  
        <li id="confirm"><strong>完成訂單</strong></li>      
    </ul> <!-- fieldsets -->
    <fieldset style="background: transparent;"> 
        <div class="form-card"> 
            <h4 class="fs-title">選擇航班</h4>
    
    @php
        $cnt = 0;
    @endphp
        <div class="border border-secondary rounded-1 col-md-12" style="padding: 10px; padding-left:15px">
            <b>去程:</b>
            @foreach ($toplace as $tp)
                {{$tp->loName}}
            @endforeach
            ->
            @foreach ($foplace as $fp)
                {{$fp->loName}}
            @endforeach
            
            <br>
            日期:{{$dateto}}
        </div><br>
    @if(empty($toflights))
        <h4 class="col-2">查無航班!</h4>
    @endif
    @foreach ($toflights as $toflight)
    @php
        $cnt += 1;
        $cntt=strval($cnt);
    @endphp
    
        @if ($toflight->date == date('Y-m-d', strtotime('+8HOUR') ))
            @if ($toflight->Ltime > date('H:i', strtotime('+8HOUR') ))
            
            <div class="accordion" id="accordionExample"><!--手風琴-->
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button  collapsed" type="button" data-toggle="collapse".$cntt data-target="#collapseOne{{$cntt}}" aria-expanded="false" aria-controls="collapseOne">
                      飛機名稱:{{$toflight->fName}} &nbsp;&nbsp;
                      起飛時間:{{$toflight->Ltime}}&nbsp;&nbsp;
                      旅客人數:{{$quantity}}&nbsp;&nbsp;
                      @if ($quantity2 != 0)
                          嬰兒人數:{{$quantity2}}
                      @endif
                    </button>
                </h2>
                <form action="{{ route('choose.index2')}}" method="GET" >
                  <div id="collapseOne{{$cntt}}".$cntt class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                    @csrf 
                    {{-- 去程航班id --}}
                    <input type="hidden" name="apId" value="{{$toflight->fId}}">
                    <input type="hidden" name="quantity" value="{{$quantity}}">
                    <input type="hidden" name="quantity2" value="{{$quantity2}}">
                    
                    @if (isset($datefo))
                        <input type="hidden" name="apto" value="{{$apto}}">
                        <input type="hidden" name="apfo" value="{{$apfo}}">
                        <input type="hidden" name="datefo" value="{{$datefo}}">
                    @endif
                <div class="row">
                  <div class="col-xl-4" style="padding-right: 0%;">
                    <label for="">全額</label>
                  <div class="text-end">
                    ${{$toflight->fprice}}
                      <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket2{{$cntt}}' />
                      {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
                      <input type='text' readonly="readonly" name='ticket2' value="{{old('ticket2') ?? '0'}}" class='qty col-md-4' id='ticket2{{$cntt}}' style="width: 15%;"/>
                      <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket2{{$cntt}}' />
                  </div>
                      </div>
                  <div class="col-xl-4"style="padding-right: 0%;">
                    <label for="">孩童</label>
                    <div class="text-end">
                    @foreach ($ticket1 as $t1)
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
                    @endforeach
                    <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket16{{$cntt}}' />
                    <input type='text' readonly="readonly" name='ticket16' value="{{old('ticket16') ?? '0'}}" class='qty col-md-4' id='ticket16{{$cntt}}' style="width: 15%;"/>
                    <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket16{{$cntt}}' />
                    </div>
                  </div>
                  <div class="col-xl-4" style="padding-right: 0%;">
                    <label for="">敬老</label>
                    <div class="text-end">
                    @foreach ($ticket2 as $t1)
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
                    @endforeach
                    <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket7{{$cntt}}' />
                    <input type='text' readonly="readonly" name='ticket7' value="{{old('ticket7') ?? '0'}}" class='qty col-md-4' id='ticket7{{$cntt}}' style="width: 15%;"/>
                    <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket7{{$cntt}}' />
                    </div>
                  </div>
                  <div class="col-xl-4" style="padding-right: 0%;">
                    <label for="">軍人</label>
                    <div class="text-end">
                    @foreach ($ticket3 as $t1)
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
                    @endforeach
                    <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket8{{$cntt}}' />
                    <input type='text' readonly="readonly" name='ticket8' value="{{old('ticket8') ?? '0'}}" class='qty col-md-4' id='ticket8{{$cntt}}' style="width: 15%;"/>
                    <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket8{{$cntt}}' />
                    </div>
                  </div>
                  <div class="col-xl-4" style="padding-right: 0%;">
                    <label for="">愛心</label>
                    <div class="text-end">
                    @foreach ($ticket4 as $t1)
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
                    @endforeach
                    <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket9{{$cntt}}' />
                    <input type='text' readonly="readonly" name='ticket9' value="{{old('ticket9') ?? '0'}}" class='qty col-md-4' id='ticket9{{$cntt}}' style="width: 15%;"/>
                    <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket9{{$cntt}}' />
                    </div>
                  </div>
                  <div class="col-xl-4" style="padding-right: 0%;">
                    <label for="">愛心陪同</label>
                    <div class="text-end">
                    @foreach ($ticket5 as $t1)
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
                    @endforeach
                    <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket10{{$cntt}}' />
                    <input type='text' readonly="readonly" name='ticket10' value="{{old('ticket10') ?? '0'}}" class='qty col-md-4' id='ticket10{{$cntt}}' style="width: 15%;"/>
                    <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket10{{$cntt}}' />
                    </div>
                  </div>
                  
                    @if ($ticket11 -> isNotEmpty())
                        @foreach ($ticket6 as $t1)
                        <div class="col-xl-4" style="padding-right: 0%;">
                        <label for="">{{$t1->tName}}</label>
                            ${{round(($t1->tPrice) * ($toflight->fprice))}}
                      <div class="text-end">
                        @if ($t1->tPrice == 0.93)
                            @php
                                $x='ticket3'
                            @endphp
                        @elseif($t1->tPrice == 0.92)
                            @php
                                $x='ticket4'
                            @endphp
                        @elseif($t1->tPrice == 0.85)
                            @php
                                $x='ticket5'
                            @endphp
                        @elseif($t1->tPrice == 0.75)
                            @php
                                $x='ticket6'
                            @endphp  
                        @endif
                        <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field={{$x.$cntt}} />
                        <input type='text' readonly="readonly" name={{$x}} value="{{old('ticket7') ?? '0'}}" class='qty col-md-4' id={{$x.$cntt}} style="width: 15%;"/>
                        <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field={{$x.$cntt}} />
                    </div>
                        @endforeach
                    </div>
                    @endif
                      
                 
                </div>
                    <hr>
                <div class="row">
                    <div class="col-xl-4"style="padding-right: 0%;">
                    <label for="">離島居民</label>
                    <div class="text-end">
                    @foreach ($ticket7 as $t1)
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
                    @endforeach
                    <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket11{{$cntt}}' />
                    <input type='text' readonly="readonly" name='ticket11' value="{{old('ticket11') ?? '0'}}" class='qty col-md-4' id='ticket11{{$cntt}}' style="width: 15%;"/>
                    <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket11{{$cntt}}' />
                    </div>
                  </div>
                  <div class="col-xl-4"style="padding-right: 0%;">
                    <label for="">離島居民敬老</label>
                    <div class="text-end">
                    @foreach ($ticket8 as $t1)
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
                    @endforeach
                    <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket13{{$cntt}}' />
                    <input type='text' readonly="readonly" name='ticket13' value="{{old('ticket13') ?? '0'}}" class='qty col-md-4' id='ticket13{{$cntt}}' style="width: 15%;"/>
                    <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket13{{$cntt}}' />
                    </div>
                  </div>
                  <div class="col-xl-4"style="padding-right: 0%;">
                    <label for="">離島居民愛心</label>
                    <div class="text-end">
                    @foreach ($ticket9 as $t1)
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
                    @endforeach
                    <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket14{{$cntt}}' />
                    <input type='text' readonly="readonly" name='ticket14' value="{{old('ticket14') ?? '0'}}" class='qty col-md-4' id='ticket14{{$cntt}}' style="width: 15%;"/>
                    <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket14{{$cntt}}' />
                    </div>
                  </div>
                  <div class="col-xl-4"style="padding-right: 0%;">
                    <label for="">離島居民愛陪</label>
                    <div class="text-end">
                    @foreach ($ticket10 as $t1)
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
                    @endforeach
                    <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket15{{$cntt}}' />
                    <input type='text' readonly="readonly" name='ticket15' value="{{old('ticket15') ?? '0'}}" class='qty col-md-4' id='ticket15{{$cntt}}' style="width: 15%;"/>
                    <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket15{{$cntt}}' />
                    </div>
                  </div>
                    @if ($ticket11 -> isNotEmpty())
                    <div class="col-xl-4"style="padding-right: 0%;">
                        <label for="">離島居民促銷優惠</label>
                        <div class="text-end">
                        @foreach ($ticket11 as $t1)
                            ${{round(($t1->tPrice) * ($toflight->fprice))}}
                        @endforeach
                        <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket12{{$cntt}}' />
                        <input type='text' readonly="readonly" name='ticket12' value="{{old('ticket12') ?? '0'}}" class='qty col-md-4' id='ticket12{{$cntt}}' style="width: 15%;"/>
                        <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket12{{$cntt}}' />
                        </div>
                      </div>
                      @endif
                </div>
            </div>

                @if(!isset($mId) && !isset($datefo))
                    {{-- 沒有登入而且單程 --}}
                    <button type="button" class="next action-button" data-bs-toggle="modal" data-bs-target="#exampleModal">確定</button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    {{-- <input type="hidden" name="fId"> --}}
                                    <h5 class="modal-title" id="exampleModalLabel">登入</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        如要繼續訂購機票請先登入
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="previous action-button-previous" data-bs-dismiss="modal">取消</button>
                                    <button type="button" class="next action-button" onclick="location.href='{{route('login.index')}}'">前往登入</button>
                                    {{-- <button type="submit" class="btn btn-primary">確認</button> --}}
                                </div>
                                </div>
                            </div>
                        </div>
                @else
                {{-- 有登入 --}}
                    <button type="submit" class="next action-button">確定</button>
                @endif
            </div>
            </form>
          </div>
            </div>
            @else
                <h4>查無航班!</h4>
            @endif
        @else
        
    <div class="accordion" id="accordionExample"><!--手風琴-->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button  collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo{{$cntt}}" aria-expanded="false" aria-controls="collapseTwo">
            飛機名稱:{{$toflight->fName}}&nbsp;&nbsp;
            起飛時間:{{$toflight->Ltime}}&nbsp;&nbsp;
            旅客人數:{{$quantity}}&nbsp;&nbsp;
            @if ($quantity2 != 0)
                嬰兒人數:{{$quantity2}}
            @endif
        </button>
    </h2>
            <form action="{{ route('choose.index2')}}" method="GET">
                {{-- {{dd('jfjskdlfjdsaaaaaaa'.$cntt)}} --}}
                <div id='collapseTwo{{$cntt}}' class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                @csrf 
                {{-- 去程航班id --}}
                <input type="hidden" name="apId" value="{{$toflight->fId}}">
                <input type="hidden" name="quantity" value="{{$quantity}}">
                <input type="hidden" name="quantity2" value="{{$quantity2}}">
                
                @if (isset($datefo))
                    <input type="hidden" name="apto" value="{{$apto}}">
                    <input type="hidden" name="apfo" value="{{$apfo}}">
                    <input type="hidden" name="datefo" value="{{$datefo}}">
                @endif

            <div class="row">
                    <div class="col-xl-4" style="padding-right: 0%;">
                  <label for="">全額</label>
                  <div class="text-end">
                  ${{$toflight->fprice}}
                    <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket2{{$cntt}}'.$cnt />
                    {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
                    <input type='text' readonly="readonly" name='ticket2' value="{{old('ticket2') ?? '0'}}" class='qty col-md-4' id='ticket2{{$cntt}}' style="width: 15%;"/>
                    <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket2{{$cntt}}'.$cnt />
                  </div>
                    </div>
                <div class="col-xl-4"style="padding-right: 0%;">
                  <label for="">孩童</label>
                  <div class="text-end">
                  @foreach ($ticket1 as $t1)
                      ${{round(($t1->tPrice) * ($toflight->fprice))}}
                  @endforeach
                  <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket16{{$cntt}}' />
                  <input type='text' readonly="readonly" name='ticket16' value="{{old('ticket16') ?? '0'}}" class='qty col-md-4' id='ticket16{{$cntt}}'  style="width: 15%;"/>
                  <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket16{{$cntt}}' />
                  </div>
                </div>
                <div class="col-xl-4" style="padding-right: 0%;">
                  <label for="">敬老</label>
                  <div class="text-end">
                  @foreach ($ticket2 as $t1)
                      ${{round(($t1->tPrice) * ($toflight->fprice))}}
                  @endforeach
                  <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket7{{$cntt}}' />
                  <input type='text' readonly="readonly" name='ticket7' value="{{old('ticket7') ?? '0'}}" class='qty col-md-4' id='ticket7{{$cntt}}' style="width: 15%;"/>
                  <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket7{{$cntt}}' />
                  </div>
                </div>
                <div class="col-xl-4"style="padding-right: 0%;">
                  <label for="">軍人</label>
                  <div class="text-end">
                  @foreach ($ticket3 as $t1)
                      ${{round(($t1->tPrice) * ($toflight->fprice))}}
                  @endforeach
                  <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket8{{$cntt}}' />
                  <input type='text' readonly="readonly" name='ticket8' value="{{old('ticket8') ?? '0'}}" class='qty col-md-4' id='ticket8{{$cntt}}' style="width: 15%;"/>
                  <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket8{{$cntt}}' />
                  </div>
                </div>
                <div class="col-xl-4"style="padding-right: 0%;">
                  <label for="">愛心</label>
                  <div class="text-end">
                  @foreach ($ticket4 as $t1)
                      ${{round(($t1->tPrice) * ($toflight->fprice))}}
                  @endforeach
                  <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket9{{$cntt}}' />
                  <input type='text' readonly="readonly" name='ticket9' value="{{old('ticket9') ?? '0'}}" class='qty col-md-4' id='ticket9{{$cntt}}' style="width: 15%;"/>
                  <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket9{{$cntt}}' />
                  </div>
                </div>
                <div class="col-xl-4"style="padding-right: 0%;">
                  <label for="">愛心陪同</label>
                  <div class="text-end">
                  @foreach ($ticket5 as $t1)
                      ${{round(($t1->tPrice) * ($toflight->fprice))}}
                  @endforeach
                  <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket10{{$cntt}}' />
                  <input type='text' readonly="readonly" name='ticket10' value="{{old('ticket10') ?? '0'}}" class='qty col-md-4' id='ticket10{{$cntt}}' style="width: 15%;"/>
                  <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket10{{$cntt}}' />
                  </div>
                </div>
                
                  @if ($ticket11 -> isNotEmpty())
                  <div class="col-xl-4"style="padding-right: 0%;">
                      @foreach ($ticket6 as $t1)
                      <label for="">{{$t1->tName}}</label>
                          ${{round(($t1->tPrice) * ($toflight->fprice))}}
                      <div class="text-end">
                      @if ($t1->tPrice == 0.93)
                          @php
                              $x='ticket3'
                          @endphp
                      @elseif($t1->tPrice == 0.92)
                          @php
                              $x='ticket4'
                          @endphp
                      @elseif($t1->tPrice == 0.85)
                          @php
                              $x='ticket5'
                          @endphp
                      @elseif($t1->tPrice == 0.75)
                          @php
                              $x='ticket6'
                          @endphp  
                      @endif
                      <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field={{$x.$cntt}} />
                      <input type='text' readonly="readonly" name={{$x}} value="{{old('ticket7') ?? '0'}}" class='qty col-md-4' id={{$x.$cntt}} style="width: 15%;"/>
                      <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field={{$x.$cntt}} />
                    </div>
                      @endforeach
                    </div>
                  @endif
            </div>
                  <hr>
              <div class="row">
                  <div class="col-xl-4"style="padding-right: 0%;">
                  <label for="">離島居民</label>
                  <div class="text-end">
                  @foreach ($ticket7 as $t1)
                      ${{round(($t1->tPrice) * ($toflight->fprice))}}
                  @endforeach
                  <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket11{{$cntt}}' />
                  <input type='text' readonly="readonly" name='ticket11' value="{{old('ticket11') ?? '0'}}" class='qty col-md-4' id='ticket11{{$cntt}}' style="width: 15%;"/>
                  <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket11{{$cntt}}' />
                  </div>
                </div>
                <div class="col-xl-4"style="padding-right: 0%;">
                  <label for="">離島居民敬老</label>
                  <div class="text-end">
                  @foreach ($ticket8 as $t1)
                      ${{round(($t1->tPrice) * ($toflight->fprice))}}
                  @endforeach
                  <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket13{{$cntt}}' />
                  <input type='text' readonly="readonly" name='ticket13' value="{{old('ticket13') ?? '0'}}" class='qty col-md-4' id='ticket13{{$cntt}}' style="width: 15%;"/>
                  <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket13{{$cntt}}' />
                  </div>
                </div>
                <div class="col-xl-4"style="padding-right: 0%;">
                  <label for="">離島居民愛心</label>
                  <div class="text-end">
                  @foreach ($ticket9 as $t1)
                      ${{round(($t1->tPrice) * ($toflight->fprice))}}
                  @endforeach
                  <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket14{{$cntt}}' />
                  <input type='text' readonly="readonly" name='ticket14' value="{{old('ticket14') ?? '0'}}" class='qty col-md-4' id='ticket14{{$cntt}}' style="width: 15%;"/>
                  <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket14{{$cntt}}' />
                  </div>
                </div>
                <div class="col-xl-4"style="padding-right: 0%;">
                  <label for="">離島居民愛陪</label>
                  <div class="text-end">
                  @foreach ($ticket10 as $t1)
                      ${{round(($t1->tPrice) * ($toflight->fprice))}}
                  @endforeach
                  <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket15{{$cntt}}' />
                  <input type='text' readonly="readonly" name='ticket15' value="{{old('ticket15') ?? '0'}}" class='qty col-md-4' id='ticket15{{$cntt}}' style="width: 15%;"/>
                  <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket15{{$cntt}}' />
                  </div>
                </div>
                  @if ($ticket11 -> isNotEmpty())
                  <div class="col-xl-4"style="padding-right: 0%;">
                      <label for="">離島居民促銷優惠</label>
                      <div class="text-end">
                      @foreach ($ticket11 as $t1)
                          ${{round(($t1->tPrice) * ($toflight->fprice))}}
                      @endforeach
                      <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-3' field='ticket12{{$cntt}}' />
                      <input type='text' readonly="readonly" name='ticket12' value="{{old('ticket12') ?? '0'}}" class='qty col-md-4' id='ticket12{{$cntt}}' style="width: 15%;"/>
                      <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-3' field='ticket12{{$cntt}}' />
                      </div>
                    </div>
                  @endif
              </div>  
          </div>
            @if(!isset($mId) && !isset($datefo))
                {{-- 沒有登入而且單程 --}}
                <button type="button" class="next action-button" data-bs-toggle="modal" data-bs-target="#exampleModal">確定</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                {{-- <input type="hidden" name="fId"> --}}
                                <h5 class="modal-title" id="exampleModalLabel">登入</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    如要繼續訂購機票請先登入
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="previous action-button-previous" data-bs-dismiss="modal">取消</button>
                                <button type="button" class="next action-button" onclick="location.href='{{route('login.index')}}'">前往登入</button>
                                {{-- <button type="submit" class="btn btn-primary">確認</button> --}}
                            </div>
                            </div>
                        </div>
                    </div>
            @else
            {{-- 有登入 --}}
                <button type="submit" class="next action-button">確定</button>
            @endif

        </div>
      </div></div>
            </form>
        @endif
    @endforeach
  </fieldset> 
    {{-- <button type="button" onclick="location.href='{{ url()->previous() }}'" class="previous action-button-previous">上一頁</button> --}}
    {{-- <button type="submit" class="next action-button" >確定</button> --}}
    
    {{-- {{dd($mId,$datefo)}} --}}


{{-- </form>   --}}
</div>  
</div> 


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script>
        $(function() {
            // This button will increment the value
            $('.qtyplus').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                fieldName = $(this).attr('field');
                // Get its current value
                var currentVal = parseInt($('input[id=' + fieldName + ']').val());
                // If is not undefined
                if (!isNaN(currentVal) && currentVal < 4) {
                // Increment
                $('input[id=' + fieldName + ']').val(currentVal + 1);
                } else {
                // Otherwise put a 0 there
                $('input[id=' + fieldName + ']').val(4);
                }
            });
            // This button will decrement the value till 0
            $(".qtyminus").click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                fieldName = $(this).attr('field');
                // Get its current value
                var currentVal = parseInt($('input[id' + fieldName + ']').val());
                // If it isn't undefined or its greater than 0
                if (!isNaN(currentVal) && currentVal > 0) {
                // Decrement one
                $('input[id=' + fieldName + ']').val(currentVal - 1);
                } else {
                // Otherwise put a 0 there
                $('input[id=' + fieldName + ']').val(0);
                }
            });
        });
    </script>

@endsection