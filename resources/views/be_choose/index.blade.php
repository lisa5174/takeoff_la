{{-- choose --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Document</title>
</head>
<body>
    去程:
    @foreach ($toplace as $tp)
        {{$tp->loName}}
    @endforeach
    ->
    @foreach ($foplace as $fp)
        {{$fp->loName}}
    @endforeach
    
    <br>

    日期:{{$dateto}}
    <br>

    @foreach ($toflights as $toflight)
        飛機名稱:{{$toflight->fName}}
        起飛時間:{{$toflight->Ltime}}
        全額票價:{{$toflight->fprice}}
        <br>
        <label for="">全額</label>
        <input type='button' value='-' class='qtyminus' field='quantity' />
        {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
        <input type='text' readonly="readonly" name='quantity' value="{{old('quantity') ?? '0'}}" class='qty' />
        <input type='button' value='+' class='qtyplus' field='quantity' />
        <label for="">孩童</label>
        <input type='button' value='-' class='qtyminus' field='quantity2' />
        {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
        <input type='text' readonly="readonly" name='quantity2' value="{{old('quantity2') ?? '0'}}" class='qty' />
        <input type='button' value='+' class='qtyplus' field='quantity2' />
        <label for="">敬老</label>
        <input type='button' value='-' class='qtyminus' field='quantity3' />
        {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
        <input type='text' readonly="readonly" name='quantity3' value="{{old('quantity3') ?? '0'}}" class='qty' />
        <input type='button' value='+' class='qtyplus' field='quantity3' />
        <br>
        <label for="">軍人</label>
        <input type='button' value='-' class='qtyminus' field='quantity4' />
        {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
        <input type='text' readonly="readonly" name='quantity4' value="{{old('quantity4') ?? '0'}}" class='qty' />
        <input type='button' value='+' class='qtyplus' field='quantity4' />
        <label for="">愛心</label>
        <input type='button' value='-' class='qtyminus' field='quantity5' />
        {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
        <input type='text' readonly="readonly" name='quantity5' value="{{old('quantity5') ?? '0'}}" class='qty' />
        <input type='button' value='+' class='qtyplus' field='quantity5' />
        <label for="">愛心陪同</label>
        <input type='button' value='-' class='qtyminus' field='quantity3' />
        {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
        <input type='text' readonly="readonly" name='quantity3' value="{{old('quantity3') ?? '0'}}" class='qty' />
        <input type='button' value='+' class='qtyplus' field='quantity3' />
        <br>
        <label for="">促銷(早鳥)優惠</label>
        <input type='button' value='-' class='qtyminus' field='quantity3' />
        {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
        <input type='text' readonly="readonly" name='quantity3' value="{{old('quantity3') ?? '0'}}" class='qty' />
        <input type='button' value='+' class='qtyplus' field='quantity3' />

        <hr>

        <label for="">離島居民</label>
        <input type='button' value='-' class='qtyminus' field='quantity3' />
        {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
        <input type='text' readonly="readonly" name='quantity3' value="{{old('quantity3') ?? '0'}}" class='qty' />
        <input type='button' value='+' class='qtyplus' field='quantity3' />
        <label for="">離島居民敬老</label>
        <input type='button' value='-' class='qtyminus' field='quantity3' />
        {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
        <input type='text' readonly="readonly" name='quantity3' value="{{old('quantity3') ?? '0'}}" class='qty' />
        <input type='button' value='+' class='qtyplus' field='quantity3' />
        <label for="">離島居民愛心</label>
        <input type='button' value='-' class='qtyminus' field='quantity3' />
        {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
        <input type='text' readonly="readonly" name='quantity3' value="{{old('quantity3') ?? '0'}}" class='qty' />
        <input type='button' value='+' class='qtyplus' field='quantity3' />
        <br>
        <label for="">離島居民愛陪</label>
        <input type='button' value='-' class='qtyminus' field='quantity3' />
        {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
        <input type='text' readonly="readonly" name='quantity3' value="{{old('quantity3') ?? '0'}}" class='qty' />
        <input type='button' value='+' class='qtyplus' field='quantity3' />
        <label for="">離島居民促銷優惠</label>
        <input type='button' value='-' class='qtyminus' field='quantity3' />
        {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
        <input type='text' readonly="readonly" name='quantity3' value="{{old('quantity3') ?? '0'}}" class='qty' />
        <input type='button' value='+' class='qtyplus' field='quantity3' />

    @endforeach

    <br><br>

    回程:
    @foreach ($foplace as $fp)
        {{$fp->loName}}
    @endforeach
    ->
    @foreach ($toplace as $tp)
        {{$tp->loName}}
    @endforeach

    <br>

    日期:{{$datefo}}
    <br>

    @foreach ($foflights as $foflight)
        飛機名稱:{{$foflight->fName}}
        起飛時間:{{$foflight->Ltime}}
        全額票價:{{$foflight->fprice}}
    @endforeach
    
    旅客人數不符， 總人數應為3人。您現選擇5人
    
    
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
                // If is not undefined
                if (!isNaN(currentVal) && currentVal < 4) {
                // Increment
                $('input[name=' + fieldName + ']').val(currentVal + 1);
                } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(4);
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
                // If it isn't undefined or its greater than 0
                if (!isNaN(currentVal) && currentVal > 0) {
                // Decrement one
                $('input[name=' + fieldName + ']').val(currentVal - 1);
                } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
                }
            });
        });
    </script>

</body>
</html>