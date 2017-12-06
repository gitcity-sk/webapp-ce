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
  <body class="@yield ('layout-body-classes')">

    @include ('elements.header')

    <main role="main" id="app" class="@yield ('layout-main-classes')">

      @yield ('content')


      <!-- FOOTER -->

    </main>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/app.js"></script>
  </body>
</html>
