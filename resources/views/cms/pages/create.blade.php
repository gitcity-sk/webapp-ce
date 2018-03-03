@extends ('layouts.master-with-sidebar')

@section ('layout-main-classes', 'container')
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
    New Page
</h1>

<div class="row">
    <div class="col-12">
        <p class="lead has-emoji">in {{ $project->name }}</p>
    </div>

</div>

<div class="row" style="margin-bottom: 3rem">
    <div class="col-12">

    <form action="/-/cms/{{ $project->id }}/pages" method="post">

    {{ csrf_field() }}

    <div class="row">
        <div class="col-6">
            <div class="form-group row">
                <label class="col-12 form-control-label" for="title">Title</label>
                <div class="col-12">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Page title">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-12 form-control-label" for="description">Body</label>
        <div class="col-9">
            <markdown-ed model-name="description"></markdown-ed>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Create page</button>
        </div>
    </div>

    </form>

    </div>
</div>
@endsection
