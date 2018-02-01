@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@section ('content')
<h1 class="h2" style="font-weight: 300">
<i class="far fa-book"></i>
    {{ $project->name }}<small> by {{ $project->user->profile->name }}</small>
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

        @if (null != $commits)
        <div class="row">
            <div class="col-12">
                <div class="card border-secondary">
                    <div class="card-header">
                        Commits
                    </div>
                    <table class="table table-hover">
                       @foreach ($commits as $commit)

                        <tr>
                            <td>
                                <strong>{{ $commit->getAuthor()->getName() }}</strong>
                                <p class="has-emoji">{{ $commit->getMessage()->__toString() }}</p>
                                <small>SHA: {{ $commit->getSha() }}</small>
                            </td>
                        </tr>


                       @endforeach
                   </table>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection
