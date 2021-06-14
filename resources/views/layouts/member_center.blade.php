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
    
    @yield('title')
</head>
<body>
    <div>
        <!-- Navigation導覽列 -->
        <!-- navbar只有light,dark,為設定字體顏色 -->
    <nav
        class="navbar navbar-expand-lg navbar-dark static-top"
        style="background-color: #6798c0">
         <div class="container">
          <button class="navbar-brand"  onclick="location.href='{{route('homepage.index')}}'"> Take off 空 </button>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarResponsive"
            aria-controls="navbarResponsive"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <button class="nav-link"  onclick="location.href='{{route('homepage.index')}}'">
                  回首頁
                  <span class="sr-only">(current)</span>
                </button>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdownPortfolio"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false">關於我們</a>

                <div class="dropdown-menu dropdown-menu-right"aria-labelledby="navbarDropdownPortfolio">
                  <button class="dropdown-item" onclick="location.href='{{route('serviceIntroduction.index')}}'">服務介紹</button>
                  <button class="dropdown-item" onclick="location.href='{{route('teamIntroduction.index')}}'">團隊介紹</button>
                </div>
              </li>
              <li class="nav-item">
                <button class="nav-link"  href="signup.html">會員中心</button>
              </li>
              <li class="nav-item">
                <button class="nav-link" onclick="location.href='{{route('login.logout')}}'">登出</button>
                {{-- <button class="nav-link"onclick="location.href='{{route('login')}}'">登入</button> --}}
              </li>
              
              <li class="nav-item dropdown d-sm-block d-md-none">
                <button class="dropdown-item"onclick="location.href='{{route('membersearch.index')}}'" href="order_search.html">查看訂單</button>
                <a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdownPortfolio"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">管理帳戶</a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio" >
                    <button class="dropdown-item active" onclick="location.href='{{route('member.index')}}'">會員基本資料</button>
                    <!-- active表示有底色 -->
                    <button class="dropdown-item "  onclick="location.href='{{route('resetpw.index')}}'">重設密碼</button>
                    </div>                                                                
              </li><!-- Smaller devices menu END -->
            </ul>
          </div>
        </div>
      </nav>
      <!-- /.container -->
    </div>
    <div class="row" id="body-row">
      <!-- Sidebar -->
      <div id="sidebar-container" class="sidebar-expanded d-none d-md-block" style="width: 230px;"><!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
          <!-- Bootstrap List Group -->
          <ul class="list-group">
              <!-- Separator with title -->
              
              <!-- /END Separator -->
              <!-- Menu with submenu -->
             <button onclick="location.href='{{route('membersearch.index')}}'" class="bg-transparent list-group-item list-group-item-action">
                 <div class="d-flex w-100 justify-content-start align-items-center">
                     <span class="fas fa-search fa-fw mr-3"></span> 
                     <span class="menu-collapsed">查看訂單</span>
                 </div>
             </button>
             <a href="#submenu1" class="bg-transparent list-group-item list-group-item-action" data-toggle="collapse" aria-expanded="false">
                 <div class="d-flex w-100 justify-content-start align-items-center">
                     <span class="fas fa-user-edit fa-fw mr-3"></span>
                     <span class="menu-collapsed">管理帳戶</span>
                     <span class="submenu-icon ml-auto"></span>
                 </div>
             </a>
             <!-- Submenu content -->
             <div id='submenu1' class="collapse sidebar-submenu" >
                 <button onclick="location.href='{{route('member.index')}}'" class="bg-transparent list-group-item list-group-item-action ">
                     <span class="menu-collapsed" style="font-size: 18px">會員基本資料</span>
                 </button>
                 <button onclick="location.href='{{route('resetpw.index')}}'" class="bg-transparent list-group-item list-group-item-action ">
                     <span class="menu-collapsed" style="font-size: 18px">重設密碼</span>
                 </button>
                 
           </div><!-- sidebar-container END -->
    </div><!-- sidebar-container END -->

<!-- MAIN -->
        <div class="col wrap">                     
          <div class="row justify-content-center mt-0">
            <div class="col-12 col-sm-9  text-center p-0 mt-5 mb-5"> 
              @yield('main')
            </div>
            
          </div>  
        </div>   <!-- Main Col END -->   
      </div>     <!-- body-row END -->       
      <footer class="footer">
        <label class="col align-self-center"style="margin-top: 15px;">Copyright © 2021 Take off 空 products. 版權所有</label>
      </footer> 
        {{-- <div mv-app="clock" mv-bar="none">

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
      </div> --}}
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