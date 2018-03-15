@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@section('javascripts')
<script src="{{ mix('/js/mix/spaces.bundle.js') }}"></script>
@endsection

@section ('projects-table')
<space-browser space-id="{{ $space->id }}" path="{{ $path }}"></space-browser>
@endsection

@section ('content')
<h1 class="h2" style="font-weight: 300">{{ $space->name }}</h1>
@auth
<div class="row" style="margin-bottom: 10px">
    <div class="col-12 text-right">
    <a href="/projects/create" class="btn btn-success">@lang('messages.create_project')</a>
    </div>
</div>
@endauth


@yield ('projects-table')



@endsection
