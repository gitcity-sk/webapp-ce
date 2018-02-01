@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@section ('projects-table')
<table class="table table-vcenter">
    <thead class="thead-light">
        <tr>
            <th>Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td><a href="/admin/users/{{ $user->id }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section ('content')
<h1 class="display-4">Users</h1>
<div class="row">
    <div class="col-2">
        @include('admin.sidebar')
    </div>

    <div class="col-10">
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
