    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top flex-md-nowrap p-0 bg-dark" style="background-color: #292961">
          <a class="navbar-brand ml-2" href="/">
            <span class="mr-2">
              <svg class="svg-inline--fa fa-cloud fa-w-20" aria-hidden="true" data-prefix="far" data-icon="cloud" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M272 80c53.473 0 99.279 32.794 118.426 79.363C401.611 149.793 416.125 144 432 144c35.346 0 64 28.654 64 64 0 11.829-3.222 22.9-8.817 32.407A96.998 96.998 0 0 1 496 240c53.019 0 96 42.981 96 96s-42.981 96-96 96H160c-61.856 0-112-50.144-112-112 0-56.428 41.732-103.101 96.014-110.859-.003-.381-.014-.76-.014-1.141 0-70.692 57.308-128 128-128m0-48c-84.587 0-155.5 59.732-172.272 139.774C39.889 196.13 0 254.416 0 320c0 88.374 71.642 160 160 160h336c79.544 0 144-64.487 144-144 0-61.805-39.188-115.805-96.272-135.891C539.718 142.116 491.432 96 432 96c-7.558 0-15.051.767-22.369 2.262C377.723 58.272 328.091 32 272 32z"></path></svg>
            </span>
            {{ config('app.name') }}
          </a>
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
                  @auth
                    <a class="nav-link" href="/admin/roles"><i class="fas fa-wrench"></i> <span class="sr-only">(current)</span></a>
                  @endauth
                </li>
              </ul>
              <form class="form-inline mt-2 mt-md-0">
                <!--<button class="btn btn-light my-2 my-sm-0" type="submit" style="margin-right: 10px">Search</button>-->

                @if (Route::has('login'))
                  @auth
                      <a class="btn btn-light my-2 my-sm-0" href="{{ url('/dashboard') }}">
                      <span class="mr-2">
                        <svg class="svg-inline--fa fa-user-circle fa-w-16" aria-hidden="true" data-prefix="fal" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 32c119.293 0 216 96.707 216 216 0 41.286-11.59 79.862-31.684 112.665-12.599-27.799-38.139-43.609-56.969-48.989L350.53 310.3C372.154 286.662 384 256.243 384 224c0-70.689-57.189-128-128-128-70.691 0-128 57.192-128 128 0 32.243 11.846 62.662 33.471 86.299l-32.817 9.376c-18.483 5.281-44.287 20.974-56.979 48.973C51.586 335.849 40 297.279 40 256c0-119.293 96.707-216 216-216zm0 280c-53.02 0-96-42.981-96-96s42.98-96 96-96 96 42.981 96 96-42.98 96-96 96zm0 152c-63.352 0-120.333-27.274-159.844-70.72 1.705-23.783 18.083-44.206 41.288-50.836l54.501-15.572C211.204 346.041 233.143 352 256 352s44.796-5.959 64.054-17.127l54.501 15.572c23.205 6.63 39.583 27.053 41.288 50.836C376.333 444.726 319.352 472 256 472z"></path></svg>
                      </span>
                      {{ Auth::user()->name }}</a>
                  @else
                      <a class="btn btn-light my-2 my-sm-0" href="{{ route('login') }}">Login / Register</a>
                  @endauth
                @endif

              </form>
            </div>
        </nav>
    </header>
