
<!DOCTYPE html>
<html>
<body>     

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

  </ul>
 
</form>


<ul class="navbar-nav navbar-right">

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  @if(Auth::user()->uid == '1')   
    
      <li class="dropdown dropdown-list-toggle sNotif" id="divNotif">         

       @foreach(App\buycredit::select(DB::raw('count(idtagihan) as cntNotif'))->where('confirmYn', 'N')->where('paidYn', 'Y')->get() as $JmlNotifitems)
            
          @if ($JmlNotifitems->cntNotif > 0 )     
          
            <a href="{{url('notification')}}" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">

                <i class="far fa-bell"></i> 

                <span class="badgePill badgePill badge-warning align-top">{{ $JmlNotifitems->cntNotif}}</span>
            </a>       
            
            <audio id="iframeAudio" autoplay>
                <source src="{{url('sound/Bell.mp3')}}" type="audio/mp3">
            </audio>

          @else   

            <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">
                <i class="far fa-bell"></i>
            </a>

          @endif

        @endforeach

        <div class="dropdown-menu dropdown-list dropdown-menu-right">

          @if($JmlNotifitems->cntNotif == 0)

              <div class="dropdown-header">Request</div>  

          @else

              <div class="dropdown-header">{{ $JmlNotifitems->cntNotif }} Request</div>  

          @endif

            <div class="dropdown-list-content dropdown-list-icons">  

                @if($JmlNotifitems->cntNotif == 0)

                  <p class="text-muted P-2 text-center">No Request Found!</p>           
              
                @else

                  @foreach(App\buycredit::SELECT('idTagihan', 'username', 'noTelp', 'nominal',
                  DB::raw("CONCAT('Request pengisian paket',' ', Playsms_BuyCredit.nominal) AS detailMessages"), 
                  'createDt')->JOIN('playsms_tblUser', 'idUser', '=', 'uid')->where('confirmYn', 'N')->where('paidYn', 'Y')->orderBy('createDt', 'DESC')->get() as $Notifitems)
                  
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

                @endif
                                
            </div>

        </div>

      </li>

    @endif

  <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">

     @foreach(App\Inbox::select(DB::raw('count(in_id) as msgNotif'))->where('read_status', '0')->where('in_uid', Auth::user()->uid)->orderBy('in_id', 'DESC')->get() as $Notf_msg)    
     @endforeach

       @if(Auth::user()->uid == '1')     

          <i class="fa fa-envelope"></i>

           @if($Notf_msg->msgNotif)

              <span class="badgePill badgePill badge-warning align-top">{{ $Notf_msg->msgNotif}}</span>

           @endif

       @else
       
          <i class="far fa-bell"></i>            

           @if($Notf_msg->msgNotif)

              <span class=" badgePill badgePill badge-warning align-top">{{ $Notf_msg->msgNotif}}</span> 

           @endif

       @endif

    </a>

    <div class="dropdown-menu dropdown-list dropdown-menu-right">  

      <div class="dropdown-header">

          @if(Auth::user()->uid == '1')

              @if($Notf_msg->msgNotif == 0)
                  Messages
              @else
                  {{ $Notf_msg->msgNotif}} Messages
              @endif

          @else

              @if($Notf_msg->msgNotif == 0)
                  Notifications
              @else
                  {{ $Notf_msg->msgNotif}} Notifications
              @endif  

          @endif

          <div class="float-right">

            <a href="{{url('pesan/inbox/read/'.Auth::user()->uid)}}">Mark All As Read</a>

          </div>

      </div>

    <div class="dropdown-list-content dropdown-list-icons">

        @if(App\Inbox::select('in_id', 'in_sender', 'in_msg', 'in_datetime')->where('read_status', 0)->where('in_uid', Auth::user()->uid)->orderBy('in_id', 'DESC')->count() == 0)

            @if(Auth::user()->uid == '1')

                <p class="text-muted p-2 text-center">No messages found!</p>

            @else

                <p class="text-muted p-2 text-center">No notifications found!</p>

            @endif

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

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript"> 

 //Refresh notifikasi dlm 5 detik
  var auto_refresh = setInterval(
  function ()
  {
  $('.sNotif').load(location.href + " #divNotif");
  }, 5000); // refresh every 15000 milliseconds

</script>

</body>
</html>