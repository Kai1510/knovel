@extends('layouts.main')

@section('content')
<div class="container mt-20 text-white">
	@if (session('status'))
	<div class="alert alert-warning">
		{{session('status') }}
	</div>
	@endif
	<div class="text-center font-bold uppercase truncate bg-gray-800 p-2">{{$b->title}}</div>
	<div class="row m-2">
		<div class="text-center col-lg-3">
			<p class="text-center font-bold uppercase truncate bg-gray-700 p-2">Thông tin</p>
			<img src="{{asset("$b->img")}}" alt="" class="lg:w-10/12 p-1 text-center inline-block">
			<p class="ml-1">Tên: {{$b->title}}</p>
			<p>Tác giả: {{$b->author}}</p>
			<p>Họa sĩ: {{$b->artist}}</p>
			<p>Người đăng: {{$b->user->name}} </p>
			<p>Loại: {{$b->type}}</p>
			<p>Thể loại: 
				@if($b->genres)
				@foreach($b->genres as $a)
				{{$a->name}}
				@endforeach
				@endif
			</p>
			@if(Auth::user())
			@if(Auth::user()->id==$b->user_id)
			<div class="mb2">
				<a class="btn btn-warning" href="{{route('books.edit', $b->id)}}">Sửa</a>
				<button type="submit" class="btn btn-danger delete-button" data-toggle="modal" data-target="#id-{{$b->id}}">Xóa</button>
			</div>
			@endif
			@endif
		</div>
		<div class="col-lg-9 mt-2">
			<p class="text-center font-bold uppercase truncate bg-gray-700 p-2">Mô tả</p>
			<p class="m-3">{!! $b->summary!!}</p>
			<p class="text-center font-bold uppercase truncate bg-gray-700 p-2">Danh sách tập
				@if(Auth::user())
				@if(Auth::user()->id==$b->user_id)
				<a type="button"  class="btn btn-primary float-right" href="{{route('vol.add',[$b->id])}}">Thêm tập</a>
				@endif
				@endif
			</p>
			<div>
				@foreach($b->vols as $v)
				<div class="row mt-1">
					<div class="col-lg-1"></div>
					<div class="bg-gray-600 mt-1 col-lg-8" type="button" data-toggle="collapse" data-target="#id-{{$v->id}}" aria-expanded="false" aria-controls="collapseExample">
						<div class="w-3/4 inline-block">{{$v->title}}</div>
					</div>
					@if(Auth::user())
					@if(Auth::user()->id==$b->user_id)
					<div class="text-center mt-1 col-lg-3">
						<a class="btn btn-warning" href="{{route('vol.edit', [$b->id, $v->id])}}">Sửa</a>
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#idx-{{$v->id}}">Xóa</button>
					</div>
					@endif
					@endif
				</div>
				<div class="collapse m-1" id="id-{{$v->id}}">
					<div class="row text-center">
						<div class="col-lg-1"></div>
						<div class="col-lg-2">
							<img src="{{asset($v->img)}}" alt="" class="p-1 inline-block float-center">
						</div>
						<div class="col-lg-8">
							<table class="table table-striped table-dark table-borderless table-sm table-fixed">
								<tbody>
									@php
									$i=1
									@endphp
									@foreach($v->chapters as $c)
									<tr>
										<th scope="row" class="w-2/12">{{$i}}</th>
										<td class="w-7/12"><a href="{{route('read', [$b->id, $v->id, $c->id])}}">{{$c->title}}</a></td>
										<td class="w-3/12">
											@if(Auth::user())
											@if(Auth::user()->id==$b->user_id)
											<div class="">
												<a class="btn btn-warning" href="{{route('chapter.edit', [$b->id, $v->id, $c->id])}}">Sửa</a>
												<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#idy-{{$c->id}}">Xóa</button>
											</div>
											@endif
											@endif
										</td>
									</tr>
									@php
									$i++
									@endphp
									@endforeach
									@if(Auth::user())
									@if(Auth::user()->id==$b->user_id)
									<tr>
										<th colspan="4" class="text-center"><a href="{{route('chapter.add', [$v->book_id, $v->id])}}">Thêm chương</a></th>
									</tr>
									@endif
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
@foreach($b->vols as $v)
<div class="modal fade" id="idx-{{$v->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="{{ route('vol.destroy',[$b->id,$v->id]) }}" method="POST">
			
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Xóa<a href=""></a></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					Xóa vol {{$v->title}} của truyện {{$v->book->title}}?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-danger">Xóa</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endforeach
<!-- Modal2 -->
@foreach($b->vols as $v)
@foreach($v->chapters as $c)
<div class="modal fade" id="idy-{{$c->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="{{ route('chapter.destroy',[$b->id,$v->id, $c->id]) }}" method="POST">

			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Xóa<a href=""></a></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					Xóa chương {{$c->title}} vol {{$v->title}} của truyện {{$v->book->title}}?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-danger">Xóa</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endforeach
@endforeach
<!-- Modal3 -->
<div class="modal fade" id="id-{{$b->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="{{ route('books.destroy',$b->id) }}" method="POST" class="mb-2">
			
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Xóa<a href=""></a></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					Xóa truyện {{$b->title}}?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-danger">Xóa</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
