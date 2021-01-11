@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 pt-16">
    @if (session('status'))
    <div class="alert alert-warning">
        {{session('status') }}
    </div>
    @endif
    <div class="popular-movies mb-5">
        <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold mt-4">Danh sách</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grids-col-3 lg:grid-cols-5 gap-8">
            @foreach($bs as $b)
            <div class="mt-8">
                <a href="">
                    <img src="{{asset($b->img)}}" alt="" class="hover:opacity-75 transition ease-in-out duration-150">
                </a>
                <div class="mt-2">
                    <a href="{{route('info', $b->id)}}" class="text-lg mt-2 hover:text-gray:300">{{$b->title}}</a>
                    <div class="flex items-center text-gray-400 text-sm mt-1">
                        <div class="text-gray-400 text-sm">
                            @if($b->genres)
                            @foreach($b->genres as $a)
                            {{$a->name}}
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {!! $bs->links() !!}
    </div>
</div>
@endsection