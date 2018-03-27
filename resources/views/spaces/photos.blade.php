@extends ('layouts.master')

@section ('layout-main-classes', '')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@section('javascripts')
<script src="{{ mix('/js/mix/spaces.bundle.js') }}"></script>
@endsection

@section ('projects-table')
<images-browser space-id="{{ $space->id }}" path="{{ $path }}"></images-browser>
@endsection

@section ('content')
<div class="container limit-container-width">
    <h1 class="h2 mb-3" style="font-weight: 300">
        <svg class="svg-inline--fa fa-camera-retro fa-w-16" aria-hidden="true" data-prefix="fal" data-icon="camera-retro" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M32 58V38c0-3.3 2.7-6 6-6h116c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H38c-3.3 0-6-2.7-6-6zm344 230c0-66.2-53.8-120-120-120s-120 53.8-120 120 53.8 120 120 120 120-53.8 120-120zm-32 0c0 48.5-39.5 88-88 88s-88-39.5-88-88 39.5-88 88-88 88 39.5 88 88zm-120 0c0-17.6 14.4-32 32-32 8.8 0 16-7.2 16-16s-7.2-16-16-16c-35.3 0-64 28.7-64 64 0 8.8 7.2 16 16 16s16-7.2 16-16zM512 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V144c0-26.5 21.5-48 48-48h136l33.6-44.8C226.7 39.1 240.9 32 256 32h208c26.5 0 48 21.5 48 48zM224 96h240c5.6 0 11 1 16 2.7V80c0-8.8-7.2-16-16-16H256c-5 0-9.8 2.4-12.8 6.4L224 96zm256 48c0-8.8-7.2-16-16-16H48c-8.8 0-16 7.2-16 16v288c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16V144z"></path></svg>
        {{ $space->name }}
    </h1>
</div>
@auth

@endauth

<div class="theater">
    <div class="container limit-container-width">
    @yield ('projects-table')
    </div>
</div>

@endsection
