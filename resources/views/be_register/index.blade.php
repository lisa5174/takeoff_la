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

    註冊  (手機號碼跟E-mail可擇一輸入)<br>
    <form action="{{ route('register.register')}}" method="POST">
        @csrf 
        手機號碼：<input type="text" name="rphone" /> <br>
        E-mail：<input type="text" name="remail" /> <br>
        *密碼：<input type="password" name="rpwd"/> <br>
        <button type="submit">註冊</button>
    </form>

    
</body>
</html>