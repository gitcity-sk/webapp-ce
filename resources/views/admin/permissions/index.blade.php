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

@section ('projects-table')
<table class="table table-vcenter">
    <thead class="thead-light">
        <tr>
            <th>Name</th>
            <th>Label</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($permissions as $permission)
            <tr>
                <td style="font-weight: 600">{{ $permission->name }}</td>
                <td>{{ $permission->label }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section ('content')
<h1 class="display-4">Permissions</h1>
<div class="row">

    <div class="col-12">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-12 text-right">
            <a href="/admin/permissions/create" class="btn btn-success">Create permission</a>
            </div>
        </div>

        <div class="card">

            @yield ('projects-table')

        </div>
    </div>

</div>
@endsection
