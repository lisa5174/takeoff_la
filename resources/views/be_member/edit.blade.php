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
    會員基本資料
    
    <button type="button" onclick="location.href='{{route('member.editmember')}}'">編輯</button>
    <button type="button" onclick="location.href='{{route('login.logout')}}'">登出</button>
    {{-- <a href="{{ route('login.logout')}}">登出</a> --}}
    <br>
    會員資料<br>
    @foreach ($members as $member)
    電子信箱：{{$member->mEmail}}<br>
    手機號碼：{{$member->mPhone}}<br>
    @endforeach

    旅客資料<br>
    @foreach ($passengers as $passenger)
    姓名：{{$passenger->pName}}<br>
    身分證字號：{{$passenger->pId}}<br>
    性別：{{$gender}}<br>
    生日：{{$passenger->birthday}}<br>
    @endforeach
    
    聯絡人資料<br>
    @foreach ($contacts as $contact)
    姓名：{{$contact->cName}}<br>
    行動電話：{{$contact->cPhone}}<br>
    電子信箱：{{$contact->cEmail}}<br>
    @endforeach
    
    信用卡資料<br>
    @foreach ($pays as $pay)
    卡別：{{$pay->creName}}<br>
    有效日期(月/年)：{{substr("$pay->validityPeriod",0,2)}}/{{substr("$pay->validityPeriod", -2)}}<br>
    卡號：{{substr("$pay->caNumber",0,4)}}-{{substr("$pay->caNumber",4,4)}}-{{substr("$pay->caNumber",8,4)}}-{{substr("$pay->caNumber",-4)}}<br>
    檢查碼：{{$pay->checkCode}}<br>
    @endforeach
    
</body>
</html>