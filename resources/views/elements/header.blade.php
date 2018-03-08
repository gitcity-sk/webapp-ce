    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top flex-md-nowrap p-0 bg-dark" style="background-color: #292961">
          <a class="navbar-brand ml-2" href="/">Webapp</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          <div class="collapse navbar-collapse ml-2 mr-2" id="navbarCollapse">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="/projects">@lang('messages.projects') <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/groups">@lang('messages.groups') <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/pages">@lang('messages.pages') <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/admin/roles"><i class="fas fa-wrench"></i> <span class="sr-only">(current)</span></a>
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
