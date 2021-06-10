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

    <form action="{{ route('finish.index')}}" method="GET">
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

        @if(isset($foId))
            <input type="hidden" name="foticket1[]" value="{{$foticket1[0]}}">
            <input type="hidden" name="foticket1[]" value="{{$foticket1[1]}}">
            <input type="hidden" name="foticket2[]" value="{{$foticket2[0]}}">
            <input type="hidden" name="foticket2[]" value="{{$foticket2[1]}}">
            <input type="hidden" name="foticket3[]" value="{{$foticket3[0]}}">
            <input type="hidden" name="foticket3[]" value="{{$foticket3[1]}}">
            <input type="hidden" name="foticket4[]" value="{{$foticket4[0]}}">
            <input type="hidden" name="foticket4[]" value="{{$foticket4[1]}}">
            {{-- 回程航班id --}}
            <input type="hidden" name="foId" value="{{$foId}}">
        @endif
        
        <input type="hidden" name="quantity2" value="{{$quantity2}}">

        <input type="hidden" name="pname" value="{{$pname}}">
        <input type="hidden" name="pgender" value="{{$pgender}}">
        <input type="hidden" name="pid" value="{{$pid}}">
        <input type="hidden" name="pbirth" value="{{$pbirth}}">
        
        <input type="hidden" name="cname" value="{{$cname}}">
        <input type="hidden" name="cphone" value="{{$cphone}}">
        <input type="hidden" name="cemail" value="{{$cemail}}">


        @if(empty($pays))
        <label >卡別：</label><br>
        <select class="list-dt" id="card" name="cretype"> 
            <option selected value=""></option>
            <option value="1">Visa Card</option>
            <option value="2">Master Card</option>
            <option value="3">American Express</option>
            <option value="4">JCB Card</option>
        </select>
        
        <br>
        
        <label class="pay">有效日期(月/西元年)：</label> <br><!--maxlength限定字數，oninput限定打數字-->
        <input class="col-3" type="text" id="month" name="camonth" placeholder="月" maxlength="2" oninput = "value=value.replace(/[^\d]/g,'')"/>
        <input class="col-4" type="text"  id="year" name="cayear" placeholder="年" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"/> 
        
        <br>

        <label >卡號：</label><br>   
        <input class="col-2" type="text" id="id1" name="id1" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"/>–
        <input class="col-2" type="text" id="id2" name="id2" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"/>–
        <input class="col-2" type="text" id="id3" name="id3" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"/>–
        <input class="col-2" type="text" id="id4" name="id4" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"/> 

        <br>
        
        <label >檢查碼：</label><br>   
        <input class="col-4" type="text"  id="check" name="cacheckcode"  maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"/><br>
        
        @else
            @foreach ($pays as $pay)
            卡別：<br>
            <select class="list-dt" id="card" name="cretype"> 
                {{-- <option selected value=""></option> --}}
                <option value="1" {{$pay->creType == '1' ? 'selected' : ''}}>Visa Card</option>
                <option value="2" {{$pay->creType == '1' ? 'selected' : ''}}>Master Card</option>
                <option value="3" {{$pay->creType == '1' ? 'selected' : ''}}>American Express</option>
                <option value="4" {{$pay->creType == '1' ? 'selected' : ''}}>JCB Card</option>
            </select>
            <br>
            有效日期(月/西元年)：<br>
            <input class="col-3" type="text" id="month" name="camonth" placeholder="月" maxlength="2" oninput = "value=value.replace(/[^\d]/g,'')"
            value="{{substr("$pay->validityPeriod",0,2)}}"/>
            <input class="col-4" type="text"  id="year" name="cayear" placeholder="年" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"
            value="{{substr("$pay->validityPeriod", -2)}}"/> 
            <br>
            卡號：<br>
            <input class="col-2" type="text" id="id1" name="id1" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"
            value="{{substr("$pay->caNumber",0,4)}}"/>–
            <input class="col-2" type="text" id="id2" name="id2" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"
            value="{{substr("$pay->caNumber",4,4)}}"/>–
            <input class="col-2" type="text" id="id3" name="id3" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"
            value="{{substr("$pay->caNumber",8,4)}}"/>–
            <input class="col-2" type="text" id="id4" name="id4" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"
            value="{{substr("$pay->caNumber",-4)}}"/>
            <br>
            檢查碼：<br>
            <input class="col-4" type="text"  id="check" name="cacheckcode"  maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"
            value="{{$pay->checkCode}}"/><br>
            @endforeach
        @endif

        <button type="submit">下一步</button>

    </form>
</body>
</html>