@extends ('layouts.master-with-sidebar')

@section ('layout-main-classes', 'container limit-container-width')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@section ('sidebar-content')
<div class="context-header">
<a href="/projects/{{ $project->id }}">
    <div class="avatar-container" style="min-height: 50px">
    </div>
    <div class="sidebar-context-title">
        {{ $project->name }}
    </div>
</a>
</div>
@include('cms.elements.sidebar')
@endsection

@section('javascripts')
<script src="{{ mix('/js/mix/cms.js') }}"></script>
@endsection

@section ('content')
<h1 class="h2" style="font-weight: 300">
    Pages
</h1>

<div class="row">
    <div class="col-12">
        <p class="lead has-emoji">in {{ $project->name }}</p>
    </div>
</div>

<div class="row" style="margin-bottom: 10px">
    <div class="col-12 text-right">
    <a href="/-/cms/{{ $project->id }}/pages/new" class="btn btn-success">Create page</a>
    </div>
</div>

<div class="row" style="margin-bottom: 3rem">
    <div class="col-12">
        <pages-table-component project-id="{{ $project->id }}"></pages-table-component>
    </div>
</div>
@endsection
