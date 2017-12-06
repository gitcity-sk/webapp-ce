@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'pTop-5rem')

@inject('markdown', 'Parsedown')

@section ('content')
<h1 class="h2" style="font-weight: 300">
    <svg class="octicon" width="28px" height="32px" viewBox="0 0 14 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <!-- Generator: Sketch 40.3 (33839) - http://www.bohemiancoding.com/sketch -->
        <title>issue-opened</title>
        <desc>Created with Sketch.</desc>
        <defs></defs>
        <g id="Octicons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="issue-opened" fill="#000000">
                <path d="M7,2.3 C10.14,2.3 12.7,4.86 12.7,8 C12.7,11.14 10.14,13.7 7,13.7 C3.86,13.7 1.3,11.14 1.3,8 C1.3,4.86 3.86,2.3 7,2.3 L7,2.3 Z M7,1 C3.14,1 0,4.14 0,8 C0,11.86 3.14,15 7,15 C10.86,15 14,11.86 14,8 C14,4.14 10.86,1 7,1 L7,1 Z M8,4 L6,4 L6,9 L8,9 L8,4 L8,4 Z M8,10 L6,10 L6,12 L8,12 L8,10 L8,10 Z" id="Shape"></path>
            </g>
        </g>
    </svg>
    #{{ $issue->id }} {{ $issue->title }}
</h1>

<div class="row">
    <div class="col-9">
        <p class="lead has-emoji">{{ $issue->description }}</p>
        <div>
            <ul>
                @foreach ($issue->comments as $comment)
                    <li class="has-emoji">by <a href="#">{{ $comment->user->name }}</a> at {{ $comment->created_at->diffForHumans() }} {!! $markdown->text($comment->body) !!}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <p class="h6">Project</p>
                <a href="/projects/{{ $issue->project->id }}/issues">{{ $issue->project->name }}</a>
                <p class="h6">User</p>
                <a href="#">{{ $issue->user->name }}</a>
                <p class="h6">Created</p>
                {{ $issue->created_at->diffForHumans() }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-9">
        <div class="card">
            <div class="card-body">
                <form action="/issues/{{ $issue->id }}/comments" method="post">

                    {{ csrf_field() }}

                    <div class="form-group row">
                        <div class="col-12">
                            <textarea class="form-control" id="descriptiont" name="body" rows="6" placeholder="Comment body..."></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Create comment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
