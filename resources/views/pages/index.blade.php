@extends ('layouts.pages-with-sidebar')

@section('content')
<h3 class="pb-3 mb-4 font-italic border-bottom">
    All pages
</h3>
@foreach($pages as $page)
<div class="blog-post">
    <h2 class="blog-post-title">{{ $page->title }}</h2>
    <p class="blog-post-meta">{{ $page->created_at->diffForHumans() }} <a href="/profiles/{{ $page->author->id }}">{{ $page->author->name}}</a> in <a href="/projects/{{ $page->project->id }}">{{ $page->project->name}}</a></p>
    <a href="/pages/{{ $page->id }}" class="btn btn-outline-dark btn-sm">Continue reading</a>
</div><!-- /.blog-post -->
@endforeach
<nav class="blog-pagination">
    <a class="btn btn-outline-primary" href="#">Older</a>
    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
</nav>
@endsection