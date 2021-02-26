@extends('backend.layout.master')
@section('title','Category Page')
@section('add-css')@endsection

@section('content')
<div class="card-header">
    <h3 class="card-title">List Categories</h3>
</div>
<div class="row mr-3 mt-3 ">
    <div class="col-md-12">
        <a class="btn btn-primary btn-sm float-right  modal-button" href="Javascript:void(0)" data-mode="Lg" data-target="ModalForm" data-url="{{ action('CategoryController@create') }}" data-toggle="tooltip" data-placement="top" title="Add"><i class="fa fa-fw fa-plus mr-2"></i><span>Add Category</span></a>
    </div>
</div>
<!-- /.card-header -->
<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name}}</td>
                <td>{{ $category->slug}}</td>
                <td class="text-center">
                    <a class="btn btn-warning btn-sm modal-button" href="Javascript:void(0)" data-mode="Lg" data-target="ModalForm" data-url="{{ action('CategoryController@edit', $category->id) }}" data-toggle="tooltip" data-placement="left" title="edit"><i class="fas fa-fw fa-edit"></i></a>
                    <a href="#" class="btn btn-danger btn-sm delete" data-id="{{$category->id}}" data-url="{{ action('CategoryController@delete', $category->id) }}" ><i class="fas fa-fw fa-trash-alt"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
<!-- /.card-body -->
@endsection
@section('add-js')
<script>
    $(function() {
        $("#example1").DataTable({
            "columnDefs": [{
                "width": "15%",
                "targets": 2
            }]
        });
    });

    $('#ModalForm').on('shown.bs.modal', function() {
        console.log('asdf');
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.delete', function() {
        var url = $(this).attr('data-url');
        swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            })
            .then((willDelete) => {
                console.log(willDelete);
                if (willDelete.value) {
                    window.location = url;
                }
            });
    });
</script>
@endsection