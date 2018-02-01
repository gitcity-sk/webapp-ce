@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@section ('content')

<div class="row justify-content-center">
    <div class="col-9">
        
    <h1 class="display-4">Create</h1>
    @include('elements.errors')

    <form action="/profiles/{{ $profile->id }}" method="POST">

        {{ method_field('PUT') }}
        {{ csrf_field() }}

        <div class="row">
            <div class="col-6">
                <div class="form-group row">
                    <label class="col-12 form-control-label" for="name">Name</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Project name" value="{{ $profile->name }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-12 form-control-label" for="twitter">Twitter</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Twitter username" value="{{ $profile->twitter }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-12 form-control-label" for="facebook">Facebook</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook username" value="{{ $profile->facebook }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 form-control-label" for="description">Description</label>
            <div class="col-12"> 
                <textarea class="form-control" id="descriptiont" name="description" rows="6" placeholder="Content..">{{ $profile->description }}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Update profile</button>
            </div>
        </div>
    </form>

    <hr>

    <form action="/profiles/{{ $profile->id }}" method="POST" enctype="multipart/form-data">

        {{ method_field('PUT') }}
        {{ csrf_field() }}

        <div class="row">
            <div class="col-6">
                <div class="form-group row">
                    <label class="col-12 form-control-label" for="image">Image</label>
                    <div class="col-12">
                        <input type="file" class="form-control" id="image" name="image" placeholder="Project name">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Update profile</button>
            </div>
        </div>
    </form>

    </div>
</div>

@endsection