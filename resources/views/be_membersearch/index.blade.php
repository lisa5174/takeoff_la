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
    @if (session()->has('notice')) 
        <div class="m-2 bg-green-300 px-3 py-2 rounded">
            {{ session()->get('notice')}}
        </div>
    @endif

    @for ($i = 0; $i < $airticketnum[0]->num; $i++)
        訂單編號：{{$airticket[$i]->aId}}<br>
        航班<br>
        飛機名稱：{{$flight[$i]->fName}}<br>
        出發機場：{{$flight[$i]->toplace}}<br>
        目的機場：{{$flight[$i]->foplace}}<br>
        起飛日期：{{$flight[$i]->date}}<br>
        起飛時間：{{$flight[$i]->Ltime}}<br>
        人數票種：<br>
        @foreach ($tickettypenum[$i] as $tn)
            {{$tn->tName}}票種{{$tn->aNum}}張<br>
        @endforeach
        機票價格：{{$airticket[$i]->aprice}}<br>

        旅客<br>
        姓名：{{$passengers[$i]->pName}}<br>
        身分證字號：{{$passengers[$i]->pId}}<br>
        性別：{{$passengers[$i]->gender}}<br>
        生日：{{$passengers[$i]->birthday}}<br>
        
        聯絡人<br>
        姓名：{{$contacts[$i]->cName}}<br>
        行動電話：{{$contacts[$i]->cPhone}}<br>
        電子信箱：{{$contacts[$i]->cEmail}}<br>

        信用卡<br>
        卡別：{{$pays[$i]->creType}}<br>
        有效日期(月/年)：{{$pays[$i]->validityPeriod}}/<br>
        {{-- $p = $pays[$i]->caNumber --}}
        {{-- 卡號：{{substr("",0,4)}}-{{substr("$pays[$i]->caNumber",4,4)}}-
        {{substr("$pays[$i]->caNumber",8,4)}}-{{substr("$pays[$i]->caNumber",-4)}}<br> --}}
        檢查碼：{{$pays[$i]->checkCode}}<br>
        
        <br><br><br>
    @endfor

</body>
</html>