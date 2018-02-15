@extends ('layouts.master-with-sidebar')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@inject('markdown', 'Parsedown')

@section ('sidebar-content')
@include('admin.sidebar')
@endsection

@section('javascripts')
<script src="{{ mix('/js/app.js') }}"></script>
@endsection

@section('content')

<h1 class="display-4">{{ $role->name }}</h1>
<p class="lead">{{ $role->label }}</p>

<div class="card" style="margin-bottom: 20px">
    <div class="card-header">
        Assigned permissions
    </div>
    <table class="table table-vcenter">
        @foreach($role->permissions as $permission)
        <tr>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->label }}</td>
            <td><a href="" class="text-danger">Remove</a></td>
        </tr>
        @endforeach
    </table>
</div>

<div class="card">
    <div class="card-body">
        <form class="" action="/admin/roles/{{ $role->id }}/permissions" method="post">

            {{ csrf_field() }}

            <div class="form-group row">
                <div class="col-12">
                    <label for="permission">Give permission to</label>
                </div>
                <div class="col-9">
                    <select class="form-control" name="permission_id" id="permission_id">
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-12">
                    <button type="submit" class="btn btn-success">Give permission</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
