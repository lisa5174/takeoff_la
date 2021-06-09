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

    <form action="{{ route('resetpw.updatepw')}}" method="POST">
        @csrf

        <h2 class="fs-title">重設密碼</h2><br>    
        <div class="col-4 ">
            原密碼：<input type="password" name="pwd"/><br>
            新密碼：<input type="password" name="newpwd"/><br> 
            確認新密碼：<input type="password" name="newpwd_confirmation"/><br> 
        </div>
        
        <button type="button" onclick="location.href='{{route('member.index')}}'">取消</button><br>
        <button type="submit">確定修改</button>
    </form>
    
</body>
</html>