@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@section ('projects-table')
<div class="row text-center loading" v-if="loading">
    <div class="col">
        <div class="loader" style="margin:0 auto;"></div>
    </div>
</div>
<projects-table-component></projects-table-component>
@endsection

@section ('content')
<h1 class="h2" style="font-weight: 300">Projects</h1>
@auth
<div class="row" style="margin-bottom: 10px">
    <div class="col-12 text-right">
    <a href="/projects/create" class="btn btn-success">Create project</a>
    </div>
</div>
@endauth


@yield ('projects-table')



@endsection
