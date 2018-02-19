@extends ('layouts.master-with-sidebar')

@section ('layout-main-classes', 'container limit-container-width')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@inject('markdown', 'Parsedown')

@section ('sidebar-content')

@endsection

@section('javascripts')
<script src="{{ mix('/js/mix/groups/bundle.js') }}"></script>
@endsection

@section ('content')

<div class="row">
    <div class="col-md-12 text-center">
    <div class="text-right">
    @auth
    @if (Auth::user()->id == $group->user_id)
        <a class="btn btn-light my-2 my-sm-0" href="#">Edit</a>
    @endif
    @endauth
    </div>
        <h2 style="font-weight: 300" class="has-emoji">{{ $group->name }}</h2>
        <p class="lead has-emoji">{{ $group->description }}</p>
    </div>
</div>

@auth
@if (Auth::user()->id == $group->user_id)
<div class="d-flex flex-row">
    <div class="ml-auto">
        <form class="form-inline" action="/groups/{{ $group->id }}/projects" method="post">
        {{ csrf_field() }}
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control" id="project_id" name="project_id" placeholder="Enter project id">
            </div>
            <button type="submit" class="btn btn-outline-secondary mb-2">Add Project to group</button>
        </form>
    </div>
</div>
@endif
@endauth

<div class="row text-center loading" v-if="loading">
    <div class="col">
        <div class="loader" style="margin:0 auto;"></div>
    </div>
</div>

<group-projects-table-component group-id="{{ $group->id }}"></group-projects-table-component>

@endsection