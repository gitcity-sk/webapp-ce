@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'pTop-5rem')

@section ('projects-table')
<table class="table table-vcenter">
    <thead class="thead-light">
        <tr>
            <th>Name</th>
            <th>Created</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($projects as $project)
        <tr>
            <td>
                <a href="/projects/{{ $project->id }}" style="font-weight: 600">{{ $project->user->name }} / {{ $project->name }}</a><br /><small class="has-emoji">{{ $project->description }}</small>
            </td>
            <td>{{ $project->created_at->diffForHumans() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection

@section ('content')
<h1 class="h2" style="font-weight: 300">Projects</h1>
<div class="row" style="margin-bottom: 10px">
    <div class="col-12 text-right">
    <a href="/projects/create" class="btn btn-success">Create project</a>
    </div>
</div>

<div class="card">

        @yield ('projects-table')

</div>


@endsection
