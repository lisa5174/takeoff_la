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

    <form action="{{ route('member.updatepassenger')}}" method="POST">
        @csrf

        旅客資料<br>
        @if(empty($passengers))
            姓名：<input type="text" name="pName" ><br>
            身分證字號：<input type="text" name="pId" ><br>
            性別：
            <select name="gender"> 
                <option selected></option>
                <option value="1" >男</option>
                <option value="0" >女</option>
            </select><br>
            生日：<input type="date" name="birthday"><br>
        @else
            @foreach ($passengers as $passenger)
            姓名：<input type="text" name="pName" value="{{$passenger->pName}}"><br>
            身分證字號：<input type="text" name="pId" value="{{$passenger->pId}}"><br>
            性別：
            <select name="gender"> 
                {{-- <option selected></option> --}}
                <option value="1" {{ (($passenger->gender) == "1" ? "selected":"") }}>男</option>
                <option value="0" {{ (($passenger->gender) == "0" ? "selected":"") }}>女</option>
            </select><br>
            生日：<input type="date" name="birthday" value="{{$passenger->birthday}}"><br>
            @endforeach
        @endif
        
        <button type="button" onclick="location.href='{{route('member.index')}}'">取消</button><br>
        <button type="submit">確定修改</button>
    </form>
    
</body>
</html>