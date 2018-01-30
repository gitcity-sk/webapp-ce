@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'pTop-5rem')

@section ('content')
<h1 class="display-4">License</h1>
<div class="row">
    <div class="col-2">
        @include('admin.sidebar')
    </div>

    <div class="col-10">

        @if ($license)
            <table>
            <tr>
                <td>Started: {{ $license->started_at->diffForHumans()  }}</td>
            </tr>
            <tr>
                <td>Expires in: {{ $license->expires_at->diffForHumans()  }}</td>
            </tr>
            <tr><td>Name: <strong>{{ $license->licensee->name }}</strong></td></tr>
            <tr><td>Email: {{ $license->licensee->email }}</td></tr>
            <tr><td>Company: {{ $license->licensee->company }}</td></tr>
            <tr><td>Quantity: {{ $license->max_users_count }}</td></tr>
            <tr><td>Plan: {{ $license->type }}</td></tr>
            </table>
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
