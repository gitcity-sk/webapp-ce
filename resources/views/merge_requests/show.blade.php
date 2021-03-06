@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@inject('markdown', 'Parsedown')

@section('javascripts')
<script src="{{ mix('/js/mix/app.js') }}"></script>
@endsection

@section ('content')
<h1 class="h2" style="font-weight: 300">
    <svg class="octicon" width="24px" height="32px" viewBox="0 0 12 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <!-- Generator: Sketch 40.3 (33839) - http://www.bohemiancoding.com/sketch -->
        <title>git-pull-request</title>
        <desc>Created with Sketch.</desc>
        <defs></defs>
        <g id="Octicons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="git-pull-request" fill="#000000">
                <path d="M11,11.28 L11,5 C10.97,4.22 10.66,3.53 10.06,2.94 C9.46,2.35 8.78,2.03 8,2 L7,2 L7,0 L4,3 L7,6 L7,4 L8,4 C8.27,4.02 8.48,4.11 8.69,4.31 C8.9,4.51 8.99,4.73 9,5 L9,11.28 C8.41,11.62 8,12.26 8,13 C8,14.11 8.89,15 10,15 C11.11,15 12,14.11 12,13 C12,12.27 11.59,11.62 11,11.28 L11,11.28 Z M10,14.2 C9.34,14.2 8.8,13.65 8.8,13 C8.8,12.35 9.35,11.8 10,11.8 C10.65,11.8 11.2,12.35 11.2,13 C11.2,13.65 10.65,14.2 10,14.2 L10,14.2 Z M4,3 C4,1.89 3.11,1 2,1 C0.89,1 0,1.89 0,3 C0,3.73 0.41,4.38 1,4.72 L1,11.28 C0.41,11.62 0,12.26 0,13 C0,14.11 0.89,15 2,15 C3.11,15 4,14.11 4,13 C4,12.27 3.59,11.62 3,11.28 L3,4.72 C3.59,4.38 4,3.74 4,3 L4,3 Z M3.2,13 C3.2,13.66 2.65,14.2 2,14.2 C1.35,14.2 0.8,13.65 0.8,13 C0.8,12.35 1.35,11.8 2,11.8 C2.65,11.8 3.2,12.35 3.2,13 L3.2,13 Z M2,4.2 C1.34,4.2 0.8,3.65 0.8,3 C0.8,2.35 1.35,1.8 2,1.8 C2.65,1.8 3.2,2.35 3.2,3 C3.2,3.65 2.65,4.2 2,4.2 L2,4.2 Z" id="Shape"></path>
            </g>
        </g>
    </svg>
    #{{ $mergeRequest->id }} {{ $mergeRequest->title }}
</h1>

<div class="row">
    <div class="col-9">
        <p class="lead has-emoji">{{ $mergeRequest->description }}</p>

        <div class="card border-success mb-3">
            <div class="card-header text-white bg-success">
                Merge {{ $mergeRequest->branch_from }} into {{ $mergeRequest->branch_to }}
            </div>
            <div class="card-body">
                Only manual merge available
            </div>
        </div>


        <table class="table table-sm">
            @foreach ($diff as $diffObject)    
                <tr class="{{ $diffObject->getMode() == 'new_file' ? 'table-success' : '' }}{{ $diffObject->getMode() == 'deleted_file' ? 'table-danger' : '' }}">
                    <td>
                        <div class="d-flex align-items-center">
                            <div>{{ $diffObject->getOriginalPath() }}</div>
                            <div class="ml-auto text-right">{{ $diffObject->count() }} changes</div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        

    </div>

    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <p class="h6">Project</p>
                <a href="/projects/{{ $mergeRequest->project->id }}/merge-requests">{{ $mergeRequest->project->name }}</a>
                <p class="h6">User</p>
                <a href="#">{{ $mergeRequest->user->name }}</a>
                <p class="h6">Created</p>
                {{ $mergeRequest->created_at->diffForHumans() }}
            </div>
        </div>
    </div>
</div>


@endsection
