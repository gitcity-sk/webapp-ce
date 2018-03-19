@extends ('layouts.master-with-sidebar')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@inject('markdown', 'Parsedown')

@section ('sidebar-content')
@include('admin.sidebar')
@endsection

@section('javascripts')
<script src="{{ mix('/js/mix/passport.bundle.js') }}"></script>
@endsection

@section ('content')
<h1 class="display-4">OAuth - Passport</h1>
<div class="row">

    <div class="col-12">
        <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>
        <passport-personal-access-tokens></passport-personal-access-tokens>
    </div>

</div>
@endsection
