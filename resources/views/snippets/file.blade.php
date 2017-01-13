<!DOCTYPE HTML>


<html>
<head>
	<title>COMP205P</title>
	<meta charset="utf-8" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
	<link rel="stylesheet" href="/css/main.css" />

	<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
</head>
<body>

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<header id="header">
			<h1><a href="{{url('/')}}">COMP205P</a></h1>
			<nav class="links">
				<ul>
					@if (Auth::guest())

					@elseif (Auth::user()->id == $file->user_id)
					@if (Auth::user()->admin)
					<li><a href="{{url('/admin')}}">Admin</a></li>
					@endif
					<li id="li6" class="menuLogin">New Snippet</li>
					<li id="li3" class="menuLogin">Settings</li>
					<li id="li4" class="menuLogin">Upload</li>
					<li id="logout">
						<a href="{{ url('/logout') }}"
						onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
						Logout
					</a>

					<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</li>
				@else
				@if (Auth::user()->admin)
				<li><a href="{{url('/admin')}}">Admin</a></li>
				@endif
				<li id="username"> <a href="{{ url('/user/'.Auth::user()->id) }}"> {{ Auth::user()->name }} </a></li>
				<li id="logout">
					<a href="{{ url('/logout') }}"
					onclick="event.preventDefault();
					document.getElementById('logout-form').submit();">
					Logout
				</a>

				<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>
			</li>
			@endif
		</ul>
	</nav>
</header>
<div id="main">
	<article>
		<img width="500px" src="{{asset($url)}}">
	</article>
</div>
