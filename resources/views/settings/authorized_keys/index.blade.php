@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'pTop-5rem')

@section ('projects-table')
<table class="table table-vcenter">
    <thead class="thead-light">
        <tr>
            <th>Title</th>
            <th>Created</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($authorizedKeys as $authorizedKey)
            <tr>
                <td>{{ $authorizedKey->title }}</td>
                <td>{{ $authorizedKey->created_at->diffForHumans() }} <a href="/settings/authorized-keys/{{ $authorizedKey->id }}/delete">Remove</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section ('content')
<h1 class="display-4">My Authorized keys</h1>
<div class="row" style="margin-bottom: 10px">
    <div class="col-12 text-right">
    <a href="/projects/create" class="btn btn-success">Create project</a>
    </div>
</div>

<div class="row" style="margin-bottom: 15px">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="/settings/authorized-keys" method="post">

                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group row">
                                <label class="col-12 form-control-label" for="title">Title</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Issue title">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12 form-control-label" for="public_key">Public key</label>
                        <div class="col-12">
                            <textarea class="form-control" id="public_key" name="public_key" rows="6" placeholder="Content.."></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Create issue</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">

        @yield ('projects-table')

</div>


@endsection
