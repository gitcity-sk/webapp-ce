@extends('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@section('content')

<div class="row">
    <div class="col-md-12 text-center">
        <h1 class="display-4">Pricing</h1>
        <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It's built with default Bootstrap components and utilities with little customization.</p>
    </div>
</div>

<div class="card-deck mb-3 text-center">
    <div class="card mb-4 box-shadow">
        <div class="card-header">
        <h4 class="my-0 font-weight-normal">Free</h4>
        </div>
        <div class="card-body">
        <h1 class="card-title pricing-card-title"><i class="fas fa-euro-sign"></i>0 <small class="text-muted">per year</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
            <li>Host on your server</li>
            <li>Projects</li>
            <li>Groups</li>
            <li>Issue tracker</li>
        </ul>
        <a href="/register" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</a>
        </div>
    </div>
    <div class="card mb-4 box-shadow">
        <div class="card-header">
        <h4 class="my-0 font-weight-normal">Starter</h4>
        </div>
        <div class="card-body">
        <h1 class="card-title pricing-card-title"><i class="fas fa-euro-sign"></i>27 <small class="text-muted">per year</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
            <li>All from free plus</li>
            <li>Multiple boards</lI>
            <li>Spaces</li>
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
        </div>
    </div>
    <div class="card mb-4 box-shadow">
        <div class="card-header">
        <h4 class="my-0 font-weight-normal">Premium</h4>
        </div>
        <div class="card-body">
        <h1 class="card-title pricing-card-title"><i class="fas fa-euro-sign"></i>54 <small class="text-muted">per year</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
            <li>All from Starter</li>
            <li>Epics</li>
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
        </div>
    </div>
</div>

@endsection