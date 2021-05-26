<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> --}}

    <title>homepage</title>
</head>
<body>
    @if ($errors->any())
        <div class="errors m-2 p-1 bg-red-500 text-red-100 font-thin rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif  

    <form action="{{ route('choose.edit')}} " method="POST">
        @csrf
        <label for="inputAddress" class="form-label">出發機場：</label>
        <select name="be_apto" class="form-select" aria-label="Default select example">
            <option selected></option>
            {{-- value不用好像也可以，但避免問題就先留著 --}}
            <option value="1" {{ (old("be_apto") == "1" ? "selected":"") }}>松山(TSA)</option>
            <option value="2" {{ (old("be_apto") == "2" ? "selected":"") }}>高雄(KHH)</option>
            <option value="3" {{ (old("be_apto") == "3" ? "selected":"") }}>台中(RMQ)</option>
            <option value="4" {{ (old("be_apto") == "4" ? "selected":"") }}>花蓮(HUN)</option>
            <option value="5" {{ (old("be_apto") == "5" ? "selected":"") }}>台東(TTT)</option>
            <option value="6" {{ (old("be_apto") == "6" ? "selected":"") }}>澎湖(MZG)</option>
            <option value="7" {{ (old("be_apto") == "7" ? "selected":"") }}>金門(KNH)</option>
        </select>
        
        <br>
        
        <label for="inputAddress" class="form-label">目的機場：</label>
        <select name="be_apfo" class="form-select" aria-label="Default select example">
            <option selected></option>
            <option value="1" {{ (old("be_apfo") == "1" ? "selected":"") }}>松山(TSA)</option>
            <option value="2" {{ (old("be_apfo") == "2" ? "selected":"") }}>高雄(KHH)</option>
            <option value="3" {{ (old("be_apfo") == "3" ? "selected":"") }}>台中(RMQ)</option>
            <option value="4" {{ (old("be_apfo") == "4" ? "selected":"") }}>花蓮(HUN)</option>
            <option value="5" {{ (old("be_apfo") == "5" ? "selected":"") }}>台東(TTT)</option>
            <option value="6" {{ (old("be_apfo") == "6" ? "selected":"") }}>澎湖(MZG)</option>
            <option value="7" {{ (old("be_apfo") == "7" ? "selected":"") }}>金門(KNH)</option>
        </select>

        <br>
        
        <label for="inputAddress" class="form-label">啟程日期：</label>
        <input type="date" value="{{ old('dateto') }}" name="dateto" class="form-control" id="apdate" >

        <br>

        <label for="inputAddress" class="form-label">回程日期：</label>
        <input type="date" value="{{ old('datefo') }}" name="datefo" class="form-control" id="apdate" >

        <br>

        <label for="">旅客</label>
        <input type='button' value='-' class='qtyminus' field='quantity' />
        {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
        <input type='text' readonly="readonly" name='quantity' value="{{old('quantity') ?? '2'}}" class='qty' />
        <input type='button' value='+' class='qtyplus' field='quantity' />
    
        <br>

        <label for="">嬰兒 (未滿2歲)</label>
        <input type='button' value='-' class='qtyminus' field='quantity2' />
        <input type='text' readonly="readonly" name='quantity2' value="{{ old('quantity2','0') }}" class='qty' />
        <input type='button' value='+' class='qtyplus' field='quantity2' />
        <div id='font' style='margin:0px;color:red;'></div>
        
        <button type="submit">搜尋</button>
    </form>

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
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
        
        


