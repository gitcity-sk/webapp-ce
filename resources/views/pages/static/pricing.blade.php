@extends('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@section('javascripts')
<script src="{{ mix('/js/mix/app.js') }}"></script>
@endsection

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

<div class="row">
    <div class="col-md-12">
    
    <div class="card mb-4 box-shadow">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">Projects</h4>
        </div>
        <table class="table table-hover">
            <tr>
                <td>Private git repositories</td>
                <td class="text-right">
                <span class="badge badge-success">Free</span>
                <span class="badge badge-primary">Starter</span>
                <span class="badge badge-dark">Premium</span>
                </td>
            </tr>
            <tr>
                <td>Git repository browser</td>
                <td class="text-right">
                <span class="badge badge-success">Free</span>
                <span class="badge badge-primary">Starter</span>
                <span class="badge badge-dark">Premium</span>
                </td>
            </tr>
            <tr>
                <td>Issues tracker</td>
                <td class="text-right">
                <span class="badge badge-success">Free</span>
                <span class="badge badge-primary">Starter</span>
                <span class="badge badge-dark">Premium</span>
                </td>
            </tr>
            <tr>
                <td>Merge requests preview</td>
                <td class="text-right">
                <span class="badge badge-success">Free</span>
                <span class="badge badge-primary">Starter</span>
                <span class="badge badge-dark">Premium</span>
                </td>
            </tr>
        </table>
    </div>

    <div class="card mb-4 box-shadow">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">Spaces</h4>
        </div>
        <table class="table table-hover">
            <tr>
                <td>Public Spaces</td>
                <td class="text-right">
                <span class="badge badge-success">Free</span>
                <span class="badge badge-primary">Starter</span>
                <span class="badge badge-dark">Premium</span>
                </td>
            </tr>
            <tr>
                <td>Web space browser</td>
                <td class="text-right">
                    <span class="badge badge-success">Free</span>
                    <span class="badge badge-primary">Starter</span>
                    <span class="badge badge-dark">Premium</span>
                </td>
            </tr>
            <tr>
                <td>Secure files links</td>
                <td class="text-right">
                <span class="badge badge-success">Free</span>
                <span class="badge badge-primary">Starter</span>
                <span class="badge badge-dark">Premium</span>
                </td>
            </tr>
            <tr>
                <td>Filtering files by extension</td>
                <td class="text-right">
                <span class="badge badge-success">Free</span>
                <span class="badge badge-primary">Starter</span>
                <span class="badge badge-dark">Premium</span>
                </td>
            </tr>
            <tr>
                <td>Private Spaces</td>
                <td class="text-right">
                <span class="badge badge-primary">Starter</span>
                <span class="badge badge-dark">Premium</span>
                </td>
            </tr>
            <tr>
                <td>Temporary files links for sharing</td>
                <td class="text-right">
                    <span class="badge badge-primary">Starter</span>
                    <span class="badge badge-dark">Premium</span>
                </td>
            </tr>
        </table>
    </div>

    <div class="card mb-4 box-shadow">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">Groups</h4>
        </div>
        <table class="table table-hover">
            <tr>
                <td>Public groups with projects</td>
                <td class="text-right">
                <span class="badge badge-success">Free</span>
                <span class="badge badge-primary">Starter</span>
                <span class="badge badge-dark">Premium</span>
                </td>
            </tr>
            <tr>
                <td>Epics</td>
                <td class="text-right">
                <span class="badge badge-dark">Premium</span>
                </td>
            </tr>
        </table>
    </div>

    <div class="card mb-4 box-shadow">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">Pages</h4>
        </div>
        <table class="table table-hover">
            <tr>
                <td>Create pages</td>
                <td class="text-right">
                    <span class="badge badge-success">Free</span>
                    <span class="badge badge-primary">Starter</span>
                    <span class="badge badge-dark">Premium</span>
                </td>
            </tr>
        </table>
    </div>

    </div>
</div>

@endsection