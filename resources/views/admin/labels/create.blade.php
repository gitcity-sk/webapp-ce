@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@section ('content')
<h1 class="display-4">Create label</h1>
<div class="row">
    <div class="col-2">
        @include('admin.sidebar')
    </div>

    <div class="col-10">
        <form class="" action="/admin/labels" method="post">

            {{ csrf_field() }}

            <div class="form-group row">
                <label class="col-12 form-control-label" for="title">Title</label>
                <div class="col-9">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Label title">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-12 form-control-label" for="color">Color</label>
                <div class="col-9">
                    <select class="form-control" id="color" name="color">
                        <option value="badge-primary">Primary</option>
                        <option value="badge-secondary">Secondary</option>
                        <option value="badge-success">Success</option>
                        <option value="badge-danger">Danger</option>
                        <option value="badge-warning">Warning</option>
                        <option value="badge-info">Info</option>
                        <option value="badge-light">Light</option>
                        <option value="badge-dark">Dark</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-12 form-control-label" for="description">Description</label>
                <div class="col-9">
                    <input type="text" class="form-control" id="description" name="description" placeholder="Label description">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Create label</button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection
