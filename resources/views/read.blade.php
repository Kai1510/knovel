@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 pt-16">
    @if (session('status'))
    <div class="alert alert-warning">
        {{session('status') }}
    </div>
    @endif
    <div class="popular-movies mb-5">
        <a class="" href="{{route('info', $c->vol->book_id)}}"><h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold mt-4 text-center">{{$c->vol->book->title}}</h2></a>
        <h4 class="text-center text-yellow-500">{{$c->vol->title}}</h4>
        <h5 class="text-center text-yellow-500">{{$c->title}}</h5>
        <div class="text-gray-300">
            {!!$c->content!!}
        </div>
        <div class="mb-2 row">
            <div class="col">
                @if($c1>0)
                <a href=" 
                {{route('read',[$c->vol->book_id, $c->vol_id, $c1])}}
                ">CHƯƠNG TRƯỚC</a>
                @endif
            </div>
            <div class="col">
                <a href="{{route('info', $c->vol->book_id)}}">MỤC LỤC</a>
            </div>
            <div class="col">
                @if($c2>0)
                <a href=" 
                {{route('read',[$c->vol->book_id, $c->vol_id, $c2])}}
                ">CHƯƠNG SAU</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
