@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@section('javascripts')
<script src="{{ mix('/js/mix/projects.js') }}"></script>
@endsection

@section ('content')
<div class="row justify-content-center">
    <div class="col-9">
        <h1 class="h2" style="font-weight: 300">
            <svg class="octicon" width="24px" height="32px" viewBox="0 0 12 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <!-- Generator: Sketch 40.3 (33839) - http://www.bohemiancoding.com/sketch -->
                <title>repo</title>
                <desc>Created with Sketch.</desc>
                <defs></defs>
                <g id="Octicons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="repo" fill="#000000">
                        <path d="M4,9 L3,9 L3,8 L4,8 L4,9 L4,9 Z M4,6 L3,6 L3,7 L4,7 L4,6 L4,6 Z M4,4 L3,4 L3,5 L4,5 L4,4 L4,4 Z M4,2 L3,2 L3,3 L4,3 L4,2 L4,2 Z M12,1 L12,13 C12,13.55 11.55,14 11,14 L6,14 L6,16 L4.5,14.5 L3,16 L3,14 L1,14 C0.45,14 0,13.55 0,13 L0,1 C0,0.45 0.45,0 1,0 L11,0 C11.55,0 12,0.45 12,1 L12,1 Z M11,11 L1,11 L1,13 L3,13 L3,12 L6,12 L6,13 L11,13 L11,11 L11,11 Z M11,1 L2,1 L2,10 L11,10 L11,1 L11,1 Z" id="Shape"></path>
                    </g>
                </g>
            </svg>
            {{ $project->name }}<small> by {{ $project->user->profile->name }}</small>
        </h1>
        <div class="row">
            <div class="col-12">
                <p class="lead has-emoji">New merge request</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="/projects/{{ $project->id }}/issues" method="post">

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
                                <label class="col-12 form-control-label" for="description">Description</label>
                                <div class="col-12">
                                    <textarea class="form-control" id="descriptiont" name="description" rows="6" placeholder="Content.."></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="permission">Milestone</label>
                                </div>
                                <div class="col-9">
                                    <select class="form-control" name="milestone_id" id="milestone_id">
                                        <option disabled selected value> select an option </option>
                                        @foreach ($project->milestones as $milestone)
                                            <option value="{{ $milestone->id }}">{{ $milestone->title }}</option>
                                        @endforeach
                                    </select>
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
        
    </div>
</div>


@endsection
