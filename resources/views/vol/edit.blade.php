@extends('layouts.main')

@section('content')
<div class="container mt-20">
    <form action="{{ route('vol.update', [$v->book_id,$v->id]) }}" method="Post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                Update volume
            </div>
            <div class="card-body">
                <div class="form-group required">
                    <label for="title" class="control-label" >Tiêu đề</label>
                    <input type="text" class="form-control" name="title" id="title" aria-describedby="Tiêu đề" placeholder="Tiêu đề" value="{{$v->title}}">
                </div>
                <div class="form-group">
                    <label for="img">Ảnh bìa</label>
                    <img src="{{asset("$v->img")}}" alt="">
                    <input type="file" class="form-control-file" name="img" id="img">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection