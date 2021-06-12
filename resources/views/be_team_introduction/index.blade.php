{{-- teamIntroduction --}}
@if(isset($mId))
  @extends('layouts.be_member')  
    {{-- 有登入 --}}
@else
  @extends('layouts.be_buy')
  {{-- 沒有登入 --}}
@endif
@section('css')
    <link rel="stylesheet" href="{{ asset('css/be_all.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|後台_首頁</title>
@endsection

@section('main')
<div class="col">                     
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-9 col-md-7  text-center p-0 mt-5 mb-3"> 
            <form id="msform">  
                <fieldset> 
                  <div class="form-card"> 
                    <h4 class="fs-title">團隊介紹</h4>
                      <div class="row">
                        <div class="col-12">   
                          <br>&emsp; 
                          我們是來自台中科技大學資管科資訊應用菁英班四甲的同學 1110634003施羽珊、1110634007黃玉杏，
                          分工：網頁前端：施羽珊，後端資料庫：黃玉杏，文書：施羽珊、黃玉杏，原本只是認為這只是一個功課，
                          但是漸漸的發現，每一次的溝通、撰寫程式碼、查找資料都在讓我們漸漸成長，互相的溝通、意見碰撞、相互學習都讓我們收穫許多。
                        </div> 
                     </div>     
                  </div>
                </fieldset>  
            </form>  
        </div> 
        
@endsection