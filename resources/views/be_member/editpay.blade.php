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

    <form action="{{ route('member.updatepay')}}" method="POST">
        @csrf

        信用卡資料<br>
        @foreach ($pays as $pay)

            <label >卡別：</label><br>
            <select class="list-dt" id="card" name="cretype"> 
                {{-- <option selected value=""></option> --}}
                <option value="1" {{ (($pay->creType) == "1" ? "selected":"") }}>Visa Card</option>
                <option value="2" {{ (($pay->creType) == "2" ? "selected":"") }}>Master Card</option>
                <option value="3" {{ (($pay->creType) == "3" ? "selected":"") }}>American Express</option>
                <option value="4" {{ (($pay->creType) == "4" ? "selected":"") }}>JCB Card</option>
            </select>
        
            <br>
            
            <label class="pay">有效日期(月年)：</label> <br><!--maxlength限定字數，oninput限定打數字-->
            <input class="col-3" type="text" id="month" name="camonth" placeholder="月" maxlength="2" oninput = "value=value.replace(/[^\d]/g,'')" 
            value="{{(substr($pay->validityPeriod,0,1)) == '0' ? substr($pay->validityPeriod,1,1) : substr($pay->validityPeriod,0,2)}}"/>

            <input class="col-4" type="text"  id="year" name="cayear" placeholder="年" maxlength="4" 
            oninput = "value=value.replace(/[^\d]/g,'')" value="20{{substr("$pay->validityPeriod", -2)}}"/> 
            
            <br>

            <label >卡號：</label><br>   
            <input class="col-2" type="text" id="id1" name="id1" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"
            value="{{substr("$pay->caNumber",0,4)}}"/>–
            <input class="col-2" type="text" id="id2" name="id2" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"
            value="{{substr("$pay->caNumber",4,4)}}"/>–
            <input class="col-2" type="text" id="id3" name="id3" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"
            value="{{substr("$pay->caNumber",8,4)}}"/>–
            <input class="col-2" type="text" id="id4" name="id4" maxlength="4" oninput = "value=value.replace(/[^\d]/g,'')"
            value="{{substr("$pay->caNumber",-4)}}"/> 

            <br>
            
            <label >檢查碼：</label><br>   
            <input class="col-4" type="text"  id="check" name="cacheckcode" maxlength="4"
            oninput = "value=value.replace(/[^\d]/g,'')" value="{{$pay->checkCode}}"/><br>
            {{-- maxlength={{(($pay->creType) == "3" ? "4" : "3" )}} --}}
        @endforeach

        <button type="button" onclick="location.href='{{route('member.index')}}'">取消</button><br>
        <button type="submit">確定修改</button>
    </form>
    
</body>
</html>