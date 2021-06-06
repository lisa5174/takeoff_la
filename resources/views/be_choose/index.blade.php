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

    @if(empty($toflights))
        <h4>查無航班!</h4>
    @endif
    @foreach ($toflights as $toflight)
        @if ($toflight->date == date('Y-m-d', strtotime('+8HOUR') ))
            @if ($toflight->Ltime > date('H:i', strtotime('+8HOUR') ))
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
            
                飛機名稱:{{$toflight->fName}}
                起飛時間:{{$toflight->Ltime}}
                全額票價:{{$toflight->fprice}}
                旅客人數:{{$quantity}}
                @if ($quantity2 != 0)
                    嬰兒人數:{{$quantity2}}
                @endif
                <br>
                <form action="{{ route('choose.index2')}}" method="GET">
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

                    <label for="">全額</label>${{$toflight->fprice}}
                    <input type='button' value='-' class='qtyminus' field='ticket2' />
                    {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
                    <input type='text' readonly="readonly" name='ticket2' value="{{old('ticket2') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket2' />

                    <label for="">孩童</label>
                    @foreach ($ticket1 as $t1)
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
                    @endforeach
                    <input type='button' value='-' class='qtyminus' field='ticket16' />
                    <input type='text' readonly="readonly" name='ticket16' value="{{old('ticket16') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket16' />

                    <label for="">敬老</label>
                    @foreach ($ticket2 as $t1)
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
                    @endforeach
                    <input type='button' value='-' class='qtyminus' field='ticket7' />
                    <input type='text' readonly="readonly" name='ticket7' value="{{old('ticket7') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket7' />
                    
                    <br>
                    
                    <label for="">軍人</label>
                    @foreach ($ticket3 as $t1)
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
                    @endforeach
                    <input type='button' value='-' class='qtyminus' field='ticket8' />
                    <input type='text' readonly="readonly" name='ticket8' value="{{old('ticket8') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket8' />

                    <label for="">愛心</label>
                    @foreach ($ticket4 as $t1)
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
                    @endforeach
                    <input type='button' value='-' class='qtyminus' field='ticket9' />
                    <input type='text' readonly="readonly" name='ticket9' value="{{old('ticket9') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket9' />

                    <label for="">愛心陪同</label>
                    @foreach ($ticket5 as $t1)
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
                    @endforeach
                    <input type='button' value='-' class='qtyminus' field='ticket10' />
                    <input type='text' readonly="readonly" name='ticket10' value="{{old('ticket10') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket10' />
                    
                    <br>
                    
                    @if ($ticket11 -> isNotEmpty())
                        @foreach ($ticket6 as $t1)
                        <label for="">{{$t1->tName}}</label>
                            ${{round(($t1->tPrice) * ($toflight->fprice))}}
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
                        <input type='button' value='-' class='qtyminus' field={{$x}} />
                        <input type='text' readonly="readonly" name={{$x}} value="{{old('ticket7') ?? '0'}}" class='qty' />
                        <input type='button' value='+' class='qtyplus' field={{$x}} />
                        @endforeach
                    @endif

                    <hr>

                    <label for="">離島居民</label>
                    @foreach ($ticket7 as $t1)
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
                    @endforeach
                    <input type='button' value='-' class='qtyminus' field='ticket11' />
                    <input type='text' readonly="readonly" name='ticket11' value="{{old('ticket11') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket11' />
                    
                    <label for="">離島居民敬老</label>
                    @foreach ($ticket8 as $t1)
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
                    @endforeach
                    <input type='button' value='-' class='qtyminus' field='ticket13' />
                    <input type='text' readonly="readonly" name='ticket13' value="{{old('ticket13') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket13' />
                    
                    <label for="">離島居民愛心</label>
                    @foreach ($ticket9 as $t1)
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
                    @endforeach
                    <input type='button' value='-' class='qtyminus' field='ticket14' />
                    <input type='text' readonly="readonly" name='ticket14' value="{{old('ticket14') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket14' />
                    
                    <br>
                    
                    <label for="">離島居民愛陪</label>
                    @foreach ($ticket10 as $t1)
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
                    @endforeach
                    <input type='button' value='-' class='qtyminus' field='ticket15' />
                    <input type='text' readonly="readonly" name='ticket15' value="{{old('ticket15') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket15' />
                    
                    @if ($ticket11 -> isNotEmpty())
                        <label for="">離島居民促銷優惠</label>
                        @foreach ($ticket11 as $t1)
                            ${{round(($t1->tPrice) * ($toflight->fprice))}}
                        @endforeach
                        <input type='button' value='-' class='qtyminus' field='ticket12' />
                        <input type='text' readonly="readonly" name='ticket12' value="{{old('ticket12') ?? '0'}}" class='qty' />
                        <input type='button' value='+' class='qtyplus' field='ticket12' />
                    @endif
                    
                    <br>

                    <button type="submit">確定</button>
                </form>
            @else
                <h4>查無航班!</h4>
            @endif
        @else
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
        
            飛機名稱:{{$toflight->fName}}
            起飛時間:{{$toflight->Ltime}}
            全額票價:{{$toflight->fprice}}
            旅客人數:{{$quantity}}
            @if ($quantity2 != 0)
                嬰兒人數:{{$quantity2}}
            @endif
            <br>
            <form action="{{ route('choose.index2')}}" method="GET">
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

                <label for="">全額</label>${{$toflight->fprice}}
                <input type='button' value='-' class='qtyminus' field='ticket2' />
                {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
                <input type='text' readonly="readonly" name='ticket2' value="{{old('ticket2') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket2' />

                <label for="">孩童</label>
                @foreach ($ticket1 as $t1)
                    ${{round(($t1->tPrice) * ($toflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket16' />
                <input type='text' readonly="readonly" name='ticket16' value="{{old('ticket16') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket16' />

                <label for="">敬老</label>
                @foreach ($ticket2 as $t1)
                    ${{round(($t1->tPrice) * ($toflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket7' />
                <input type='text' readonly="readonly" name='ticket7' value="{{old('ticket7') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket7' />
                
                <br>
                
                <label for="">軍人</label>
                @foreach ($ticket3 as $t1)
                    ${{round(($t1->tPrice) * ($toflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket8' />
                <input type='text' readonly="readonly" name='ticket8' value="{{old('ticket8') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket8' />

                <label for="">愛心</label>
                @foreach ($ticket4 as $t1)
                    ${{round(($t1->tPrice) * ($toflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket9' />
                <input type='text' readonly="readonly" name='ticket9' value="{{old('ticket9') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket9' />

                <label for="">愛心陪同</label>
                @foreach ($ticket5 as $t1)
                    ${{round(($t1->tPrice) * ($toflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket10' />
                <input type='text' readonly="readonly" name='ticket10' value="{{old('ticket10') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket10' />
                
                <br>
                
                @if ($ticket11 -> isNotEmpty())
                    @foreach ($ticket6 as $t1)
                    <label for="">{{$t1->tName}}</label>
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
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
                    <input type='button' value='-' class='qtyminus' field={{$x}} />
                    <input type='text' readonly="readonly" name={{$x}} value="{{old('ticket7') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field={{$x}} />
                    @endforeach
                @endif

                <hr>

                <label for="">離島居民</label>
                @foreach ($ticket7 as $t1)
                    ${{round(($t1->tPrice) * ($toflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket11' />
                <input type='text' readonly="readonly" name='ticket11' value="{{old('ticket11') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket11' />
                
                <label for="">離島居民敬老</label>
                @foreach ($ticket8 as $t1)
                    ${{round(($t1->tPrice) * ($toflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket13' />
                <input type='text' readonly="readonly" name='ticket13' value="{{old('ticket13') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket13' />
                
                <label for="">離島居民愛心</label>
                @foreach ($ticket9 as $t1)
                    ${{round(($t1->tPrice) * ($toflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket14' />
                <input type='text' readonly="readonly" name='ticket14' value="{{old('ticket14') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket14' />
                
                <br>
                
                <label for="">離島居民愛陪</label>
                @foreach ($ticket10 as $t1)
                    ${{round(($t1->tPrice) * ($toflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket15' />
                <input type='text' readonly="readonly" name='ticket15' value="{{old('ticket15') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket15' />
                
                @if ($ticket11 -> isNotEmpty())
                    <label for="">離島居民促銷優惠</label>
                    @foreach ($ticket11 as $t1)
                        ${{round(($t1->tPrice) * ($toflight->fprice))}}
                    @endforeach
                    <input type='button' value='-' class='qtyminus' field='ticket12' />
                    <input type='text' readonly="readonly" name='ticket12' value="{{old('ticket12') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket12' />
                @endif
                
                <br>

                <button type="submit">確定</button>
            </form>
        @endif
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