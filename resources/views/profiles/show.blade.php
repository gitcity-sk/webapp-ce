@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@section('javascripts')
<script src="{{ mix('/js/mix/profiles.bundle.js') }}"></script>
@endsection

@inject('markdown', 'Parsedown')

@section ('content')

<div class="row">
    <div class="text-right">
        @auth
        @if (Auth::user()->id == $profile->user_id)
            <a class="btn btn-light my-2 my-sm-0" href="/profiles/{{ $profile->id }}/edit">Edit</a>
        @endif
        @endauth
    </div>
    
    <profile-view profile-id="{{ $profile->id }}"></profile-view>
</div>

<div class="row text-center loading" v-if="loading">
    <div class="col">
        <div class="loader" style="margin:0 auto;"></div>
    </div>
</div>

<user-projects-table-component user-id="{{ $profile->user_id }}"></user-projects-table-component>

@endsection