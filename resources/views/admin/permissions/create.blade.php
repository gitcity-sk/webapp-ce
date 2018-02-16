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

@section ('content')
<h1 class="display-4">Permissions</h1>
<div class="row">

    <div class="col-12">
        <form class="" action="/admin/permissions" method="post">

            {{ csrf_field() }}

            <div class="form-group row">
                <label class="col-12 form-control-label" for="name">Name</label>
                <div class="col-9">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Project name">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-12 form-control-label" for="name">Label</label>
                <div class="col-9">
                    <input type="text" class="form-control" id="label" name="label" placeholder="Permission label">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Create permission</button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection
