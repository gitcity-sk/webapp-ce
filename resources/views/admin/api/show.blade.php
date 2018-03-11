@extends ('layouts.master-with-sidebar')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@inject('markdown', 'Parsedown')

@section ('sidebar-content')
@include('admin.sidebar')
@endsection

@section('javascripts')
<script src="{{ mix('/js/mix/license.bundle.js') }}"></script>
@endsection

@section ('content')
<h1 class="display-4">Api Testing</h1>
<div class="row">

    <div class="col-12">
        To test your api use in your application: <pre>{{ config('app.url') }}/api/test</pre>
    </div>

</div>
@endsection
