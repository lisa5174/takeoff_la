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

    <form action="{{ route('login.login')}}" method="POST">
        @csrf 
        手機號碼或E-mail：<input type="text" name="macount" value="{{ old('macount') }}"><br> 
        密碼：<input type="text" name="mpw" value="{{ old('mpw') }}"><br>
        <button type="submit">登入</button>

    </form>
</body>
</html>