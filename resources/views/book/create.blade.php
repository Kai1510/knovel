@extends('layouts.main')

@section('content')
<div class="container mt-20">
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Bạn cần nhập đủ thông tin</strong> 
            <ul>
                @foreach ($errors->all() as $error)
                    <li></li>
                @endforeach
            </ul>
        </div>
        @endif
    <form action="{{ route('books.store') }}" method="Post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                Series
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
                <div class="form-group required">
                    <label for="title" class="control-label">Tác giả</label>
                    <input type="text" class="form-control" name="author" id="author" aria-describedby="Tiêu đề" placeholder="">
                </div>
                <div class="form-group">
                    <label for="title">Họa sĩ</label>
                    <input type="text" class="form-control" name="artist" id="artist" aria-describedby="Tiêu đề" placeholder="">
                </div>
                <div class="form-group required">
                    <label for="" class="control-label">Loại truyện</label>
                    <select class="form-control" name="type" id="">
                      <option selected value="Truyện dịch">Truyện dịch</option>
                      <option value="Truyện convert">Truyện convert</option>
                      <option value="Truyện sáng tác">Truyện sáng tác</option>
                    </select>
                </div>
                <div class="form-group required">
                <label for="" class="control-label">Thể loại</label>
                    <div>
                        <label class="checkbox-inline pr-2">
                            <input type="checkbox" name="genres[]" value="1" class="mr-2">Action
                        </label>
                        <label class="checkbox-inline pr-2">
                            <input type="checkbox" name="genres[]" class="mr-2" value="2" >Drama
                        </label>
                        <label class="checkbox-inline pr-2">
                            <input class="mr-2" type="checkbox" name="genres[]" value="3">Fantasy
                        </label>
                        <label class="checkbox-inline pr-2">
                            <input class="mr-2" type="checkbox" name="genres[]" value="4">Horror
                        </label>
                    </div>
                    <div>
                        <label class="checkbox-inline pr-2">
                            <input class="mr-2" type="checkbox" name="genres[]" value="5">Sport
                        </label>
                        <label class="checkbox-inline pr-2">
                            <input class="mr-2" type="checkbox" name="genres[]" value="6">Cooking
                        </label>
                        <label class="checkbox-inline pr-2">
                            <input class="mr-2" type="checkbox" name="genres[]" value="7">Mystery
                        </label>
                        <label class="checkbox-inline pr-2">
                            <input class="mr-2" type="checkbox" name="genres[]" value="8">Adventure
                        </label>
                    </div>
                </div>
                <div class="form-group required">
                    <label for="" class="control-laber">Tóm tắt</label>
                    <textarea name="summary" id="text" cols="30" rows="10"></textarea>
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