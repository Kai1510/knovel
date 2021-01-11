@extends('layouts.main')

@section('content')
<div class="container mt-20">
    <form action="{{ route('books.update', $b->id) }}" method="Post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                Series
            </div>
            <div class="card-body">
                <div class="form-group required">
                    <label for="title" class="control-label">Tiêu đề</label>
                    <input type="text" class="form-control" name="title" id="title" aria-describedby="Tiêu đề" placeholder="Tiêu đề" value="{{$b->title}}">
                </div>
                <div class="form-group">
                    <label for="img">Ảnh bìa</label>
                    <img src="{{asset("$b->img")}}" alt="">
                    <input type="file" class="form-control-file" name="img" id="img">
                </div>
                <div class="form-group required">
                    <label for="title" class="control-label">Tác giả</label>
                    <input type="text" class="form-control" name="author" id="author" aria-describedby="Tiêu đề" value="{{$b->author}}" placeholder="">
                </div>
                <div class="form-group">
                    <label for="title">Họa sĩ</label>
                    <input type="text" class="form-control" name="artist" id="artist" aria-describedby="Tiêu đề" value="{{$b->artist}}" placeholder="">
                </div>
                <div class="form-group required">
                    <label for="" class="control-label">Loại truyện</label>
                    <select class="form-control" name="type" id="">
                      <option value="Truyện dịch" 
                      @if($b->tpye=="Truyện dịch") selected
                      @endif 
                      >Truyện dịch</option>
                      <option value="Truyện convert"
                      @if($b->tpye=="Truyện convert") selected
                      @endif 
                      >Truyện convert</option>
                      <option value="Truyện sáng tác"
                      @if($b->tpye=="Truyện sáng tác") selected
                      @endif 
                      >Truyện sáng tác</option>
                  </select>
              </div>
              <div class="form-group required">
                <label for="" class="control-label">Thể loại</label>
                <div>
                    <label class="checkbox-inline pr-2">
                        <input type="checkbox" name="genres[]" value="1" class="mr-2"
                        @if($b->genres)
                        @foreach($b->genres as $a)
                        @if($a->id == 1) checked="" 
                        @endif
                        @endforeach
                        @endif
                        >Action
                    </label>
                    <label class="checkbox-inline pr-2">
                        <input type="checkbox" name="genres[]" class="mr-2" value="2" 
                        @if($b->genres)
                        @foreach($b->genres as $a)
                        @if($a->id == 2) checked="" 
                        @endif
                        @endforeach
                        @endif
                        >Drama
                    </label>
                    <label class="checkbox-inline pr-2">
                        <input class="mr-2" type="checkbox" name="genres[]" value="3" @if($b->genres)
                        @foreach($b->genres as $a)
                        @if($a->id == 3) checked="" 
                        @endif
                        @endforeach
                        @endif>Fantasy
                    </label>
                    <label class="checkbox-inline pr-2">
                        <input class="mr-2" type="checkbox" name="genres[]" value="4" @if($b->genres)
                        @foreach($b->genres as $a)
                        @if($a->id == 4) checked="" 
                        @endif
                        @endforeach
                        @endif>Horror
                    </label>
                </div>
                <div>
                    <label class="checkbox-inline pr-2">
                        <input class="mr-2" type="checkbox" name="genres[]" value="5" @if($b->genres)
                        @foreach($b->genres as $a)
                        @if($a->id == 5) checked="" 
                        @endif
                        @endforeach
                        @endif>Sport
                    </label>
                    <label class="checkbox-inline pr-2">
                        <input class="mr-2" type="checkbox" name="genres[]" value="6" @if($b->genres)
                        @foreach($b->genres as $a)
                        @if($a->id == 6) checked="" 
                        @endif
                        @endforeach
                        @endif>Cooking
                    </label>
                    <label class="checkbox-inline pr-2">
                        <input class="mr-2" type="checkbox" name="genres[]" value="7" @if($b->genres)
                        @foreach($b->genres as $a)
                        @if($a->id == 7) checked="" 
                        @endif
                        @endforeach
                        @endif>Mystery
                    </label>
                    <label class="checkbox-inline pr-2">
                        <input class="mr-2" type="checkbox" name="genres[]" value="8" @if($b->genres)
                        @foreach($b->genres as $a)
                        @if($a->id == 8) checked="" 
                        @endif
                        @endforeach
                        @endif>Adventure
                    </label>
                </div>
            </div>
            <div class="form-group required">
                <label for="" class="control-laber">Tóm tắt</label>
                <textarea name="summary" id="text" cols="30" rows="10">{{$b->summary}}</textarea>
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