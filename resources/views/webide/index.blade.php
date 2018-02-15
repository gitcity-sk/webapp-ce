@extends ('layouts.master-with-sidebar')

@section ('layout-main-classes', 'container-fluid h-100')

@section('javascripts')
<script src="{{ mix('/js/mix/ide/bundle.js') }}"></script>
@endsection

@section ('content')

<div class="row mt-5">
    <div class="col-12">
        <h3>Web ide</h3>
        <monaco-editor language="html"></monaco-editor>
    </div>
</div>

@endsection
