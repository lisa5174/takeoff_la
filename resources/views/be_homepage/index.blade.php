
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>homepage</title>
</head>
<body>

    <form action="{{ route('be_homepage.store')}} " method="POST">
        @csrf
        <label for="inputAddress" class="form-label">出發機場：</label>
        <select name="apto" class="form-select" aria-label="Default select example">
            <option selected></option>
            <option>松山(TSA)</option>
            <option>高雄(KHH)</option>
            <option>台中(RMQ)</option>
            <option>花蓮(HUN)</option>
            <option>台東(TTT)</option>
            <option> 澎湖(MZG)</option>
            <option> 金門(KNH)</option>
        </select>
        
        <br>
        
        <label for="inputAddress" class="form-label">目的機場：</label>
        <select name="apfo" class="form-select" aria-label="Default select example">
            <option selected></option>
            <option>松山(TSA)</option>
            <option>高雄(KHH)</option>
            <option>台中(RMQ)</option>
            <option>花蓮(HUN)</option>
            <option>台東(TTT)</option>
            <option> 澎湖(MZG)</option>
            <option> 金門(KNH)</option>
        </select>

        <br>
        
        <label for="inputAddress" class="form-label">啟程日期：</label>
        <input type="date" value="{{ old('apdate') }}" name="dateto" class="form-control" id="apdate" >

        <br>

        <label for="inputAddress" class="form-label">回程日期：</label>
        <input type="date" value="{{ old('apdate') }}" name="datefo" class="form-control" id="apdate" >

        <br>

        <label for="">旅客</label>
        <input type='button' value='-' class='qtyminus' field='quantity' />
        {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
        <input type='text' readonly="readonly" name='quantity' value='1' class='qty' />
        <input type='button' value='+' class='qtyplus' field='quantity' />
    
        <br>

        <label for="">嬰兒 (未滿2歲)</label>
        <input type='button' value='-' class='qtyminus' field='quantity2' />
        <input type='text' readonly="readonly" name='quantity2' value='0' class='qty' />
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

</body>
</html>
        
        


