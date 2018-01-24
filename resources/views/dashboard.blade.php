@extends('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'pTop-5rem')

@section('content')

<h1 class="h2" style="font-weight: 300">
    {{ Auth::user()->profile->name }} <small>{{ Auth::user()->name }}</small> {{ Auth::user()->profile->verified ? 'verified' : ''}}
</h1>

<p class="lead">
This is your homepage. <a href="/logout">Logout</a>
</p>

<a href="/projects">Projects</a>
<a href="/settings/authorized-keys">Authorized keys</a>
<a href="/profiles/{{ Auth::user()->profile->id }}">Profile</a>

@endsection
