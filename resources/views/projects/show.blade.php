@extends ('layouts.master-with-sidebar')

@section ('layout-main-classes', 'container limit-container-width')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@section('javascripts')
<script src="{{ mix('/js/mix/git/bundle.js') }}"></script>
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
        <div class="row" style="padding-bottom: 15px">
            <div class="col-12">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">ssh://localhost:8080/</span>
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{ $project->user->name }}/{{ $project->slug }}.git">
                </div>
            </div>
        </div>

        <div class="row" style="padding-bottom: 15px">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">Issues</div>
                    <div class="card-body text-center"><p class="h2">{{ $project->issues->count() }}</p></div>
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-header">Created at</div>
                    <div class="card-body text-center"><p class="h2">{{ $project->created_at->diffForHumans() }}</p></div>
                </div>
            </div>
        </div>

        @if ( false == $project->created )
            <div class="card" style="margin-bottom: 15px">
                <div class="card-body text-center">
                    <p><span class="text-danger">Project is not created on server.</span> If problem presist contact server administrator. </p>
                    <a href="/projects/{{ $project->id }}/create-on-server" class="btn btn-outline-primary">Refresh</a>
                </div>
            </div>
        @endif        


        <div class="row text-center loading" v-if="loading">
            <div class="col">
                <div class="loader" style="margin:0 auto;"></div>
            </div>
        </div>

        <tree-table-component project-id="{{ $project->id }}"></tree-table-component>

    </div>
</div>
@endsection
