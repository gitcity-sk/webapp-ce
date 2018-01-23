    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark py-0 py-md-0">
        <a class="navbar-brand" href="/">CodeOcean <span class="badge badge-pill badge-light">Docker Edition</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto" style="font-weight: 600">
            <li class="nav-item">
              <a class="nav-link" href="/projects">Projects <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/projects">Spaces <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/admin/roles">Admin <span class="sr-only">(current)</span></a>
            </li>
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <button class="btn btn-light my-2 my-sm-0" type="submit" style="margin-right: 10px">Search</button>

            @if (Route::has('login'))
              @auth
                  <a class="btn btn-light my-2 my-sm-0" href="{{ url('/dashboard') }}">{{ Auth::user()->name }}</a>
              @else
                  <a class="btn btn-light my-2 my-sm-0" href="{{ route('login') }}">Login / Register</a>
              @endauth
            @endif

          </form>
        </div>
      </nav>
    </header>
