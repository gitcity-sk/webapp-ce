@extends('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@section('javascripts')
<script src="{{ mix('/js/app.js') }}"></script>
@endsection

@section('content')

<h1 class="h2" style="font-weight: 300">
    {{ Auth::user()->profile->name }} <small>{{ Auth::user()->name }}</small> {{ Auth::user()->profile->verified ? 'verified' : ''}}
</h1>

<p class="lead">
@lang('This is your homepage.') <a href="/logout">Logout</a>
</p>

<a href="/projects">Projects</a>
<a href="/settings/authorized-keys">Authorized keys</a>
<a href="/profiles/{{ Auth::user()->profile->id }}">Profile</a>

@endsection
