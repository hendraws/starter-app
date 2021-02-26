@extends('backend.layout.master')
@section('title') home @endsection
@section('add-css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

@endsection
@section('content')

<div class="card-header">
    <h3 class="card-title">Create New Post</h3>
</div>
<!-- /.card-header -->
<!-- form start -->
<form role="form" action="{{action('PostController@update', $post->id)}}" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" placeholder="Input Title" name="title" value="{{$post->title}}">
        </div>
        <div class="form-group">
            <label for="title">Category</label>
            <select class="form-control select2bs4" style="width: 100%;" name="category_id">
                <option></option>
                @foreach($categories as $category)
                <option value="{{ $category->id}}" {{ $category->id == $post->category_id ? 'selected' : '' }}>{{ $category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tags</label>
            <select class="select2bs4" multiple="multiple" data-placeholder="Select Tag" style="width: 100%;" name="tags[]">
                @foreach($tags as $tag)
                <option value="{{ $tag->id}}" 
                    @foreach($post->tags as $val)
                    {{$val->id == $tag->id ? 'selected' : ''}}
                    @endforeach
                >{{ $tag->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" rows="3" name="content">{{$post->content}}</textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputFile" class="col-12">Image</label>
            <img src="{{ asset($post->image) }}" class="img-thumbnail" width="300px" >
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text" id="">Upload</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

@endsection
@section('add-js')
<script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass('selected').html(filename);
    });
    $('.select2').select2();
    $('.select2bs4').select2({
        placeholder: "Select Category",
        // allowClear: true,
        theme: 'bootstrap4',
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('form')
        }
    });
    CKEDITOR.replace( 'content' );
</script>
<!-- Select2 -->

@endsection