@extends ('layouts.master-with-sidebar')

@section ('layout-main-classes', 'container limit-container-width')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@section('javascripts')
<script src="{{ mix('/js/mix/git.bundle.js') }}"></script>
@endsection

@inject('markdown', 'Parsedown')

@section ('sidebar-content')
<div class="context-header">
<a href="#">
    <div class="avatar-container" style="min-height: 50px">
    </div>
    <div class="sidebar-context-title">
        {{ $project->name }}
    </div>
</a>
</div>
@include('projects.elements.sidebar')
@endsection

@section ('content')
<h1 class="h2" style="font-weight: 300">
<i class="far fa-book"></i>
    {{ $project->name }}<small> by {{ $project->user->profile->name }}</small>
</h1>
<div class="row">
    <div class="col-12">
        <p class="lead has-emoji">{{ $project->description }}</p>
    </div>
</div>

<div class="row" style="margin-bottom: 3rem">
    <div class="col-12">
        <div class="row justify-content-md-center mb-3">
            <div class="col-6">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">ssh:</span>
                    </div>
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="ssh://{{ config('webapp.url') }}:{{ config('webapp.ssh_port') }}/~/{{ $project->user->name }}/{{ $project->slug }}.git">
                </div>
            </div>
        </div>

        <div class="row justify-content-md-center mb-3 border-bottom">
            <div class="col-12">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active text-secondary" href="#">Created <span class="badge badge-pill badge-secondary">{{ $project->created_at->diffForHumans() }}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="/projects/{{ $project->id }}/issues">Issues <span class="badge badge-pill badge-secondary">{{ $project->issues->count() }}</span></a>
                    </li>
                </ul>
            </div>
        </div>

        @if ( false == $project->created )
            <div class="card mb-3 border-danger">
                <div class="card-body text-center">
                    <p><span class="text-danger">Project is not created on server.</span> If problem presist contact server administrator. </p>
                    <a href="/projects/{{ $project->id }}/create-on-server" class="btn btn-outline-primary">Refresh</a>
                </div>
            </div>
        @endif 

        <tree-table-component project-id="{{ $project->id }}"></tree-table-component>

    </div>
</div>
@endsection
