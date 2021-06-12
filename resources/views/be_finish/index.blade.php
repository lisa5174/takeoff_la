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
    <form action="{{ route('membersearch.checkoutsuccess')}}" method="GET">
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
        
        <input type="hidden" name="tprice" value="{{$price[1]}}">
        <input type="hidden" name="fprice" value="{{$price[2]}}">

        <input type="hidden" name="quantity2" value="{{$quantity2}}">

        <input type="hidden" name="pname" value="{{$pname}}">
        <input type="hidden" name="pgender" value="{{$pgender}}">
        <input type="hidden" name="pid" value="{{$pid}}">
        <input type="hidden" name="pbirth" value="{{$pbirth}}">
        
        <input type="hidden" name="cname" value="{{$cname}}">
        <input type="hidden" name="cphone" value="{{$cphone}}">
        <input type="hidden" name="cemail" value="{{$cemail}}">
        
        <input type="hidden" name="cretype" value="{{$cretype}}">
        <input type="hidden" name="camonth" value="{{$camonth}}">
        <input type="hidden" name="cayear" value="{{$cayear}}">
        <input type="hidden" name="caid" value="{{$caid[0]}}">
        <input type="hidden" name="cacheckcode" value="{{$cacheckcode}}">

        航班<br>
        去程<br>
        @foreach ($toflights as $toflight)
            飛機名稱：{{$toflight->fName}}<br>
            出發機場：{{$toflight->toplace}}<br>
            目的機場：{{$toflight->foplace}}<br>
            起飛日期：{{$toflight->date}}<br>
            起飛時間：{{$toflight->Ltime}}<br>
        @endforeach
        人數票種：<br>
        @foreach ($totickets[1] as $toticket)
            {{$toticket->tName}}票種{{$toticket1[1]}}張<br>
        @endforeach  
        @foreach ($totickets[2] as $toticket)
            {{$toticket->tName}}票種{{$toticket2[1]}}張<br>
        @endforeach  
        @foreach ($totickets[3] as $toticket)
            {{$toticket->tName}}票種{{$toticket3[1]}}張<br>
        @endforeach  
        @foreach ($totickets[4] as $toticket)
            {{$toticket->tName}}票種{{$toticket4[1]}}張<br>
        @endforeach
        @if ($quantity2 != 0)
            嬰兒票種{{$quantity2}}張<br>
        @endif 
        機票價格：{{$price[1]}}<br>
        
        <br>
        @if(isset($foId))
            回程<br>
            @foreach ($foflights as $foflight)
                飛機名稱：{{$foflight->fName}}<br>
                出發機場：{{$foflight->toplace}}<br>
                目的機場：{{$foflight->foplace}}<br>
                起飛日期：{{$foflight->date}}<br>
                起飛時間：{{$foflight->Ltime}}<br>
            @endforeach
            人數票種：<br>
            @foreach ($fotickets[1] as $foticket)
                {{$foticket->tName}}票種{{$foticket1[1]}}張<br>
            @endforeach  
            @foreach ($fotickets[2] as $foticket)
                {{$foticket->tName}}票種{{$foticket2[1]}}張<br>
            @endforeach  
            @foreach ($fotickets[3] as $foticket)
                {{$foticket->tName}}票種{{$foticket3[1]}}張<br>
            @endforeach  
            @foreach ($fotickets[4] as $foticket)
                {{$foticket->tName}}票種{{$foticket4[1]}}張<br>
            @endforeach
            @if ($quantity2 != 0)
            嬰兒票種{{$quantity2}}張<br>
            @endif 
            機票價格：{{$price[2]}}<br>
            共：{{$price[0]}}元<br> 
        @endif
        
        <br>
        旅客<br>
        姓名：{{$pname}}<br>
        身分證字號：{{$pid}}<br>
        性別：{{$showgender}}<br>
        生日：{{$pbirth}}<br>
        
        聯絡人<br>
        姓名：{{$cname}}<br>
        行動電話：{{$cphone}}<br>
        電子信箱：{{$cemail}}<br>
        
        信用卡<br>
        卡別：
        @foreach ($showcretypes as $showcretype)
            {{$showcretype->creName}}<br>
        @endforeach
        有效日期(月/年)：{{$camonth}}/{{$cayear}}<br>
        卡號：{{$caid[1]}}-{{$caid[2]}}-{{$caid[3]}}-{{$caid[4]}}<br>
        檢查碼：{{$cacheckcode}}<br>

        <button type="button" onclick="location.href='{{ url()->previous() }}'">上一步</button><br>
        <button type="submit">完成</button>
    </form>
</body>
</html>