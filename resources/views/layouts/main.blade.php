<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>K Novel</title>
	<link rel="stylesheet" href="/font-awesome/css/all.css" />
	<link rel="stylesheet" href="/css/app.css">
	<link rel="icon" href="/img/logo-9.png">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="/bt/css/bootstrap.min.css">
	
</head>
<style>
	.form-group.required .control-label:after {
		content: " * ";
		color: red;
	}
</style>
<body class="d-flex flex-column min-vh-100 font-sans bg-gray-900">
	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand font-bold " href="{{route('welcome')}}">K Novel</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a class="nav-link" href="{{route('welcome')}}">Trang chủ 
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{Route('books.index')}}">Danh sách</a>
					</li>
					@if(Auth::user())
					<li class="nav-item">
						<a class="nav-link" href="{{Route('books.create')}}">Thêm truyện</a>
					</li>
					<li class="nav-item">
						@endif
						@auth
						<a class="nav-link" href="{{route('profile.show')}}">Người dùng: {{Auth::user()->name}}</a>
						@endauth
						@guest
						<a class="nav-link" href="{{route('login')}}">Đăng nhập</a>
						@endguest
					</li>
					<li class="nav-item">
						@auth
						<a class="nav-link" href="{{route('logout')}}">Đăng xuất</a>
						@endauth
					</li>
					<li class="nav-item">
						@if(!Auth::user())
						<a class="nav-link" href="{{route('register')}}">Đăng ký</a>
						@endif
					</li>
					<li class="nav-item">
						@if(Auth::user())
						<a class="nav-link" href="{{route('truyendadang')}}">Truyện của bạn</a>
						@endif
					</li>
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')
	<!-- Footer -->
	<footer class="footer py-3 bg-dark mt-auto" style="">
		<div class="container">
			<p class="m-0 text-center text-white">Copyright &copy; Hi i am Kai</p>
		</div>
		<!-- /.container -->
	</footer>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>