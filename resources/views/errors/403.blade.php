@extends ('layouts.master')

@section ('layout-main-classes', 'container')

@section('javascripts')
<script src="{{ mix('/js/mix/app.js') }}"></script>
@endsection

@section ('content')

<div class="row align-items-center" style="min-height: 100vh">
    <div class="col-12 text-center">
        <h1 class="display-4">
        <i class="far fa-lock-alt"></i>
        </h1>
        <p>{{ $exception->getMessage() }}</p>
    </div>
</div>

@endsection
