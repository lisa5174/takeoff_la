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
    航班<br>
    出發機場：<br>
    目的機場：<br>
    啟程日期：<br>
    回程日期：<br>
    人數票種：<br>
    
    旅客<br>
    姓名：{{$pname}}<br>
    身分證字號：{{$pid}}<br>
    性別：{{$pgender}}<br>
    生日：{{$pbirth}}<br>
    
    聯絡人<br>
    姓名：{{$cname}}<br>
    行動電話：{{$cphone}}<br>
    電子信箱：{{$cemail}}<br>
    
    信用卡<br>
    卡別：{{$cretype}}<br>
    有效日期(月/年)：{{$camonth}}/{{$cayear}}<br>
    卡號：{{$caid[1]}}-{{$caid[2]}}-{{$caid[3]}}-{{$caid[4]}}<br>
    檢查碼：{{$cacheckcode}}<br>
</body>
</html>