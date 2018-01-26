@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'pTop-5rem')

@inject('markdown', 'Parsedown')

@section ('content')

<div class="row">
    <div class="col-md-12 text-center">
    <div class="text-right">
    @auth
    @if (Auth::user()->id == $profile->user_id)
        <a class="btn btn-light my-2 my-sm-0" href="/profiles/{{ $profile->id }}/edit">Edit</a>
    @endif
    @endauth
    </div>
        <h2 style="font-weight: 300" class="has-emoji">{{ $profile->name }}</h2>
        {{ $profile->twitter }}
        {{ $profile->facebook }}
        <p class="lead has-emoji">{{ $profile->description }}</p>
    </div>
</div>

<div class="row text-center loading" v-if="loading">
    <div class="col">
        <div class="loader" style="margin:0 auto;"></div>
    </div>
</div>

<projects-table-component></projects-table-component>

@endsection