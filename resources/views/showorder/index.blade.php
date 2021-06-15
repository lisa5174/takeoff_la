{{-- showorder --}}
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
    <table>
        <thead>
            <tr>
                <th><h6><b> 訂單編號</th>
                <th><h6><b> 會員編號</th>
                <th><h6><b> 訂購票種</th>
                <th><h6><b> 機票價格</th>
                <th><h6><b> 飛機名稱</th>
                <th><h6><b> 起飛時間</th>
                <th><h6><b> 起飛地點</th>
                <th><h6><b> 降落地點</th>
            </tr>
        </thead>

        <tbody>
            @foreach($flights as $flight)
                <tr>
                    <td>{{ $flight->aId}}</td>
                    <td>{{ $flight->mId}}</td>
                    <td>{{ $flight->tName}}</td>
                    <td>{{ $flight->price}}</td>
                    <td>{{ $flight->fName}}</td>
                    <td>{{ $flight->Ltime }}</td>  
                    <td>{{ $flight->toplace}}</td>
                    <td>{{ $flight->foplace}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>