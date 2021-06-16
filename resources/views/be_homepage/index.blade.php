@extends(((isset($mId)) ? 'layouts.be_member' : 'layouts.be_buy' ))

@section('css')
    <link rel="stylesheet" href="{{ asset('css/be_all.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|首頁</title>
@endsection

@section('main')
<div class="container-fluid" id="grad1">
  <div class="row justify-content-center mt-0">
    @if ($errors->any())
        <div class="errors m-2 p-1 bg-red-500 text-red-100 font-thin rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif  
  <div class=" col-md-12 col-lg-10 col-xl-8 text-center p-0 mt-5 mb-3">  
      <form action="{{ route('homepage.store')}} " method="POST" id="msform">  
        @csrf

        <!-- progressbar -->  
        <fieldset class="card"> 
            <div class="form-card" id="home">  
              <div  class="container" style="padding-left:0px">
                <div class="d-grid gap-2 d-md-block">
                <h4 class="fs-title">訂票購買
                  
                   <input type="radio" class="btn-check" name="type" id="btnradio1" value='domestic-credit' autocomplete="off" checked style="width:20px">
                  <label class="btn btn-outline-info btn-sm " for="btnradio1">單程</label>
                  <input type="radio" class="btn-check" name="type" id="btnradio2" value='aboard-credit' autocomplete="off" style="width:20px">
                  <label class="btn btn-outline-info btn-sm " for="btnradio2">來回</label>
                 
                </h4>
                </div>
              </div>
              <br>

              {{-- <div id='aboard-credit-form' style="display: none"> --}}
                <div class="row">
                  <div class="col-md-5">
                  {{-- <form action="{{ route('homepage.store')}} " method="POST"> --}}
                      {{-- choose.index --}}
                       @csrf 
                      <label for="inputAddress" class="form-label">出發機場：</label>
                      <select name="be_apto" class="form-select" aria-label="Default select example" id="bigSelect" onchange="showNext()">
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
                      <select name="be_apfo" class="form-select" aria-label="Default select example" id="sonSelect">
                          <option selected></option>
                          {{-- <option value="1" {{ (old("be_apfo") == "1" ? "selected":"") }}>松山(TSA)</option>
                          <option value="2" {{ (old("be_apfo") == "2" ? "selected":"") }}>高雄(KHH)</option>
                          <option value="3" {{ (old("be_apfo") == "3" ? "selected":"") }}>台中(RMQ)</option>
                          <option value="4" {{ (old("be_apfo") == "4" ? "selected":"") }}>花蓮(HUN)</option>
                          <option value="5" {{ (old("be_apfo") == "5" ? "selected":"") }}>台東(TTT)</option>
                          <option value="6" {{ (old("be_apfo") == "6" ? "selected":"") }}>澎湖(MZG)</option>
                          <option value="7" {{ (old("be_apfo") == "7" ? "selected":"") }}>金門(KNH)</option>   --}}
                      </select> 
                   </div>
                </div>
                      <br>
                  <div class="row">
                    <div class="col-md-5">
                      <label for="inputAddress" class="form-label">啟程日期：</label>
                      <input type="date" value="{{ old('dateto') }}" name="dateto" class="form-control" id="dateto2"  max="2030-12-31" min="">
                      </div>
                    <div class="col-md-5" id='aboard-credit-form' style="display: none">          
                      <label for="inputAddress" class="form-label" >回程日期：</label>
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
                  

                {{-- </div> --}}
            </div>
                <div class="col justify-content-md-center">
                      <button  type="submit"  class="next action-button">搜尋</button>
                </div>
                  {{-- </form> --}}
                </fieldset>  
              </form>
    
                </div>
           
      
      {{-- <button type="button" onclick="location.href='{{route('homepage.index2')}}'">來回</button><br> --}}


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script>
        $('input[type=radio][name="type"]').on('change', function() {
      switch($(this).val()) {
        case 'domestic-credit':
          $("#aboard-credit-form").hide()
          document.getElementById("apdate").value = '';
          //$("#msform")[0].reset(); //清空
          break
        case 'aboard-credit':
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
            var selectTool = new Array();
          window.onload=function(){//省略簡寫
            selectTool[0] = new Array();//陣列內分別為所屬省份的id，市名稱，市的id
            selectTool[1] = new Array('1','台東(TTT)','5');
            selectTool[2] = new Array('1','澎湖(MZG)','6');
            selectTool[3] = new Array('1','金門(KNH)','7');
            selectTool[4] = new Array('2','花蓮(HUN)','4');
            selectTool[5] = new Array('2','澎湖(MZG)','6');
            selectTool[6] = new Array('3','花蓮(HUN)','4');
            selectTool[7] = new Array('3','澎湖(MZG)','6');
            selectTool[8] = new Array('3','金門(KNH)','7');
            selectTool[9] = new Array('4','高雄(KHH)','2');
            selectTool[10] = new Array('4','台中(RMQ)','3');
            selectTool[11] = new Array('5','松山(TSA)','1');
            selectTool[12] = new Array('6','松山(TSA)','1');
            selectTool[13] = new Array('6','高雄(KHH)','2');
            selectTool[14] = new Array('6','台中(RMQ)','3');
            selectTool[15] = new Array('7','松山(TSA)','1');
            selectTool[16] = new Array('7','台中(RMQ)','3');
          }
          
          function showNext(){
          var big = document.getElementById("bigSelect").value;
          document.getElementById("sonSelect").length = 0;
          //document.getElementById("sonSelect").options.add(new Option("--請選擇--",""));
          for (i=0;i<selectTool.length;i++){
          if (selectTool[i][0] == big){
          document.getElementById("sonSelect").options.add(new Option(selectTool[i][1],selectTool[i][2]));
          }}}
          
          // function showNext2(){
          // var big = document.getElementById("bigSelect2").value;
          // document.getElementById("sonSelect2").length = 0;
          // document.getElementById("sonSelect").options.add(new Option("--請選擇--",""));
          // for (i=0;i<selectTool.length;i++){
          // if (selectTool[i][0] == big){
          // document.getElementById("sonSelect2").options.add(new Option(selectTool[i][1],selectTool[i][2]));
          // }}}
          </script>
<script src="{{ asset('js/app.js') }}"></script>
@endsection