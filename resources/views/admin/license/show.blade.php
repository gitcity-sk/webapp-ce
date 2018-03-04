@extends ('layouts.master-with-sidebar')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@inject('markdown', 'Parsedown')

@section ('sidebar-content')
@include('admin.sidebar')
@endsection

@section('javascripts')
<script src="{{ mix('/js/mix/license.bundle.js') }}"></script>
@endsection

@section ('content')
<h1 class="display-4">License</h1>
<div class="row">

    <div class="col-12">

        @if ($license)

        <div class="row mb-3">
            <div class="col-md-6">

            <div class="card mb-3">
                <div class="card-header">
                    Licensed to
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Name: <strong>{{ $license->licensee->name }}</strong></li>
                    <li class="list-group-item">Email: <strong>{{ $license->licensee->email }}</strong></li>
                    <li class="list-group-item">Company: <strong>{{ $license->licensee->company }}</strong></li>
                </ul>
            
            </div>

            <div class="card">
                <div class="card-header">
                    Details
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Plan: <strong>{{ $license->type }}</strong></li>
                    <li class="list-group-item">Started: <strong>{{ $license->started_at->diffForHumans()  }}</strong></li>
                    <li class="list-group-item">Expires in: <strong>{{ $license->expires_at->diffForHumans()  }}</strong></li>
                </ul>
            
            </div>

            </div>
            <div class="col-md-6">

                <div class="card border-danger">
                <div class="card-header bg-danger text-white">Delete license</div>
                <div class="card-body">
                    <p class="card-text">If you remove license Webapp fill falback to free edition and you will not be able to use licensed features</p>
                    <delete-button url="/admin/license/delete" redirect="/admin/license"></delete-button>
                </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
            
            <div class="card">
                <div class="card-header">
                    Users in license
                </div>

                <div class="card-body text-center">
                    <h5>{{ $license->max_users_count }}</h5>
                </div>
            
            </div>

            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
        </div>

        @else

        <form action="/admin/license/upload" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

            <div class='row'>
                <div class="col-6">
                    <div class="form-group row">
                    <label class="col-12 form-control-label" for="webapp_license">License file</label>
                        <div class="col-12">
                            <input type="file" class="form-control" id="webapp_license" name="webapp_license" placeholder=".license_encryption_key">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Upload license</button>
                </div>
            </div>

        </form>

        @endif

    </div>

</div>
@endsection
