@extends('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'pTop-5rem')

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
        <h1 class="card-title pricing-card-title"><i class="fas fa-euro-sign"></i>0 <small class="text-muted">/ mo</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
            <li>Projects</li>
            <li>Groups</li>
            <li>Spaces</li>
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button>
        </div>
    </div>
    <div class="card mb-4 box-shadow">
        <div class="card-header">
        <h4 class="my-0 font-weight-normal">Starter</h4>
        </div>
        <div class="card-body">
        <h1 class="card-title pricing-card-title"><i class="fas fa-euro-sign"></i>1.20 <small class="text-muted">/ mo</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
            <li>All from free plus</li>
            <li>Epics</li>
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
        </div>
    </div>
    <div class="card mb-4 box-shadow">
        <div class="card-header">
        <h4 class="my-0 font-weight-normal">Early adopter</h4>
        </div>
        <div class="card-body">
        <h1 class="card-title pricing-card-title"><i class="fas fa-euro-sign"></i>57 <small class="text-muted">one time</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
            <li>All from Starter</li>
            <li>Awailable until august 2018</li>
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
        </div>
    </div>
</div>

@endsection