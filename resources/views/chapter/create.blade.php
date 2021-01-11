@extends('layouts.main')

@section('content')
<div class="container mt-20">
    <form action="{{ route('chapter.new', [$v->book_id, $v->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                Thêm chương mới cho vol {{$v->title}} truyện {{$v->book->title}}
            </div>
            <div class="card-body">
                <div class="form-group required">
                    <label for="title" class="control-label">Tiêu đề chương</label>
                    <input type="text" class="form-control" name="title" id="title" aria-describedby="Tiêu đề" placeholder="Tiêu đề">
                </div>
                <div class="form-group required">
                    <label for="" class="control-laber">Nội dung</label>
                    <textarea name="content" id="text" cols="10" rows="10"></textarea>
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