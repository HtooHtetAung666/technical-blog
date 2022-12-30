<nav class="navbar navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand text-info" href="/">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-code-slash" viewBox="0 0 16 16">
          <path d="M10.478 1.647a.5.5 0 1 0-.956-.294l-4 13a.5.5 0 0 0 .956.294l4-13zM4.854 4.146a.5.5 0 0 1 0 .708L1.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0zm6.292 0a.5.5 0 0 0 0 .708L14.293 8l-3.147 3.146a.5.5 0 0 0 .708.708l3.5-3.5a.5.5 0 0 0 0-.708l-3.5-3.5a.5.5 0 0 0-.708 0z"/>
        </svg>
      </a>
      <div class="d-flex">

        <a href="/#blogs" class="nav-link">Blogs</a>

        {{-- <a href="/#subscribe" class="nav-link">Subscribe</a> --}}

        @guest
          <a href="/register" class="nav-link">Register</a>
          <a href="/login" class="nav nav-link">Login</a>
        @else
          @can('admin')
            <a href="/bensai/blogs" class="nav nav-link">Dashboard</a>  
          @endcan
          <img src="{{auth()->user()->avatar}}" width="40" height="40" class="rounded-circle" alt="">
          <a href="" class="nav nav-link text-muted">User {{auth()->user()->name}}</a>
          <form action="/logout" method="POST">
            @csrf
            <button class="nav-link btn btn-link" type="submit">
              Logout
            </button>
          </form>
        @endguest

      </div>
    </div>
</nav>