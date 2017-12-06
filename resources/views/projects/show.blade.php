@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'pTop-5rem')

@inject('markdown', 'Parsedown')

@section ('content')
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
    {{ $project->name }}<small> by {{ $project->user->name }}</small>
</h1>
<div class="row">
    <div class="col-12">
        <p class="lead has-emoji">{{ $project->description }}</p>
    </div>

</div>

<div class="row" style="margin-bottom: 3rem">
    <div class="col-2">
    @include('projects.elements.sidebar')
    </div>
    <div class="col-10">
        <div class="row" style="padding-bottom: 15px">
            <div class="col-12">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">ssh://localhost:8080/</span>
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{ $project->user->name }}/{{ $project->slug }}.git">
                </div>
            </div>
        </div>

        <div class="row" style="padding-bottom: 15px">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">Issues</div>
                    <div class="card-body text-center"><p class="h2">{{ $project->issues->count() }}</p></div>
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-header">Created at</div>
                    <div class="card-body text-center"><p class="h2">{{ $project->created_at->diffForHumans() }}</p></div>
                </div>
            </div>
        </div>

        @if (null != $tree)
        <div class="row">
            <div class="col-12">
                <div class="card border-secondary">
                    <div class="card-header has-emoji">
                        {{ $tree->getLastCommitMessage() }}
                    </div>
                    <table class="table table-hover">
                       @foreach ($tree as $treeObject)
                           <tr>
                           <td>
                               @if ($treeObject->getType() == 'tree')
                               <svg class="octicon" width="14px" height="16px" viewBox="0 0 14 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <!-- Generator: Sketch 40.3 (33839) - http://www.bohemiancoding.com/sketch -->
                                    <title>file-directory</title>
                                    <desc>Created with Sketch.</desc>
                                    <defs></defs>
                                    <g id="Octicons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="file-directory" fill="#000000">
                                            <path d="M13,4 L7,4 L7,3 C7,2.34 6.69,2 6,2 L1,2 C0.45,2 0,2.45 0,3 L0,13 C0,13.55 0.45,14 1,14 L13,14 C13.55,14 14,13.55 14,13 L14,5 C14,4.45 13.55,4 13,4 L13,4 Z M6,4 L1,4 L1,3 L6,3 L6,4 L6,4 Z" id="Shape"></path>
                                        </g>
                                    </g>
                                </svg>
                                @else
                                <svg class="octicon" height="16" width="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 16">
                                    <path d="M6 5H2v-1h4v1zM2 8h7v-1H2v1z m0 2h7v-1H2v1z m0 2h7v-1H2v1z m10-7.5v9.5c0 0.55-0.45 1-1 1H1c-0.55 0-1-0.45-1-1V2c0-0.55 0.45-1 1-1h7.5l3.5 3.5z m-1 0.5L8 2H1v12h10V5z" />
                                </svg>
                                @endif

                               {{ $treeObject->getName() }}
                           </td>
                           <td class="has-emoji">
                               <strong>{{ $treeObject->getLastCommit()->getAuthor()->getName() }}</strong> {{ $treeObject->getLastCommit()->getMessage() }}
                           </td>
                           </tr>
                       @endforeach
                   </table>
                </div>
            </div>
        </div>
        @endif

        @if (null != $readme)
        <div class="card" style="margin-top: 15px">
            <div class="card-header">
                README
            </div>
            <div class="card-body">
                {!! $markdown->text($readme) !!}
            </div>
        </div>
        @endif

    </div>
</div>
@endsection
