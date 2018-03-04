@extends ('layouts.master-with-sidebar')

@section ('layout-main-classes', 'container-fluid')

@section('javascripts')
<script src="{{ mix('/js/mix/ide.bundle.js') }}"></script>
@endsection

@section ('content')

<editor></editor>

@endsection
