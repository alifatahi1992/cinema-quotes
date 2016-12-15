<header>
  <nav class="main-nav">
          <ul>
            @if(Auth::check())
            <li><a href="{{route('admin.quotes')}}">Quotes</a></li>
            <li><a href="{{route('admin.users')}}">Users</a></li>
            <li><a href="{{route('admin.logout')}}">Log Out</a></li>
              @endif
          </ul>
  </nav>
</header>
