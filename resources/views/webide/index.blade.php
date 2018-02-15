@extends ('layouts.master-with-sidebar')

@section ('layout-main-classes', 'container-fluid')

@section('javascripts')
<script src="{{ mix('/js/mix/ide/bundle.js') }}"></script>
@endsection

@section ('content')

<div class="row mt-5">
    <div class="col-12 mt-5" style="min-height: 82vh">
        <monaco-editor language="html"></monaco-editor>
    </div>
</div>

@endsection
