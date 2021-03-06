<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous"
    />

    @yield('css')
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    @yield('title')
    <link rel="icon" href="{{ asset('/favicon.ico')}}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{ asset('/favicon.ico')}}" type="image/x-icon"/>
    @yield('name')
</head>
<body >
    <div>
        <!-- Navigation導覽列 -->
        <!-- navbar只有light,dark,為設定字體顏色 -->
    <nav
        class="navbar navbar-expand-lg navbar-dark static-top"
        style="background-color: #6798c0">
        <div class="container">
            <div class="row-4">
                <button class="navbar-brand no-gutters" onclick="location.href='{{route('today')}}'">
                <img src="{{ asset('/icon1.png')}}" width="50px" height="50px" style="margin: 0px" alt="icon" class="navbar-brand no-gutters"> 
                 <span style="font-size:22px">Take off 空 </span></button>
            </div>
            <div id="Date"> </div>
            <div>
                <!-- Bootstrap NavBar -->
                <nav class="navbar navbar-expand-md ">
                  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <a class="navbar-brand">                    
                  <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">                           
                      <!-- This menu is hidden in bigger devices with d-sm-none. -->
                      <li class="nav-item dropdown d-sm-block d-md-none" >
                            <button class="dropdown-item" onclick="location.href='{{route('today')}}'">今日航班</button>
                            <button class="dropdown-item" onclick="location.href='{{route('putshelf')}}'">上架航班</button>
                            <button class="dropdown-item" onclick="location.href='{{route('offshelf')}}'">下架航班</button>
                            <button class="dropdown-item" onclick="location.href='{{route('updateflight.index')}}'">修改航班</button>
                            <button class="dropdown-item" onclick="location.href='{{route('search')}}'">查詢航班</button>    
                            <button class="dropdown-item" onclick="location.href='{{route('showorder.index')}}'">查看訂單</button>
                            <button class="dropdown-item" onclick="location.href='{{route('aflogin.aflogout')}}'">登出</button>                                                                     
                      </li><!-- Smaller devices menu END -->
                    </ul>
                  </div>
                </a>
                </nav><!-- NavBar END -->        
                  </div>
                </div></a></div>

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

        <div class="row" id="body-row">
            <!-- Sidebar -->
            <div id="sidebar-container" class="sidebar-expanded d-none d-md-block" style="width: 230px;"><!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
                <!-- Bootstrap List Group -->
                <ul class="list-group">
                    <!-- Separator with title -->
                    
                    <!-- /END Separator -->
                    <!-- Menu with submenu -->
                    <a href="#submenu1" class="bg-transparent list-group-item list-group-item-action" data-toggle="collapse" aria-expanded="false">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fas fa-user-edit fa-fw mr-3"aria-hidden="true"style="margin-right:12px !important;"></span>
                            <span class="menu-collapsed">管理航班</span>
                            <span class="submenu-icon ml-auto"></span>
                        </div>
                    </a>
                    
                <div id='submenu1' class="collapse sidebar-submenu show active" >
                    <button  onclick="location.href='{{route('today')}}'" class="list-group-item list-group-item-action flex-column align-items-start"style="padding-left:30px"id="chc1">
                        <div class="d-flex w-100 justify-content-start align-items-center"style="color: black">
                            <span class="fa fa-plane fa-fw mr-3"aria-hidden="true"></span> 
                            <span class="menu-collapsed" >今日航班</span>
                        </div>
                    </button>
                    <button  onclick="location.href='{{route('putshelf')}}'" class=" list-group-item list-group-item-action flex-column align-items-start"style="padding-left:30px"id="chc2">
                        <div class="d-flex w-100 justify-content-start align-items-center"style="color: black">
                            <span class="fa fa-upload fa-fw mr-3"aria-hidden="true"></span>
                            <span class="menu-collapsed" >上架</span>
                        </div>
                    </button>
                    <button  onclick="location.href='{{route('offshelf')}}'" class=" list-group-item list-group-item-action flex-column align-items-start"style="padding-left:30px"id="chc3">
                        <div class="d-flex w-100 justify-content-start align-items-center"style="color: black">
                            <span class="fa fa-download fa-fw mr-3"aria-hidden="true"></span>
                            <span class="menu-collapsed">下架</span>    
                        </div>
                    </button>
                    <button  onclick="location.href='{{route('updateflight.index')}}'" class="list-group-item list-group-item-action flex-column align-items-start"style="padding-left:30px"id="chc4">
                        <div class="d-flex w-100 justify-content-start align-items-center"style="color: black">
                            <span class="fa fa-pencil fa-fw mr-3"aria-hidden="true"></span>
                            <span class="menu-collapsed" >修改</span>    
                        </div>
                    </button>
                    <button  onclick="location.href='{{route('search')}}'" class="list-group-item list-group-item-action flex-column align-items-start"style="padding-left:30px"id="chc5">
                        <div class="d-flex w-100 justify-content-start align-items-center"style="color: black">
                            <span class="fa fa-search fa-fw mr-3"aria-hidden="true"></span>
                            <span class="menu-collapsed">查詢</span>    
                        </div>
                    </button>
                </div>

                    <button  onclick="location.href='{{route('showorder.index')}}'" class="list-group-item list-group-item-action flex-column align-items-start"id="chc6">
                        <div class="d-flex w-100 justify-content-start align-items-center"style="color: black">
                            <span class="material-icons mr-3"aria-hidden="true"style="margin-right:13px !important;">airplane_ticket</span>
                            <span class="menu-collapsed" >查看訂單</span>    
                        </div>
                    </button>
                    <button  onclick="location.href='{{route('aflogin.aflogout')}}'" class="bg-transparent list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-start align-items-center"style="color: black">
                            <span class="fas fa-sign-out-alt mr-3"aria-hidden="true"></span>
                            <span class="menu-collapsed" >登出</span>    
                        </div>
                    </button>
          </div><!-- sidebar-container END -->

  <div class="col" id="cc" style="padding-right: 50px;">                     
   <div class="container" id="cc2" >
    <div class="container" id="cc3">
        @yield('main')
    </div>    
   </div>
  </div>

  <script>// Hide submenus
    $('#body-row .collapse').collapse('hide'); 
    
    // Collapse/Expand icon
    $('#collapse-icon').addClass('fa-angle-double-left'); 
    
    // Collapse click
    $('[data-toggle=sidebar-colapse]').click(function() {
        SidebarCollapse();
    });
    
    function SidebarCollapse () {
        $('.menu-collapsed').toggleClass('d-none');
        $('.sidebar-submenu').toggleClass('d-none');
        $('.submenu-icon').toggleClass('d-none');
        $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
        
        // Treating d-flex/d-none on separators with title
        var SeparatorTitle = $('.sidebar-separator-title');
        if ( SeparatorTitle.hasClass('d-flex') ) {
            SeparatorTitle.removeClass('d-flex');
        } else {
            SeparatorTitle.addClass('d-flex');
        }
        
        // Collapse/Expand icon
        $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
    }</script>
    
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>