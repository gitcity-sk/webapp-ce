@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@inject('markdown', 'Parsedown')

@section('javascripts')
<script src="{{ mix('/js/mix/issues.bundle.js') }}"></script>
@endsection

@section ('content')
<h1 class="h2" style="font-weight: 300">
    #{{ $issue->id }} {{ $issue->title }}
</h1>

<div class="row">
    <div class="col-9">
    @if (false == $issue->complete)
    <span class="badge badge-success font-weight-normal px-2 py-2 mr-1" style="font-size: 1em">Open</span>
    @else
    <span class="badge badge-danger font-weight-normal px-2 py-2 mr-1" style="font-size: 1em">Closed</span>
    @endif 
    opened {{ $issue->created_at->diffForHumans() }} by <a class="text-dark" href="/profiles/{{ $issue->user->profile->id }}">{{ $issue->user->profile->name }}</a><hr />
        <div class="has-emoji">{!! markdown()->text($issue->description) !!}</div>

        <div class="card mb-3">
            <div class="card-header">
                To start create new branch
            </div>
            <div class="card-body">
                git checkout -b {{ $issue->id }}-my-new-branch
            </div>
        </div>

        @foreach ($issue->comments as $comment)
        <div class="card mb-4">
            <div class="card-header has-emoji">
                <i class="far fa-comment"></i>
                <a href="/profiles/{{ $comment->user->profile->id }}">{{ $comment->user->profile->name }}</a> at {{ $comment->created_at->diffForHumans() }}
            </div>
            <div class="card-body has-emoji">
                {!! markdown()->text($comment->body) !!}
            </div>

        </div>
        @endforeach

    </div>

    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <p class="h6">Project</p>
                <a href="/projects/{{ $issue->project->id }}/issues">{{ $issue->project->name }}</a>
                @if (null !== $issue->milestone)
                    <p class="h6">Milestone</p>
                    {{ $issue->milestone->title }}
                @endif
                <p class="h6">User</p>
                <a href="/profiles/{{ $issue->user->profile->id }}">{{ $issue->user->profile->name }}</a>
                <p class="h6">Created</p>
                {{ $issue->created_at->diffForHumans() }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-9">

        @if ($issue->complete == false)
            <form action="/issues/{{ $issue->id }}/comments" method="post">

                {{ csrf_field() }}

                <div class="form-group row">
                    <div class="col-12">
                        <!--<textarea class="form-control" id="descriptiont" name="body" rows="6" placeholder="Comment body..."></textarea>-->
                        <markdown-ed model-name="body"></markdown-ed>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Create comment</button>
                        <close-button issue-id="{{ $issue->id }}" redirect="/issues/{{ $issue->id }}"></close-button>
                    </div>
                </div>
            </form>
        @else
            <div class="card">
                <div class="card-body">
                    <reopen-button issue-id="{{ $issue->id }}" redirect="/issues/{{ $issue->id }}"></close-reopen>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
