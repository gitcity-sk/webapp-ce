@extends ('layouts.master')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'pTop-5rem')

@section ('projects-table')
<div class="row text-center loading" v-if="loading">
    <div class="col">
        <div class="loader" style="margin:0 auto;"></div>
    </div>
</div>
<groups-table-component></groups-table-component>
@endsection

@section ('content')
<h1 class="h2" style="font-weight: 300">Groups</h1>
@auth
<div class="row" style="margin-bottom: 10px">
    <div class="col-12 text-right">
    <a href="/groups/create" class="btn btn-success">Create group</a>
    </div>
</div>
@endauth

@yield ('projects-table')



@endsection
