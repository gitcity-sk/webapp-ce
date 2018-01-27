@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'pTop-5rem')

@section ('content')
<h1 class="h2" style="font-weight: 300">
<i class="far fa-book"></i>
    {{ $project->name }}<small> by {{ $project->user->profile->name }}</small>
</h1>

<div class="row">
    <div class="col-12"><p class="lead has-emoji">Issues <a href="#">Create new</a></p></div>
</div>
<div class="row">
    <div class="col-2">
        @include('projects.elements.sidebar')
    </div>
    <div class="col-10">

        <div class="row" style="margin-bottom: 10px">
            <div class="col-12 text-right">
            <a href="/projects/{{ $project->id }}/issues/new" class="btn btn-success">Create new issue</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-vcenter">
                    @foreach ($project->issues as $issue)
                    <tr>
                        <td>
                        <div class="d-flex">
                            <div>#{{ $issue->id }} <a href="/issues/{{ $issue->id }}" style="font-weight: 600" class="text-dark">{{ $issue->title }}</a> @ {{ $issue->project->name }} by {{ $issue->user->profile->name }} {{ $issue->created_at->diffForHumans() }}</div>
                            <div class="ml-auto"><i class="fas fa-comments"></i> {{ $issue->comments->count() }}</div>
                        </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

        

    </div>
</div>


@endsection
