<style>
    #whole-flex {
    position: absolute;
    flex-direction: column;
    text-align: center;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: -10;
  }
  
  /* NavBar */
  .sidenav {
    max-width: 380px;
    width: 85%;
    overflow-x: hidden;
    overflow-y: hidden;
    height: 100%;
    position: fixed;
    z-index: 10001;
    top: 0;
    left: 0;
    background-color: white;
    transform-origin: left center;
    transform: translateX(-380px);
  }
  
  .sidenavHeader {
    color: white;
    font-weight: bold;
    background-color: #102847;
    padding: 10px 0px 10px 30px;
    font-size: 23px;
  }
  
  .sidenavContentHeader {
    margin-top: 5px;
    padding: 15px 0px 15px 25px;
    font-size: 20px;
    font-weight: bold;
  }
  
  .sidenavContent {
    padding: 15px 0px 15px 25px;
  }
  
  .sidenavContent:hover {
    background-color: #eaeded;
  }
  
  hr {
    height: 1px;
    border: 0;
    color: gray;
    background-color: gray;
    margin: 15px auto 10px auto;
  }
  
  .sidenavRow {
    display: flex;
    width: 100%;
    justify-content: space-between;
    padding: 15px 25px 15px 25px;
  }
  
  .sidenavRow:hover {
    background-color: #eaeded;
  }
  
  .sidenavRow:hover i {
    color: #111111 !important;
  }
  
  #closeBtn {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    margin-left: 390px;
    color: white;
    font-size: 50px;
    cursor: pointer;
    z-index: 220;
    transform: translateY(-5px);
    transition: visibility 0.5s;
  }
  
  a,
  a:link,
  a:visited,
  a:hover,
  a:active {
    text-decoration: none;
    color: black;
  }
  
  /* animation */
  @keyframes collapse {
    0% {
      z-index: 100;
      transform: translateX(0px);
    }
    100% {
      transform: translateX(-380px);
    }
  }
  
  @keyframes expand {
    0% {
      z-index: 100;
      transform: translateX(-380px);
    }
    100% {
      transform: translateX(0px);
    }
  }
  
  @keyframes show {
    0% {
      opacity: 0;
    }
    100% {
      opacity: 1;
    }
  }
  
  @keyframes hide {
    0% {
      opacity: 1;
    }
    100% {
      opacity: 0;
    }
  }
  
  /* Overlay */
  #overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 220;
    background-color: rgba(0, 0, 0, 0.7);
  }
  
  .freez {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
  }

  /* Dropdown */
  .sidenavContainer hr {
    width: 85%;
  }
  
  .sidenavRowDropdown {
    display: flex;
    width: 100%;
    justify-content: start;
    align-items: center;
    padding: 15px 25px 15px 25px;
    cursor: pointer;
  }
  
  .sidenavRowDropdown:hover {
    background-color: #eaeded;
  }
  
  .sidenavRowDropdown:hover i {
    color: #111111 !important;
  }
  
  .sidenavContainer {
    display: none;
    height: 0px;
    opacity: 0;
    transform: scaleY(0);
    transform-origin: center top;
  }
  
  @keyframes expandDropDown {
    0% {
      transform: scaleY(0);
      opacity: 0;
    }
    100% {
      transform: scaleY(1);
      opacity: 1;
    }
  }
  
  @keyframes collapseDropDown {
    0% {
      transform: scaleY(1);
      opacity: 1;
    }
    100% {
      transform: scaleY(0);
      opacity: 0;
    }
  }
  
  /* Container part */
  #main-container {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow-y: scroll;
  }
  
  @keyframes mainAway {
    0% {
      transform: translateX(0px);
    }
    100% {
      transform: translateX(-380px);
    }
  }
  
  @keyframes mainBack {
    0% {
      transform: translateX(-380px);
    }
    100% {
      transform: translateX(0px);
    }
  }
  
  #sub-container {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow-y: scroll;
    background-color: white;
    transform: translateX(380px);
  }
  
  @keyframes subBack {
    0% {
      transform: translateX(380px);
    }
    100% {
      transform: translateX(0px);
    }
  }
  
  @keyframes subPush {
    0% {
      transform: translateX(0px);
    }
    100% {
      transform: translateX(380px);
    }
  }
  
  #mainMenu {
    margin-top: 5px;
    padding: 15px 0px 15px 25px;
    font-weight: bold;
  }
  
  #mainMenu:hover {
    background-color: #eaeded;
    cursor: pointer;
  }
  
</style>

   
    <div class="sidenav" id="mySidenav">
      <div class="sidenavHeader">
           @if(Auth::check())
            <i class="fas fa-user-circle"></i> Hello, {{ Auth::user()->name }}
            @else
        <i class="fas fa-user-circle"></i> Hello, Sign In
        @endif
      </div>
      <!--Below SideNavHeader-->
      <div id="main-container">
     
        <div class="sidenavContentHeader">All Categories</div>
        @foreach (\App\Category::where('level', 0)->orderBy('order_level', 'desc')->get() as $key => $category)
        <a href="#"  onclick="openPrimeVideo({{$category->id}})"
          ><div class="sidenavRow">
            <div> {{ $category->getTranslation('name') }}</div>
            <i class="fas fa-chevron-right" style="color: #8e9090"></i></div
        ></a>
      @endforeach
    
     
        <hr />
       
        <div style="height: 50px"></div>
      </div>
      <!--End of first container-->

      <div id="sub-container">
        <div id="mainMenu">
          <i class="fas fa-chevron-left" style="color: #8e9090"></i> MAIN MENU
        </div>
        <hr />
        <div id="sub-container-content">
         <?php
          $data = DB::table('categories')->where('parent_id',0)->get();
         ?>
         @foreach($data as $row)
         <a href='/category/{{$row->slug}}'><div class='sidenavContent'>{{$row->name}}</div></a>
        @endforeach     
        </div>
      </div>
    </div>

 <script src="{{asset('public/assets/js/sidebar.js')}}"></script>

