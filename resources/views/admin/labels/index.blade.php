@extends ('layouts.master-with-sidebar')

@section ('layout-main-classes', 'container')
@section ('layout-body-classes', 'mt-5 pt-3 mb-3')

@inject('markdown', 'Parsedown')

@section ('sidebar-content')
@include('admin.sidebar')
@endsection

@section ('content')
<h1 class="display-4">Labels</h1>
<div class="row">
    <div class="col-12">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-12 text-right">
            <a href="/admin/labels/create" class="btn btn-success">Create label</a>
            </div>
        </div>

        <table class="table table-vcenter">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($labels as $label)
                    <tr>
                        <td style="width: 320px"><span class="badge {{ $label->color }}">{{ $label->title }}</span></td>
                        <td>{{ $label->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>
@endsection
