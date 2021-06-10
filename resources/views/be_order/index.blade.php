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

    <form action="{{ route('pay.index')}}" method="GET">
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
        
        <input type="hidden" name="quantity2" value="{{$quantity2}}">

        旅客<br>
        @if(empty($passengers))
            姓名：<input type="text" name="pname" value="{{ old('pname') }}"><br>
            性別：
            <select name="pgender"> 
                <option selected></option>
                <option value="1">男</option>
                <option value="0">女</option>
            </select><br>
            身分證字號：<input type="text" name="pid" value="{{ old('pid') }}"><br>
            生日：<input type="date" name="pbirth" value="{{ old('pbirth') }}"><br>
        @else
            @foreach ($passengers as $passenger)
            姓名：<input type="text" name="pname" value="{{$passenger->pName}}"><br>
            {{-- 性別：{{$gender}}<br> --}}
            性別：
            <select name="pgender"> 
                <option value="1" {{$passenger->pId == '1' ? 'selected' : ''}}>男</option>
                <option value="0" {{$passenger->pId == '0' ? 'selected' : ''}}>女</option>
            </select><br>
            身分證字號：<input type="text" name="pid" value="{{$passenger->pId}}"><br>
            生日：<input type="date" name="pbirth" value="{{$passenger->birthday}}"><br>
            @endforeach
        @endif

        聯絡人資料<br>
        @if(empty($contacts))
            姓名：<input type="text" name="cname" value="{{ old('cname') }}"><br>
            行動電話：<input type="text" name="cphone" value="{{ old('cphone') }}"><br>
            電子信箱：<input type="text" name="cemail" value="{{ old('cemail') }}"><br>
        @else
            @foreach ($contacts as $contact)
            姓名：<input type="text" name="cname" value="{{$contact->cName}}"><br>
            行動電話：<input type="text" name="cphone" value="{{$contact->cPhone}}"><br>
            電子信箱：<input type="text" name="cemail" value="{{$contact->cEmail}}"><br>
            @endforeach
        @endif

        <button type="submit">下一步</button>

    </form>
</body>
</html>