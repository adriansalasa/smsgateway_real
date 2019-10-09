<aside id="sidebar-wrapper">

  <div class="sidebar-brand">

    <a href="{{ route('admin.dashboard') }}"><img src="{{ asset('assets/img/logodantext.png') }}" alt="logo" width="150" class=""></a>

  </div>

  <div class="sidebar-brand sidebar-brand-sm">

    <a href="index.html">St</a>

  </div>

  <ul class="sidebar-menu">

      <li class="menu-header">Dashboard</li>

      <li class="{{ Request::route()->getName() == 'admin.dashboard' ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fa fa-columns"></i> <span>Dashboard</span></a></li>

      @if(Auth::user()->uid == '5')

      <li class="menu-header">Users</li>

      <li class="{{ Request::route()->getName() == 'admin.users' ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.profile')}}"><i class="fa fa-users"></i> <span>Profile Settings</span></a></li>

      @endif

     <!--  @if(Auth::user()->uid != '1') -->

       <li class="{{ Request::route()->getName() == 'admin.topup' ? ' active': '' }}"><a class="nav-link" href="{{ route('admin.topup') }}"><i class="fa fa-wallet"></i><span>TopUP</span></a></li>

<!--       @endif -->

       @if(Auth::user()->uid == '1')

       <li class="{{ Request::route()->getName() == 'admin.notification' ? ' active': '' }}"><a class="nav-link" href="{{ route('admin.notification') }}"><i class="fa fa-bell"></i><span>Notification</span></a></li>

       @endif

      <li class="dropdown {{ Request::route()->getName() == 'admin.phonebook' || Request::route()->getName() == 'admin.import'? ' active' : '' }}">

        <a href="#" class="nav-link has-dropdown"><i class="fa fa-id-card"></i> <span>Kontak</span></a>

        <ul class="dropdown-menu">

          <li class=" {{ Request::route()->getName() == 'admin.phonebook' ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.phonebook') }}">Phonebook</a></li>

          <li class=" {{ Request::route()->getName() == 'admin.group' ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.group') }}">Groups</a></li>

          <li class=" {{ Request::route()->getName() == 'admin.import' ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.import') }}">Import</a></li>

          <li><a class="nav-link" href="{{ route('admin.export') }}">Eksport</a></li>

        </ul>

      </li>



      <li class="dropdown {{ Request::route()->getName() == 'admin.compose' || Request::route()->getName() == 'admin.inbox' || Request::route()->getName() == 'admin.outbox'  ? ' active' : '' }}">

          <a href="#" class="nav-link has-dropdown"><i class="fa fa-envelope"></i> <span>Pesan</span></a>

          <ul class="dropdown-menu">

            <li class=" {{ Request::route()->getName() == 'admin.compose' ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.compose') }}">Tulis</a></li>

            <li class=" {{ Request::route()->getName() == 'admin.inbox' ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.inbox') }}">Inbox</a></li>

            <li class=" {{ Request::route()->getName() == 'admin.outbox' ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.outbox') }}">Outbox</a></li>

            <li class=" {{ Request::route()->getName() == 'admin.draft' ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.draft') }}">Draf</a></li>

            <li class=" {{ Request::route()->getName() == 'admin.schedule' ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.schedule') }}">Shedule</a></li>

            <li class=" {{ Request::route()->getName() == 'admin.template' ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.template') }}">Template</a></li>

          </ul>

        </li>

    </ul>

</aside>

