{{-- serviceIntroduction --}}
@extends(((isset($mId)) ? 'layouts.be_member' : 'layouts.be_buy' ))

@section('css')
    <link rel="stylesheet" href="{{ asset('css/be_all.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|後台_首頁</title>
@endsection

@section('main')
                    
    <div class="col" >                     
          <div class="row justify-content-center mt-0"style="height: 100%;">
              <div class="col-12 col-sm-9 col-md-7  text-center p-0 mt-5 mb-3"> 
                  <form id="msform">  
                      <fieldset style="background: transparent;"> 
                        <div class="form-card"> 
                          <h4 class="fs-title">服務介紹</h4>
                            <div class="row">
                              <div class="col-12">   
                                <br>&emsp; 
                                國內機票訂購方式和航空有許多種，常常讓人看得眼花撩亂，若是使用旅遊網站查詢訂購，
                                可以得到許多不同旅遊規劃，但是對於只想購買到較便宜機票的使用者，有太多東西眼花撩亂並且有許多不確定性，
                                例如：個人資料會不會外洩，是否真的有訂購到機票、是否是正規的管道…等問題；
                                若是使用航空公司的官方網站查詢訂購，可以方便明瞭許多資訊，也比較安心有保障，
                                但是目前國內機票只有兩家航空公司可以選擇，官方網站也不太直覺，所以我們決定模擬一家航空公司製作訂票網站。
                                <br><br>&emsp;
                                由於上述的原因，希望設計一個航空公司國內機票訂購網站，提供國內機票查詢、訂購功能，
                                同時使用者可以透過網站直接下單購票，利用查詢功能查詢需要購買的日期、時間、可搭乘航班、出發地、目的地、
                                人數，一目了然的介面、簡單明瞭的操作，讓使用者可以安心、簡單的使用此網站。
                              </div> 
                           </div>     
                        </div>
                      </fieldset>  
                  </form>  
              </div> 
            
         
@endsection