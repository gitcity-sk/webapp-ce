@extends ('layouts.pages')

@section('content')
<div class="blog-post">
    <h2 class="blog-post-title">{{ $page->title }}</h2>
    <p class="blog-post-meta">{{ $page->created_at->diffForHumans() }} <a href="/profiles/{{ $page->author->id }}">{{ $page->author->name}}</a> in <a href="/projects/{{ $page->project->id }}">{{ $page->project->name}}</a></p>

    {!! markdown()->text($page->description) !!}
</div><!-- /.blog-post -->
@endsection