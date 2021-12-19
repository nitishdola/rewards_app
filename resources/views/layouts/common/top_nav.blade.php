<nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
  <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>
  <ul class="navbar-nav ml-auto">
    
    
    
    <div class="topbar-divider d-none d-sm-block"></div>
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
        @else
        <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
        @endif
        <span class="ml-2 d-none d-lg-inline text-white small">
          
          {{ Auth::user()->name }}


        </span>
      </a>
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <div class="dropdown-divider"></div>
        <form method="POST" action="{{ route('logout') }}">
              @csrf

              <x-jet-dropdown-link href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                              this.closest('form').submit();">
                  {{ __('Log Out') }}
              </x-jet-dropdown-link>
          </form>
      </div>
    </li>
  </ul>
</nav>