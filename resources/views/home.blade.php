@extends('layouts.master')

@section('javascripts')
<script src="{{ mix('/js/app.js') }}"></script>
@endsection

@section ('layout-body-classes', 'mt-5 mb-3')

@section('content')
<div id="myCarousel" class="carousel slide" data-ride="carousel">
<ol class="carousel-indicators">
  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
  <li data-target="#myCarousel" data-slide-to="1"></li>
  <li data-target="#myCarousel" data-slide-to="2"></li>P
</ol>
<div class="carousel-inner">
  <div class="carousel-item active">
    <img class="first-slide" src="https://images.unsplash.com/photo-1500053857731-701d06fac2fa?auto=format&fit=crop&w=2031&q=60&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" alt="First slide">
    <div class="container">
      <div class="carousel-caption">
        <h1>18.2 Released</h1>
        <p>With pages aand spaces</p>
        <p><a class="btn btn-lg btn-primary" href="/license" role="button">Try for free</a></p>
      </div>
    </div>
  </div>
  <div class="carousel-item">
    <img class="second-slide" src="https://images.unsplash.com/photo-1414146782248-462e06300dbf?auto=format&fit=crop&w=1053&q=60&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" alt="Second slide">
    <div class="container">
      <div class="carousel-caption">
        <h1>Project management</h1>
        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
        <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
      </div>
    </div>
  </div>
  <div class="carousel-item">
    <img class="third-slide" src="https://images.unsplash.com/photo-1473101167633-bfa08e705e4b?auto=format&fit=crop&w=1050&q=60&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" alt="Third slide">
    <div class="container">
      <div class="carousel-caption">
        <h1>Issues tracker</h1>
        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
        <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
      </div>
    </div>
  </div>
</div>
<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  <span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
  <span class="carousel-control-next-icon" aria-hidden="true"></span>
  <span class="sr-only">Next</span>
</a>
</div>


<!-- Marketing messaging and featurettes
================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container marketing">

<!-- START THE FEATURETTES -->

<div class="row featurette">
  <div class="col-md-7">
    <h2 class="featurette-heading">Project management <span class="text-muted">Git repositories managemnt</span></h2>
    <p class="lead">Manage your projects</p>
  </div>
  <div class="col-md-5">
    <img class="featurette-image img-fluid mx-auto" src="/co_projects.png" alt="Generic placeholder image">
  </div>
</div>

<hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7 order-md-2">
    <h2 class="featurette-heading">Issue tracker <span class="text-muted">with comments</span></h2>
    <p class="lead">Simple issue tracking with comments</p>
  </div>
  <div class="col-md-5 order-md-1">
    <img class="featurette-image img-fluid mx-auto" src="/co_issues.png" alt="Generic placeholder image">
  </div>
</div>

<hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7">
    <h2 class="featurette-heading">Administration <span class="text-muted">With ACL.</span></h2>
    <p class="lead">Assign peermission to users trough predefined roles or create new ones</p>
  </div>
  <div class="col-md-5">
    <img class="featurette-image img-fluid mx-auto" src="/co_roles.png" alt="Generic placeholder image">
  </div>
</div>

<hr class="featurette-divider">

<!-- Three columns of text below the carousel -->
<div class="row">
  <div class="col-lg-4">
    <h2>Git Repository</h2>
    <p>Show commits, files branches and tags right on web</p>
  </div><!-- /.col-lg-4 -->

  <div class="col-lg-4">
    <h2>Private repositories</h2>
    <p>Unlimited private repositories behind firewall</p>
  </div><!-- /.col-lg-4 -->

  <div class="col-lg-4">
    <h2>Comment</h2>
    <p>Comments in issue tracker</p>
  </div><!-- /.col-lg-4 -->
</div><!-- /.row -->

<div class="row">
  <div class="col-lg-4">
    <h2>Made with PHP</h2>
    <p>Build top on PHP 7+</p>
  </div><!-- /.col-lg-4 -->

  <div class="col-lg-4">
    <h2>Self hosted</h2>
    <p>Host on your computer (Linux and Windows supported)</p>
  </div><!-- /.col-lg-4 -->

  <div class="col-lg-4">
    <h2>Open Source</h2>
    <p>Licensed with MIT license</p>
  </div><!-- /.col-lg-4 -->
</div><!-- /.row -->

<hr class="featurette-divider">

<!-- /END THE FEATURETTES -->

</div><!-- /.container -->

@include ('elements.footer')

@endsection
