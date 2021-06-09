{{-- choose --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous"
    />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"></link>
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

    @if(empty($foflights))
        <h4>查無航班!</h4>
    @endif    
    @foreach ($foflights as $foflight)
        @if ($foflight->date == date('Y-m-d', strtotime('+8HOUR') ))
            @if ($foflight->Ltime > date('H:i', strtotime('+8HOUR') ))
                回程:
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
            
                飛機名稱:{{$foflight->fName}}
                起飛時間:{{$foflight->Ltime}}
                全額票價:{{$foflight->fprice}}
                旅客人數:{{$quantity}}
                @if ($quantity2 != 0)
                    嬰兒人數:{{$quantity2}}
                @endif
                <br>
                <form action="{{ route('order.index2')}}" method="GET">
                    @csrf 
                    {{-- 去程航班id --}}
                    <input type="hidden" name="toId" value="{{$toId}}">
                    <input type="hidden" name="toticket1[]" value="{{$toticket1[0]}}">
                    <input type="hidden" name="toticket1[]" value="{{$toticket1[1]}}">
                    <input type="hidden" name="toticket2[]" value="{{$toticket2[0]}}">
                    <input type="hidden" name="toticket2[]" value="{{$toticket2[1]}}">
                    <input type="hidden" name="toticket3[]" value="{{$toticket3[0]}}">
                    <input type="hidden" name="toticket3[]" value="{{$toticket3[1]}}">
                    <input type="hidden" name="toticket4[]" value="{{$toticket4[0]}}">
                    <input type="hidden" name="toticket4[]" value="{{$toticket4[1]}}">
                    {{-- 回程航班id --}}
                    <input type="hidden" name="foId" value="{{$foflight->fId}}">
                    <input type="hidden" name="quantity" value="{{$quantity}}">
                    <input type="hidden" name="quantity2" value="{{$quantity2}}">

                    <label for="">全額</label>${{$foflight->fprice}}
                    <input type='button' value='-' class='qtyminus' field='ticket2' />
                    {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
                    <input type='text' readonly="readonly" name='ticket2' value="{{old('ticket2') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket2' />

                    <label for="">孩童</label>
                    @foreach ($ticket1 as $t1)
                        ${{round(($t1->tPrice) * ($foflight->fprice))}}
                    @endforeach
                    <input type='button' value='-' class='qtyminus' field='ticket16' />
                    <input type='text' readonly="readonly" name='ticket16' value="{{old('ticket16') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket16' />

                    <label for="">敬老</label>
                    @foreach ($ticket2 as $t1)
                        ${{round(($t1->tPrice) * ($foflight->fprice))}}
                    @endforeach
                    <input type='button' value='-' class='qtyminus' field='ticket7' />
                    <input type='text' readonly="readonly" name='ticket7' value="{{old('ticket7') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket7' />
                    
                    <br>
                    
                    <label for="">軍人</label>
                    @foreach ($ticket3 as $t1)
                        ${{round(($t1->tPrice) * ($foflight->fprice))}}
                    @endforeach
                    <input type='button' value='-' class='qtyminus' field='ticket8' />
                    <input type='text' readonly="readonly" name='ticket8' value="{{old('ticket8') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket8' />

                    <label for="">愛心</label>
                    @foreach ($ticket4 as $t1)
                        ${{round(($t1->tPrice) * ($foflight->fprice))}}
                    @endforeach
                    <input type='button' value='-' class='qtyminus' field='ticket9' />
                    <input type='text' readonly="readonly" name='ticket9' value="{{old('ticket9') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket9' />

                    <label for="">愛心陪同</label>
                    @foreach ($ticket5 as $t1)
                        ${{round(($t1->tPrice) * ($foflight->fprice))}}
                    @endforeach
                    <input type='button' value='-' class='qtyminus' field='ticket10' />
                    <input type='text' readonly="readonly" name='ticket10' value="{{old('ticket10') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket10' />
                    
                    <br>
                    
                    @if ($ticket11 -> isNotEmpty())
                        @foreach ($ticket6 as $t1)
                        <label for="">{{$t1->tName}}</label>
                            ${{round(($t1->tPrice) * ($foflight->fprice))}}
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
                        ${{round(($t1->tPrice) * ($foflight->fprice))}}
                    @endforeach
                    <input type='button' value='-' class='qtyminus' field='ticket11' />
                    <input type='text' readonly="readonly" name='ticket11' value="{{old('ticket11') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket11' />
                    
                    <label for="">離島居民敬老</label>
                    @foreach ($ticket8 as $t1)
                        ${{round(($t1->tPrice) * ($foflight->fprice))}}
                    @endforeach
                    <input type='button' value='-' class='qtyminus' field='ticket13' />
                    <input type='text' readonly="readonly" name='ticket13' value="{{old('ticket13') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket13' />
                    
                    <label for="">離島居民愛心</label>
                    @foreach ($ticket9 as $t1)
                        ${{round(($t1->tPrice) * ($foflight->fprice))}}
                    @endforeach
                    <input type='button' value='-' class='qtyminus' field='ticket14' />
                    <input type='text' readonly="readonly" name='ticket14' value="{{old('ticket14') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket14' />
                    
                    <br>
                    
                    <label for="">離島居民愛陪</label>
                    @foreach ($ticket10 as $t1)
                        ${{round(($t1->tPrice) * ($foflight->fprice))}}
                    @endforeach
                    <input type='button' value='-' class='qtyminus' field='ticket15' />
                    <input type='text' readonly="readonly" name='ticket15' value="{{old('ticket15') ?? '0'}}" class='qty' />
                    <input type='button' value='+' class='qtyplus' field='ticket15' />
                    
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

                    @if(isset($mId))
                        {{-- 有登入 --}}
                        <button type="submit">確定</button>
                    @else
                    {{-- 沒有登入 --}}
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">確定</button>
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
                                        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                        <button type="button" class="btn btn-primary" onclick="location.href='{{route('login.index')}}'">前往登入</button>
                                        {{-- <button type="submit" class="btn btn-primary">確認</button> --}}
                                    </div>
                                    </div>
                                </div>
                            </div>
                    @endif
                </form>
            @else
                <h4>查無航班!</h4>
            @endif
        @else
            回程:
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
        
            飛機名稱:{{$foflight->fName}}
            起飛時間:{{$foflight->Ltime}}
            全額票價:{{$foflight->fprice}}
            旅客人數:{{$quantity}}
            @if ($quantity2 != 0)
                嬰兒人數:{{$quantity2}}
            @endif
            <br>
            <form action="{{ route('order.index2')}}" method="GET">
                @csrf 
                {{-- 去程航班id --}}
                <input type="hidden" name="toId" value="{{$toId}}">
                <input type="hidden" name="toticket1[]" value="{{$toticket1[0]}}">
                <input type="hidden" name="toticket1[]" value="{{$toticket1[1]}}">
                {{-- {{dd($toticket1[0])}} --}}
                {{-- {{dd($toticket2[0])}} --}}
                <input type="hidden" name="toticket2[]" value="{{$toticket2[0]}}">
                <input type="hidden" name="toticket2[]" value="{{$toticket2[1]}}">
                <input type="hidden" name="toticket3[]" value="{{$toticket3[0]}}">
                <input type="hidden" name="toticket3[]" value="{{$toticket3[1]}}">
                <input type="hidden" name="toticket4[]" value="{{$toticket4[0]}}">
                <input type="hidden" name="toticket4[]" value="{{$toticket4[1]}}">
                {{-- 回程航班id --}}
                <input type="hidden" name="foId" value="{{$foflight->fId}}">
                <input type="hidden" name="quantity" value="{{$quantity}}">
                <input type="hidden" name="quantity2" value="{{$quantity2}}">

                <label for="">全額</label>${{$foflight->fprice}}
                <input type='button' value='-' class='qtyminus' field='ticket2' />
                {{-- text readonly 只可複制，不可進行編輯。後台會接收到傳值。 --}}
                <input type='text' readonly="readonly" name='ticket2' value="{{old('ticket2') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket2' />

                <label for="">孩童</label>
                @foreach ($ticket1 as $t1)
                    ${{round(($t1->tPrice) * ($foflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket16' />
                <input type='text' readonly="readonly" name='ticket16' value="{{old('ticket16') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket16' />

                <label for="">敬老</label>
                @foreach ($ticket2 as $t1)
                    ${{round(($t1->tPrice) * ($foflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket7' />
                <input type='text' readonly="readonly" name='ticket7' value="{{old('ticket7') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket7' />
                
                <br>
                
                <label for="">軍人</label>
                @foreach ($ticket3 as $t1)
                    ${{round(($t1->tPrice) * ($foflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket8' />
                <input type='text' readonly="readonly" name='ticket8' value="{{old('ticket8') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket8' />

                <label for="">愛心</label>
                @foreach ($ticket4 as $t1)
                    ${{round(($t1->tPrice) * ($foflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket9' />
                <input type='text' readonly="readonly" name='ticket9' value="{{old('ticket9') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket9' />

                <label for="">愛心陪同</label>
                @foreach ($ticket5 as $t1)
                    ${{round(($t1->tPrice) * ($foflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket10' />
                <input type='text' readonly="readonly" name='ticket10' value="{{old('ticket10') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket10' />
                
                <br>
                
                @if ($ticket11 -> isNotEmpty())
                    @foreach ($ticket6 as $t1)
                    <label for="">{{$t1->tName}}</label>
                        ${{round(($t1->tPrice) * ($foflight->fprice))}}
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
                    ${{round(($t1->tPrice) * ($foflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket11' />
                <input type='text' readonly="readonly" name='ticket11' value="{{old('ticket11') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket11' />
                
                <label for="">離島居民敬老</label>
                @foreach ($ticket8 as $t1)
                    ${{round(($t1->tPrice) * ($foflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket13' />
                <input type='text' readonly="readonly" name='ticket13' value="{{old('ticket13') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket13' />
                
                <label for="">離島居民愛心</label>
                @foreach ($ticket9 as $t1)
                    ${{round(($t1->tPrice) * ($foflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket14' />
                <input type='text' readonly="readonly" name='ticket14' value="{{old('ticket14') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket14' />
                
                <br>
                
                <label for="">離島居民愛陪</label>
                @foreach ($ticket10 as $t1)
                    ${{round(($t1->tPrice) * ($foflight->fprice))}}
                @endforeach
                <input type='button' value='-' class='qtyminus' field='ticket15' />
                <input type='text' readonly="readonly" name='ticket15' value="{{old('ticket15') ?? '0'}}" class='qty' />
                <input type='button' value='+' class='qtyplus' field='ticket15' />
                
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

                @if(isset($mId))
                    {{-- 有登入 --}}
                    <button type="submit">確定</button>
                @else
                {{-- 沒有登入 --}}
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">確定</button>
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
                                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{route('login.index')}}'">前往登入</button>
                                    {{-- <button type="submit" class="btn btn-primary">確認</button> --}}
                                </div>
                                </div>
                            </div>
                        </div>
                @endif

                    
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
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script
src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
crossorigin="anonymous"
></script>
<script
src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
crossorigin="anonymous"
></script>
<script
src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
crossorigin="anonymous"
></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>