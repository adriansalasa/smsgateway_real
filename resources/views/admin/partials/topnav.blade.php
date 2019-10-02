
     <!--  <audio src="{{url('sound/Bell.mp3')}}"
            autoplay="autoplay" hidden="true">      
      </audio> -->      
<!DOCTYPE html>
<html>
<body>     
    <!--   <iframe src="https://s3.amazonaws.com/Syntaxxx/bigger-picture.mp3" allow="autoplay" 
      style="display:none" id="iframeAudio">
      </iframe>  -->
<form class="form-inline mr-auto" action="{{ route('admin.users') }}">

  <ul class="navbar-nav mr-3">

    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>

    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>

  </ul>

  <div class="search-element">

    <input class="form-control" value="{{ Request::get('query') }}" name="query" type="search" placeholder="Search" aria-label="Search" data-width="250">

    <button class="btn" type="submit"><i class="fas fa-search"></i></button>

    <div class="search-backdrop"></div>

    {{-- @include('admin.partials.searchhistory') --}}

  </div>

</form>

<ul class="navbar-nav navbar-right">

  @if(Auth::user()->uid == '1')
 <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
   <li class="dropdown dropdown-list-toggle">    

     @foreach(App\buycredit::select(DB::raw('count(idtagihan) as cntNotif'))->where('confirmYn', 'N')->get() as $JmlNotifitems)
          
      @if ($JmlNotifitems->cntNotif > 0 )     
      <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">
      <i class="fa fa-bell text-warning"></i>
      <label class="ml-2">{{ $JmlNotifitems->cntNotif}} New Notification</label>
      </a>         

      <!-- <audio controls>
        <source src="Bell.mp3">          
      </audio> -->     

       <iframe src="{{url('sound/Bell.mp3')}}" allow="autoplay" 
      style="display:none" id="iframeAudio">
      </iframe>       
          
      @else   
      <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">
      <i class="fa fa-bell"></i>
      </a>
      @endif
      @endforeach

      <div class="dropdown-menu dropdown-list dropdown-menu-right">

        <div class="dropdown-header">Notification</div>  

          <div class="dropdown-list-content dropdown-list-icons">             

              @foreach(App\buycredit::SELECT('idTagihan', 'username', 'noTelp', 'nominal',
              DB::raw("CONCAT('Request pengisian paket',' ', Playsms_BuyCredit.nominal) AS detailMessages"), 
              'createDt')->JOIN('playsms_tblUser', 'idUser', '=', 'uid')->where('confirmYn', 'N')->orderBy('createDt', 'DESC')->get() as $Notifitems)

              <!-- <a href="{{url('notification/view/'.$Notifitems->idTagihan)}}" class="dropdown-item  -->
                <a href="{{url('notification')}}" class="dropdown-item dropdown-item-unread">

                <div class="dropdown-item-icon bg-danger text-white">

                  <i class="fas fa-user"></i>                  

                </div>

                <div class="dropdown-item-desc">
                  
                  {{ substr($Notifitems->detailMessages, 0,35) }}

                  <div class="time text-primary">{{$Notifitems->createDt}}</div>

                </div>

              </a>
              @endforeach
              
              
          </div>

      </div>

  </li>
  @endif

  <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg{{ Auth::user()->unreadNotifications->count() ? ' beep' : '' }}"><!-- <i class="far fa-bell"></i> -->

     @if(Auth::user()->uid == '1')

     <i class="fa fa-envelope"></i>

     @else

     <i class="far fa-bell"></i>

     @endif

  </a>

    <div class="dropdown-menu dropdown-list dropdown-menu-right">     

      <div class="dropdown-header">
          @if(Auth::user()->uid == '1')
              Messages
          @else
              Notifications
          @endif

        <div class="float-right">

          <a href="{{url('pesan/inbox/read/'.Auth::user()->uid)}}">Mark All As Read</a>

        </div>

      </div>

      <div class="dropdown-list-content dropdown-list-icons">
        @if(App\Inbox::select('in_id', 'in_sender', 'in_msg', 'in_datetime')->where('read_status', 0)->where('in_uid', Auth::user()->uid)->orderBy('in_id', 'DESC')->count() == 0)
        <p class="text-muted p-2 text-center">No notifications found!</p>
        @else

        @foreach(App\Inbox::select('in_id', 'in_sender', 'in_msg', 'in_datetime')->where('read_status', 0)->where('in_uid', Auth::user()->uid)->orderBy('in_id', 'DESC')->get() as $items)

        <a href="{{url('pesan/inbox/view/'.$items->in_id)}}" class="dropdown-item dropdown-item-unread">

          <div class="dropdown-item-icon bg-primary text-white">

            <i class="fas fa-user"></i>

          </div>

          <div class="dropdown-item-desc">

            {{substr($items->in_msg, 0,35)}}...

            <div class="time text-primary">{{$items->in_datetime}}</div>

          </div>

        </a>

        @endforeach
        @endif


    </div>

  </li>

  <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">

    <img alt="image" src="{{ asset('assets/img/avatar/avatar-2.png') }}" class="rounded-circle mr-1">

    <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div></a>

    <div class="dropdown-menu dropdown-menu-right">

      <div class="dropdown-title">Welcome, {{ Auth::user()->name }}</div>

      <a href="{{route('admin.profile')}}" class="dropdown-item has-icon">

        <i class="far fa-user"></i> Profile Settings

      </a>

      <div class="dropdown-divider"></div>

      <a href="{{route('keluar')}}" class="dropdown-item has-icon text-danger">

        <i class="fas fa-sign-out-alt"></i> Logout

      </a>

    </div>

  </li>

</ul>
</body>
</html>