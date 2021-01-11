@extends('layouts.main')

@section('content')
<div class="container mt-20">
    <form action="{{ route('vol.new', [$id]) }}" method="Post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                Thêm volume
            </div>
            <div class="card-body">
                <div class="form-group required">
                    <label for="title" class="control-label">Tiêu đề</label>
                    <input type="text" class="form-control" name="title" id="title" aria-describedby="Tiêu đề" placeholder="Tiêu đề">
                </div>
                <div class="form-group">
                    <label for="img">Ảnh bìa</label>
                    <input type="file" class="form-control-file" name="img" id="img">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
<script src={{ url('ckeditor/ckeditor.js') }}></script>
<script>
    CKEDITOR.replace('text', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
@include('ckfinder::setup')
@endsection