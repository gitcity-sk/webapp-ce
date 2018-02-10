<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GitCity</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/app.css" rel="stylesheet">

  </head>
  <body>

    @include ('elements.header')

    <div id="app" class="wrapper toggled">

      <div class="sidebar-wrapper bg-light nav-sidebar">
        @yield ('sidebar-content')
      </div>

      <div class="page-content-wrapper @yield ('layout-body-classes')">

        <main role="main" class="@yield ('layout-main-classes')" v-cloak>
          @yield ('content')
        </main>

      </div>
    </div>
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/app.js"></script>
  </body>
</html>
