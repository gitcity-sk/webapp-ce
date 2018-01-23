@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'pTop-5rem')

@inject('markdown', 'Parsedown')

@section ('content')
<profile-view-component></profile-view-component>
@endsection