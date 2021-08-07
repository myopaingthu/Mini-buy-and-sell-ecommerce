<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('products.index') }}"><i class="fa fa-store"></i> Second Boutique</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        @auth
        <li class="nav-item active">
          <a class="nav-link" href="{{route('notifications.index')}}"><i class="fa fa-bell"></i> <span class="badge badge-secondary noti">{{$unread_noti_count}}</span></a>
        </li>
        <li class="nav-item {{ request()->routeIs('products.create') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('products.create') }}">Sell</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->name }}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href={{ route('users.show', [auth()->user()->id]) }}">Profile</a>
            <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}">Log Out</a>
          </div>
        </li>
      @endauth
      @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}" role="button">Log in</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}" role="button">Register</a>
        </li>
      @endguest
        
      </ul>
      
    </div>
  </nav>