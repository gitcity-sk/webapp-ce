@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@inject('markdown', 'Parsedown')

@section('javascripts')
<script src="{{ mix('/js/mix/milestones.bundle.js') }}"></script>
@endsection

@section ('content')
<h1 class="h2" style="font-weight: 300">
    <svg class="svg-inline--fa fa-map-signs fa-w-16" aria-hidden="true" data-prefix="far" data-icon="map-signs" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M424 192a24 24 0 0 0 16.971-7.029l56-56c9.372-9.373 9.372-24.569 0-33.941l-56-56A23.997 23.997 0 0 0 424 32H280V12c0-6.627-5.373-12-12-12h-24c-6.627 0-12 5.373-12 12v20H56c-13.255 0-24 10.745-24 24v112c0 13.255 10.745 24 24 24h176v32H88a24 24 0 0 0-16.971 7.029l-56 56c-9.372 9.373-9.372 24.568 0 33.941l56 56A23.997 23.997 0 0 0 88 384h144v116c0 6.627 5.373 12 12 12h24c6.627 0 12-5.373 12-12V384h176c13.255 0 24-10.745 24-24V248c0-13.255-10.745-24-24-24H280v-32h144zm8 80v64H97.941l-32-32 32-32H432zM80 144V80h334.059l32 32-32 32H80z"></path></svg>
    {{ $milestone->title }}
</h1>

<div class="row">
    <div class="col-12">
        <p class="lead has-emoji">{{ $milestone->description }}</p>
    </div>
</div>

<div class="row mb-3">
    <div class="col-12">
        <div class="progress mb-2">
            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $completed_percentage }}%" aria-valuenow="{{ $completed_percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="text-right">
            Completed: {{ $completed_percentage }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-4">
        <open-issues-cards milestone-id="{{ $milestone->id }}"></open-issues-cards>
    </div>

    <div class="col-4">
        <open-issues-closed-cards milestone-id="{{ $milestone->id }}"></open-issues-closed-cards>
    </div>
</div>

@endsection
