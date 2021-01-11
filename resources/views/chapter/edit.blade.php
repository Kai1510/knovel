@extends('layouts.main')

@section('content')
<div class="container mt-20">
    <form action="{{ route('chapter.update', [$c->vol->book_id, $c->vol->id, $c->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                Sửa chương {{$c->title}} cho vol {{$c->vol->title}} truyện {{$c->vol->book->title}}
            </div>
            <div class="card-body">
                <div class="form-group required">
                    <label for="title" class="control-label">Tiêu đề chương</label>
                    <input type="text" class="form-control" name="title" id="title" aria-describedby="Tiêu đề" placeholder="Tiêu đề" value="{{$c->title}}">
                </div>
                <div class="form-group required">
                    <label for="" class="control-laber">Nội dung</label>
                    <textarea name="content" id="text" cols="10" rows="10">{!!$c->content!!}</textarea>
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