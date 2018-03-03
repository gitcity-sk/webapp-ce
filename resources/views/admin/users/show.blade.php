@extends ('layouts.master-with-sidebar')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@inject('markdown', 'Parsedown')

@section ('sidebar-content')
@include('admin.sidebar')
@endsection

@section('javascripts')
<script src="{{ mix('/js/mix/app.js') }}"></script>
@endsection

@section('content')

<h1 class="h2" style="font-weight: 300">{{ $user->name }}</h1>
<p class="lead">{{ $user->email }}, Member from: {{ $user->created_at->diffForHumans() }}</p>

<div class="card" style="margin-bottom: 20px">
    <div class="card-header">
        Assigned roles
    </div>
    <table class="table table-vcenter">
        @foreach($user->roles as $role)
        <tr>
            <td>{{ $role->name }}</td>
            <td>{{ $role->label }}</td>
            <td><a href="" class="text-danger">Remove</a></td>
        </tr>
        @endforeach
    </table>
</div>

<div class="card" style="margin-bottom: 20px">
    <div class="card-body">
        <form class="" action="/admin/users/{{ $user->id }}/roles" method="post">

            {{ csrf_field() }}

            <div class="form-group row">
                <div class="col-12">
                    <label for="permission">Assign role</label>
                </div>
                <div class="col-9">
                    <select class="form-control" name="role_name" id="role_name">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
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

<div class="card">
    <div class="card-header">
        Ovner of
    </div>
    <div class="card-body">
        <h4>{{ $user->projects->count() }} Projects</h4>
        @foreach ($user->projects as $project)
            <a href="/projects/{{ $project->id }}">{{ $project->name }}</a>
        @endforeach

        <h4>{{ $user->groups->count() }} Groups</h4>
        @foreach ($user->groups as $group)
            <a href="/groups/{{ $group->id }}">{{ $group->name }}</a>
        @endforeach
    </div>
</div>

@endsection
