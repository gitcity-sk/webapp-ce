@extends ('layouts.master-with-sidebar')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@inject('markdown', 'Parsedown')

@section ('sidebar-content')
@include('admin.sidebar')
@endsection

@section ('projects-table')
<table class="table table-vcenter">
    <thead class="thead-light">
        <tr>
            <th>Name</th>
            <th>Label</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $role)
            <tr>
                <td><a href="/admin/roles/{{ $role->id }}">{{ $role->name }}</a></td>
                <td>{{ $role->label }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section ('content')
<h1 class="display-4">Roles</h1>
<div class="row">

    <div class="col-12">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-12 text-right">
            <a href="/admin/roles/create" class="btn btn-success">Create role</a>
            </div>
        </div>

        <div class="card">

            @yield ('projects-table')

        </div>
    </div>

</div>
@endsection
