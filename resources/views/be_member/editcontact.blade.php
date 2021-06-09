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

    <form action="{{ route('member.updatecontact')}}" method="POST">
        @csrf

        聯絡人資料<br>
        @foreach ($contacts as $contact)
        姓名：<input type="text" name="cName" value="{{$contact->cName}}"><br>
        行動電話：<input type="text" name="cPhone" value="{{$contact->cPhone}}"><br>
        電子信箱：<input type="text" name="cEmail" value="{{$contact->cEmail}}"><br>
        @endforeach

        <button type="button" onclick="location.href='{{route('member.index')}}'">取消</button><br>
        <button type="submit">確定修改</button>
    </form>
    
</body>
</html>