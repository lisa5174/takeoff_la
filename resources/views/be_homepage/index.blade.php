@extends('layouts.be_buy')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/be_all.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|後台_首頁</title>
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
  <div class=" col-md-12 col-lg-10 col-xl-6 text-center p-0 mt-5 mb-3">  
      <form id="msform" name="myForm">  
        <!-- progressbar -->  
        <fieldset class="card"> 
            <div class="form-card">  
              <div  class="container">
                <h4 class="fs-title">訂票購買
                  {{-- <input type="radio" class="btn-check" name="type" id="btnradio1" value='domestic-credit' autocomplete="off" checked>
                  <label class="btn btn-outline-info btn-sm " for="btnradio1">單程</label>
                  <input type="radio" class="btn-check" name="type" id="btnradio2" value='aboard-credit' autocomplete="off">
                  <label class="btn btn-outline-info btn-sm " for="btnradio2">來回</label> --}}
                </h4>
              </div>
              <br>
              {{-- <div id='domestic-credit-form'>
                <div class="row">
                  <div class="col-md-5">
                  <form action="{{ route('homepage.store')}} " method="POST"> --}}
                      {{-- choose.index --}}
                      {{-- @csrf
                      <label for="inputAddress" class="form-label">出發機場：</label>
                      <select name="be_apto" class="form-select" aria-label="Default select example" id="sel">
                          <option selected></option>
                          <option value="1" {{ (old("be_apto") == "1" ? "selected":"") }}>松山(TSA)</option>
                          <option value="2" {{ (old("be_apto") == "2" ? "selected":"") }}>高雄(KHH)</option>
                          <option value="3" {{ (old("be_apto") == "3" ? "selected":"") }}>台中(RMQ)</option>
                          <option value="4" {{ (old("be_apto") == "4" ? "selected":"") }}>花蓮(HUN)</option>
                          <option value="5" {{ (old("be_apto") == "5" ? "selected":"") }}>台東(TTT)</option>
                          <option value="6" {{ (old("be_apto") == "6" ? "selected":"") }}>澎湖(MZG)</option>
                          <option value="7" {{ (old("be_apto") == "7" ? "selected":"") }}>金門(KNH)</option>
                      </select>
                   </div>
                      
                      <br>
                   <div class="col-md-5">
                      <label for="inputAddress" class="form-label">目的機場：</label>
                      <select name="be_apfo" class="form-select" aria-label="Default select example" id="sel2">
                          <option selected></option> --}}
                          {{-- <option value="1" {{ (old("be_apfo") == "1" ? "selected":"") }}>松山(TSA)</option>
                          <option value="2" {{ (old("be_apfo") == "2" ? "selected":"") }}>高雄(KHH)</option>
                          <option value="3" {{ (old("be_apfo") == "3" ? "selected":"") }}>台中(RMQ)</option>
                          <option value="4" {{ (old("be_apfo") == "4" ? "selected":"") }}>花蓮(HUN)</option>
                          <option value="5" {{ (old("be_apfo") == "5" ? "selected":"") }}>台東(TTT)</option>
                          <option value="6" {{ (old("be_apfo") == "6" ? "selected":"") }}>澎湖(MZG)</option>
                          <option value="7" {{ (old("be_apfo") == "7" ? "selected":"") }}>金門(KNH)</option> --}}
                      {{-- </select>
                   </div>
                </div>
                      <br>
                  <div class="row">
                    <div class="col-md-5">
                      <label for="inputAddress" class="form-label">啟程日期：</label>
                      <input type="date" value="{{ old('dateto') }}" name="dateto" class="form-control" id="dateto" max="2030-12-31" min="">
                      </div>
                   </div>
                   <div class="row">
                    <div class="col-md-5">
                      <label for="inputState">搭乘人數</label>
                    </div>
                  </div>

                  
                  <div class="row">
                    <div class="col-md-6">
                      <label for="">旅客</label>
                      <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-1' field='quantity' /> --}}
                      {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
                      {{-- <input type='text' readonly="readonly" name='quantity' value="{{old('quantity') ?? '1'}}" class='qty col-md-2'  style="width: 15%;"/>
                      <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-1' field='quantity' />
                    </div>
                    <div class="col-md-6">
                      <label for="">嬰兒 (未滿2歲)</label>
                      <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-1' field='quantity2' />
                      <input type='text' readonly="readonly" name='quantity2' value="{{ old('quantity2','0') }}" class='qty col-md-2'  style="width: 15%;"/>
                      <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-1' field='quantity2' />
                      <div id='font' style='margin:0px;color:red;'></div>
                    </div>
                   </div>
                </div> --}}

              <div id='aboard-credit-form'>
                <div class="row">
                  <div class="col-md-5">
                  <form action="{{ route('homepage.store')}} " method="POST">
                      {{-- choose.index --}}
                      @csrf
                      <label for="inputAddress" class="form-label">出發機場：</label>
                      <select name="be_apto" class="form-select" aria-label="Default select example" id="sel11">
                          <option selected></option>
                          <option value="1" {{ (old("be_apto") == "1" ? "selected":"") }}>松山(TSA)</option>
                          <option value="2" {{ (old("be_apto") == "2" ? "selected":"") }}>高雄(KHH)</option>
                          <option value="3" {{ (old("be_apto") == "3" ? "selected":"") }}>台中(RMQ)</option>
                          <option value="4" {{ (old("be_apto") == "4" ? "selected":"") }}>花蓮(HUN)</option>
                          <option value="5" {{ (old("be_apto") == "5" ? "selected":"") }}>台東(TTT)</option>
                          <option value="6" {{ (old("be_apto") == "6" ? "selected":"") }}>澎湖(MZG)</option>
                          <option value="7" {{ (old("be_apto") == "7" ? "selected":"") }}>金門(KNH)</option>
                      </select>
                   </div>
                      
                      <br>
                   <div class="col-md-5">
                      <label for="inputAddress" class="form-label">目的機場：</label>
                      <select name="be_apfo" class="form-select" aria-label="Default select example" id="sel21">
                          <option selected></option>
                          {{-- <option value="1" {{ (old("be_apfo") == "1" ? "selected":"") }}>松山(TSA)</option>
                          <option value="2" {{ (old("be_apfo") == "2" ? "selected":"") }}>高雄(KHH)</option>
                          <option value="3" {{ (old("be_apfo") == "3" ? "selected":"") }}>台中(RMQ)</option>
                          <option value="4" {{ (old("be_apfo") == "4" ? "selected":"") }}>花蓮(HUN)</option>
                          <option value="5" {{ (old("be_apfo") == "5" ? "selected":"") }}>台東(TTT)</option>
                          <option value="6" {{ (old("be_apfo") == "6" ? "selected":"") }}>澎湖(MZG)</option>
                          <option value="7" {{ (old("be_apfo") == "7" ? "selected":"") }}>金門(KNH)</option>  --}}
                      </select> 
                   </div>
                </div>
                      <br>
                  <div class="row">
                    <div class="col-md-5">
                      <label for="inputAddress" class="form-label">啟程日期：</label>
                      <input type="date" value="{{ old('dateto') }}" name="dateto" class="form-control" id="dateto2"  max="2030-12-31" min="">
                      </div>
                    <div class="col-md-5">          
                      <label for="inputAddress" class="form-label">回程日期：</label>
                      <input type="date" value="{{ old('datefo') }}" name="datefo" class="form-control" id="apdate" >
                    </div>
                   </div>

                   <div class="row">
                    <div class="col-md-5">
                      <label for="inputState">搭乘人數</label>
                    </div>
                  </div>

                  
                  <div class="row">
                    <div class="col-md-6">
                      <label for="">旅客</label>
                      <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-1' field='quantity' />
                      {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
                      <input type='text' readonly="readonly" name='quantity' value="{{old('quantity') ?? '1'}}" class='qty col-md-2'  style="width: 15%;"/>
                      <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-1' field='quantity' />
                    </div>
                    <div class="col-md-6">
                      <label for="">嬰兒 (未滿2歲)</label>
                      <input style="border-bottom: 0px;width:15%;" type='button' value='-' class='qtyminus col-md-1' field='quantity2' />
                      <input type='text' readonly="readonly" name='quantity2' value="{{ old('quantity2','0') }}" class='qty col-md-2'  style="width: 15%;"/>
                      <input style="border-bottom: 0px;width:15%;" type='button' value='+' class='qtyplus col-md-1' field='quantity2' />
                      <div id='font' style='margin:0px;color:red;'></div>
                    </div>
                   </div>

                </div>
            </div>
                <div class="col justify-content-md-center">
                      <button  type="submit"  class="next action-button">搜尋</button>
                </div>
                  </form>
                </div>
            </fieldset>  
          </form>
      </div>

      <button type="button" onclick="location.href='{{route('homepage.index2')}}'">來回</button><br>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script>
        $('input[type=radio][name="type"]').on('change', function() {
      switch($(this).val()) {
        case 'domestic-credit':
          $("#domestic-credit-form").show()
          $("#aboard-credit-form").hide()
          break
        case 'aboard-credit':
          $("#domestic-credit-form").hide()
          $("#aboard-credit-form").show()
          break
      }      
    })
      </script>
    <script>
        $(function(){
            //得到當前時間
          var date_now = new Date();
          //得到當前年份
          var year = date_now.getFullYear();
          //得到當前月份
          //注：
          //  1：js中獲取Date中的month時，會比當前月份少一個月，所以這裡需要先加一
          //  2: 判斷當前月份是否小於10，如果小於，那麼就在月份的前面加一個 '0' ， 如果大於，就顯示當前月份
          var month = date_now.getMonth()+1 < 10 ? "0"+(date_now.getMonth()+1) : (date_now.getMonth()+1);
          //得到當前日子（多少號）
          var date = date_now.getDate() < 10 ? "0"+date_now.getDate() : date_now.getDate();
          //設置input標籤的max屬性
          var month1 = date_now.getMonth()+2 < 10 ? "0"+(date_now.getMonth()+1) : (date_now.getMonth()+1);
          //設置input標籤的max屬性
          $("#dateto").attr("min",year+"-"+month+"-"+date);})  </script>
<script>
    $(function(){
        //得到當前時間
      var date_now = new Date();
      //得到當前年份
      var year = date_now.getFullYear();
      //得到當前月份
      //注：
      //  1：js中獲取Date中的month時，會比當前月份少一個月，所以這裡需要先加一
      //  2: 判斷當前月份是否小於10，如果小於，那麼就在月份的前面加一個 '0' ， 如果大於，就顯示當前月份
      var month = date_now.getMonth()+1 < 10 ? "0"+(date_now.getMonth()+1) : (date_now.getMonth()+1);
      //得到當前日子（多少號）
      var date = date_now.getDate() < 10 ? "0"+date_now.getDate() : date_now.getDate();
      //設置input標籤的max屬性
      var month1 = date_now.getMonth()+2 < 10 ? "0"+(date_now.getMonth()+1) : (date_now.getMonth()+1);
      //設置input標籤的max屬性
      $("#dateto2").attr("min",year+"-"+month+"-"+date);})  
      
  </script>
    <script>
        $(function() {
        // This button will increment the value
        $('.qtyplus').click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('field');
            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            //如果是嬰兒數點擊增加
            if (fieldName == 'quantity2') { 
                //抓旅客的數量
                var Val1 = parseInt($('input[name=' + 'quantity' + ']').val());
                // If is not undefined 如果嬰兒數小於旅客
                if (!isNaN(currentVal) && currentVal < Val1) { 
                // Increment
                $('input[name=' + fieldName + ']').val(currentVal + 1);
                } 
                //如果嬰兒數大於旅客
                else {   
                // Otherwise put a 0 there
                document.getElementById("font"). textContent = '*嬰兒人數不得超過旅客人數'
                $('input[name=' + fieldName + ']').val(Val1);
                }
            }
            else{
                // If is not undefined
                if (!isNaN(currentVal) && currentVal < 4) {
                // Increment
                $('input[name=' + fieldName + ']').val(currentVal + 1);
                } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(4);
                }
            }
        });
        // This button will decrement the value till 0
        $(".qtyminus").click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('field');
            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            //如果是旅客點擊減少，至少要1人
            if (fieldName == 'quantity') {
                //取嬰兒的數量
                var Val2 = parseInt($('input[name=' + 'quantity2' + ']').val());
                // If it isn't undefined or 大於1
                if (!isNaN(currentVal) && (Val2 == currentVal) && (currentVal > 1) ) { 
                    $('input[name=' + fieldName + ']').val(currentVal - 1);
                    $('input[name="quantity2"]').val(Val2 - 1);
                }
                // 其他 put a 1 there
                else{
                    // If it isn't undefined or its greater than 0
                    if (!isNaN(currentVal) && currentVal > 1) {
                    // Decrement one
                    $('input[name=' + fieldName + ']').val(currentVal - 1);
                    } else {
                    // Otherwise put a 0 there
                    $('input[name=' + fieldName + ']').val(1);
                    }
                }
            }
            else{
                // If it isn't undefined or its greater than 0
                if (!isNaN(currentVal) && currentVal > 0) {
                // Decrement one
                $('input[name=' + fieldName + ']').val(currentVal - 1);
                } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
                }
            }
            
        });
        });
    </script>
    <script>
        //當sel值改變時觸發事件
    $("#sel").change(function(){
      //此處用switch case來作為判斷式
      //並以sel各個Option的Value作為判斷條件
      //注意這邊有用parseInt將value值轉為整數型態否則會出現錯誤
      switch (parseInt($(this).val())){
      //默認行為，可以不寫
      default:
      //當value值為0時刪除sel2的Option Item
      case 0: 
          $("#sel2 option").remove();
          break;
      //當value值為1時刪除sel2的Option Item 
      //並用陣列及each迴圈新增sel2的Option Item選項
      case 1: 
          $("#sel2 option").remove();
          var array = ["台東(TTT)", "澎湖(MZG)", "金門(KNH)"];	// 松山(TSA)
          //利用each遍歷array中的值並將每個值新增到Select中
          $.each(array, function(i, val) {
            $("#sel2").append($("<option value='" + array[i] + "'>" + array[i] + "</option>"));
          });      
          break;
      case 2: 
          $("#sel2 option").remove();
          var array = ["花蓮(HUN)", "澎湖(MZG)"];// 高雄(KHH)
          //利用each遍歷array中的值並將每個值新增到Select中
          $.each(array, function(i, val) {
            $("#sel2").append($("<option value='" + array[i] + "'>" + array[i] + "</option>"));
          });      
          break;
      case 3: 
          $("#sel2 option").remove();
          var array = ["花蓮(HUN)", "澎湖(MZG)", "金門(KNH)"];// 台中(RMQ)
          //利用each遍歷array中的值並將每個值新增到Select中
          $.each(array, function(i, val) {
            $("#sel2").append($("<option value='" + array[i] + "'>" + array[i] + "</option>"));
          });      
          break;
      case 4: 
          $("#sel2 option").remove();
          var array = ["高雄(KHH)", "台中(RMQ)"];	//花蓮(HUN)
          //利用each遍歷array中的值並將每個值新增到Select中
          $.each(array, function(i, val) {
            $("#sel2").append($("<option value='" + array[i] + "'>" + array[i] + "</option>"));
          });      
          break;
      case 5: 
          $("#sel2 option").remove();
          var array = ["松山(TSA)"];	// 台東(TTT)	
          //利用each遍歷array中的值並將每個值新增到Select中
          $.each(array, function(i, val) {
            $("#sel2").append($("<option value='" + array[i] + "'>" + array[i] + "</option>"));
          });      
          break;
      case 6: 
          $("#sel2 option").remove();
          var array =["松山(TSA)", "高雄(KHH)", "台中(RMQ)"];// 澎湖(MZG)
          //利用each遍歷array中的值並將每個值新增到Select中
          $.each(array, function(i, val) {
            $("#sel2").append($("<option value='" + array[i] + "'>" + array[i] + "</option>"));
          });      
          break;    
      case 7: 
          $("#sel2 option").remove();
          var array =["松山(TSA)", "台中(RMQ)"];	//金門(KNH)
          //利用each遍歷array中的值並將每個值新增到Select中
          $.each(array, function(i, val) {
            $("#sel2").append($("<option value='" + array[i] + "'>" + array[i] + "</option>"));
          });      
          break;
     }
    });
      </script>
        <script>
            //當sel值改變時觸發事件
        $("#sel11").change(function(){
          //此處用switch case來作為判斷式
          //並以sel各個Option的Value作為判斷條件
          //注意這邊有用parseInt將value值轉為整數型態否則會出現錯誤
          switch (parseInt($(this).val())){
          //默認行為，可以不寫
          default:
          //當value值為0時刪除sel2的Option Item
          case 0: 
              $("#sel21 option").remove();
              break;
          //當value值為1時刪除sel2的Option Item 
          //並用陣列及each迴圈新增sel2的Option Item選項
          case 1: 
              $("#sel21 option").remove();
              var array = ["台東(TTT)", "澎湖(MZG)", "金門(KNH)"];	// 松山(TSA)
              //利用each遍歷array中的值並將每個值新增到Select中
              $.each(array, function(i, val) {
                $("#sel21").append($("<option value='" + array[i] + "'>" + array[i] + "</option>"));
              });      
              break;
          case 2: 
              $("#sel21 option").remove();
              var array = ["花蓮(HUN)", "澎湖(MZG)"];// 高雄(KHH)
              //利用each遍歷array中的值並將每個值新增到Select中
              $.each(array, function(i, val) {
                $("#sel21").append($("<option value='" + array[i] + "'>" + array[i] + "</option>"));
              });      
              break;
          case 3: 
              $("#sel21 option").remove();
              var array = ["花蓮(HUN)", "澎湖(MZG)", "金門(KNH)"];// 台中(RMQ)
              //利用each遍歷array中的值並將每個值新增到Select中
              $.each(array, function(i, val) {
                $("#sel21").append($("<option value='" + array[i] + "'>" + array[i] + "</option>"));
              });      
              break;
          case 4: 
              $("#sel21 option").remove();
              var array = ["高雄(KHH)", "台中(RMQ)"];	//花蓮(HUN)
              //利用each遍歷array中的值並將每個值新增到Select中
              $.each(array, function(i, val) {
                $("#sel21").append($("<option value='" + array[i] + "'>" + array[i] + "</option>"));
              });      
              break;
          case 5: 
              $("#sel21 option").remove();
              var array = ["松山(TSA)"];	// 台東(TTT)	
              //利用each遍歷array中的值並將每個值新增到Select中
              $.each(array, function(i, val) {
                $("#sel21").append($("<option value='" + array[i] + "'>" + array[i] + "</option>"));
              });      
              break;
          case 6: 
              $("#sel21 option").remove();
              var array =["松山(TSA)", "高雄(KHH)", "台中(RMQ)"];// 澎湖(MZG)
              //利用each遍歷array中的值並將每個值新增到Select中
              $.each(array, function(i, val) {
                $("#sel21").append($("<option value='" + array[i] + "'>" + array[i] + "</option>"));
              });      
              break;    
          case 7: 
              $("#sel21 option").remove();
              var array =["松山(TSA)", "台中(RMQ)"];	//金門(KNH)
              //利用each遍歷array中的值並將每個值新增到Select中
              $.each(array, function(i, val) {
                $("#sel21").append($("<option value='" + array[i] + "'>" + array[i] + "</option>"));
              });      
              break;
         }
        });
          </script>
<script src="{{ asset('js/app.js') }}"></script>
@endsection