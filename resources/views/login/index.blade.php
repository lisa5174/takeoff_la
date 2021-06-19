{{-- aflogin --}}
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
      integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

   
    <link rel="stylesheet" href="{{ asset('css/b_today.css')}}"/>
    <title>Take off 空|後台_登入</title>
  </head>
<body style="background-color: white">
  <div>
    <!-- Navigation導覽列 -->
    <!-- navbar只有light,dark,為設定字體顏色 -->
<nav class="navbar navbar-expand-lg navbar-dark static-top" style="background-color: #6798c0">
    <div class="container">
      <div class="row-4">
        <button class="navbar-brand no-gutters" onclick="location.href='{{route('today')}}'" style="border: 0px;background: transparent;">
        <img src="{{ asset('/icon1.png')}}" width="50px" height="42px" style="margin: 0px" alt="icon" class="navbar-brand no-gutters"> 
         <span style="font-size:22px">Take off 空 </span></button>
      </div>
        <div id="Date"> </div>
         <div class="navbar-brand"style="visibility:hidden">Take off 空000000</div> {{--隱藏文字，讓時間置中 --}}
    </a></div></a></div>

    <div mv-app="clock" mv-bar="none">

        <script type="text/javascript"> //現在時間
        window.onload=function(){
        setInterval(function(){
        var date=new Date();
        var year=date.getFullYear(); //獲取當前年份
        var mon=date.getMonth()+1; //獲取當前月份
        var da=date.getDate(); //獲取當前日
        var day=date.getDay(); //獲取當前星期幾
        var h=date.getHours(); //獲取小時
        var m=date.getMinutes(); //獲取分鐘
        var s=date.getSeconds(); //獲取秒
        var d=document.getElementById('Date');
        d.innerHTML='現在時間:'+year+'年'+mon+'月'+da+'日'+/*'星期'+day+*/' '+h+':'+m+':'+s; },1000) }</script>
    </div>

    @if ($errors->any())
        <div class="errors m-2 p-1 bg-red-500 text-red-100 font-thin rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li  style="color:red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif 
    
<div id="boxForm"> <!--登入-->
    <h2 id="title">登入</h2>
    <form  action="{{ route('aflogin.aflogin')}}" method="POST">
      @csrf 
      <input class='text' type='user' name='adAccount' placeholder='帳號' required>
      <br>
      <input class='text' id='pwd' name='adPassword' type='password' placeholder='密碼' required>
      <br>
      <input class='button' type='submit' value='登入'>
    </form>
  </div>
  
<div mv-app="clock" mv-bar="none">
  <script
        src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"
      ></script>
      <script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"
      ></script>
      <script
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"
      ></script>
  </body>
</html>