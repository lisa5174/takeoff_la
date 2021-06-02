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
    @if ($errors->any())
        <div class="errors m-2 p-1 bg-red-500 text-red-100 font-thin rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif  

    回程:
    @foreach ($toplace as $tp)
        {{$tp->loName}}
    @endforeach
    ->
    @foreach ($foplace as $fp)
        {{$fp->loName}}
    @endforeach
    
    <br>

    日期:{{$datefo}}
    <br>

    @foreach ($foflights as $foflight)
        飛機名稱:{{$foflight->fName}}
        起飛時間:{{$foflight->Ltime}}
        全額票價:{{$foflight->fprice}}
        <br>
        <form action="{{ route('choose.index2')}}" method="GET">
            @csrf 
            <input type="hidden" name="apId" value="{{$foflight->fId}}">
            <input type="hidden" name="quantity" value="{{$quantity}}">
            <input type="hidden" name="quantity2" value="{{$quantity2}}">
            <input type="hidden" name="apfo" value="{{$apto}}">
            <input type="hidden" name="apfo" value="{{$apfo}}">
            <input type="hidden" name="datefo" value="{{$datefo}}">

            <label for="">全額</label>${{$foflight->fprice}}
            <input type='button' value='-' class='qtyminus' field='ticket1' />
            {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
            <input type='text' readonly="readonly" name='ticket1' value="{{old('ticket1') ?? '0'}}" class='qty' />
            <input type='button' value='+' class='qtyplus' field='ticket1' />

            <label for="">孩童</label>
            @foreach ($ticket1 as $t1)
                ${{round(($t1->tPrice) * ($foflight->fprice))}}
            @endforeach
            <input type='button' value='-' class='qtyminus' field='ticket2' />
            <input type='text' readonly="readonly" name='ticket2' value="{{old('ticket2') ?? '0'}}" class='qty' />
            <input type='button' value='+' class='qtyplus' field='ticket2' />

            <label for="">敬老</label>
            @foreach ($ticket2 as $t1)
                ${{round(($t1->tPrice) * ($foflight->fprice))}}
            @endforeach
            <input type='button' value='-' class='qtyminus' field='ticket3' />
            <input type='text' readonly="readonly" name='ticket3' value="{{old('ticket3') ?? '0'}}" class='qty' />
            <input type='button' value='+' class='qtyplus' field='ticket3' />
            
            <br>
            
            <label for="">軍人</label>
            @foreach ($ticket3 as $t1)
                ${{round(($t1->tPrice) * ($foflight->fprice))}}
            @endforeach
            <input type='button' value='-' class='qtyminus' field='ticket4' />
            <input type='text' readonly="readonly" name='ticket4' value="{{old('ticket4') ?? '0'}}" class='qty' />
            <input type='button' value='+' class='qtyplus' field='ticket4' />

            <label for="">愛心</label>
            @foreach ($ticket4 as $t1)
                ${{round(($t1->tPrice) * ($foflight->fprice))}}
            @endforeach
            <input type='button' value='-' class='qtyminus' field='ticket5' />
            <input type='text' readonly="readonly" name='ticket5' value="{{old('ticket5') ?? '0'}}" class='qty' />
            <input type='button' value='+' class='qtyplus' field='ticket5' />

            <label for="">愛心陪同</label>
            @foreach ($ticket5 as $t1)
                ${{round(($t1->tPrice) * ($foflight->fprice))}}
            @endforeach
            <input type='button' value='-' class='qtyminus' field='ticket6' />
            <input type='text' readonly="readonly" name='ticket6' value="{{old('ticket6') ?? '0'}}" class='qty' />
            <input type='button' value='+' class='qtyplus' field='ticket6' />
            
            <br>
            
            @if ($ticket11 -> isNotEmpty())
                <label for="">促銷(早鳥)優惠</label>
                @foreach ($ticket6 as $t1)
                    ${{round(($t1->tPrice) * ($foflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket7' />
                <input type='text' readonly="readonly" name='ticket7' value="{{old('ticket7') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket7' />
            @endif

            <hr>

            <label for="">離島居民</label>
            @foreach ($ticket7 as $t1)
                ${{round(($t1->tPrice) * ($foflight->fprice))}}
            @endforeach
            <input type='button' value='-' class='qtyminus' field='ticket8' />
            <input type='text' readonly="readonly" name='ticket8' value="{{old('ticket8') ?? '0'}}" class='qty' />
            <input type='button' value='+' class='qtyplus' field='ticket8' />
            
            <label for="">離島居民敬老</label>
            @foreach ($ticket8 as $t1)
                ${{round(($t1->tPrice) * ($foflight->fprice))}}
            @endforeach
            <input type='button' value='-' class='qtyminus' field='ticket9' />
            <input type='text' readonly="readonly" name='ticket9' value="{{old('ticket9') ?? '0'}}" class='qty' />
            <input type='button' value='+' class='qtyplus' field='ticket9' />
            
            <label for="">離島居民愛心</label>
            @foreach ($ticket9 as $t1)
                ${{round(($t1->tPrice) * ($foflight->fprice))}}
            @endforeach
            <input type='button' value='-' class='qtyminus' field='ticket10' />
            <input type='text' readonly="readonly" name='ticket10' value="{{old('ticket10') ?? '0'}}" class='qty' />
            <input type='button' value='+' class='qtyplus' field='ticket10' />
            
            <br>
            
            <label for="">離島居民愛陪</label>
            @foreach ($ticket10 as $t1)
                ${{round(($t1->tPrice) * ($foflight->fprice))}}
            @endforeach
            <input type='button' value='-' class='qtyminus' field='ticket11' />
            <input type='text' readonly="readonly" name='ticket11' value="{{old('ticket11') ?? '0'}}" class='qty' />
            <input type='button' value='+' class='qtyplus' field='ticket11' />
            
            @if ($ticket11 -> isNotEmpty())
                <label for="">離島居民促銷優惠</label>
                @foreach ($ticket11 as $t1)
                    ${{round(($t1->tPrice) * ($foflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket12' />
                <input type='text' readonly="readonly" name='ticket12' value="{{old('ticket12') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket12' />
            @endif
            
            <br>

            <button type="submit">確定</button>
        </form>
    @endforeach

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