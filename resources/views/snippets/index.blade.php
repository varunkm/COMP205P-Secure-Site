<!DOCTYPE HTML>

<html>
	<head>
		<title>{{ config('app.name', 'Laravel') }}</title>
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
						<h1><a href="{{url('/')}}">{{ config('app.name', 'Laravel') }}</a></h1>
						<nav class="links">
							<ul>
								@if(Auth::guest())
									<li><a href="{{ url('/login') }} ">Login</a></li>
									<li><a href ="{{url('/register')}}">Sign Up</a></li>
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

					<div id="id05" class="modal">
						<form id="forgotPasswordForm" class="modal-content animate" action="">
    						<div class="imgcontainer">
      							<span onclick="document.getElementById('id05').style.display='none'" class="close" title="Close Modal">&times;</span>
    						</div>

    						<div class="logcontainer">
								<label><b>Enter email</b></label>
								<input type="text" placeholder="Email" name="passResetEmail" id="passResetEmail">
      							<input class="logbutton" type="submit" id="submit5" name="submit5" value="Send Password Reset Request">

    						</div>

    						<div class="container" style="background-color:#f1f1f1">
      							<button type="button" onclick="document.getElementById('id05').style.display='none'" class="logcancelbtn">Cancel</button>
    						</div>
  						</form>
					</div>


					<!-- Main -->
					<div id="main">
						<div class="title">
							<h1>Home</h1>
						</div>
						<!-- Post -->
						@if (count($users) > 0)
						@foreach ($users as $user)
						<article class="post">
							<header>
								<div style="display:inline" class="title">
									<img style="display:inline" src="{{ $user->icon_url }}" width = "30px">
									<h2 style="display:inline;margin-left:20px;color:{{$user->colour}}"><a href="{{ url('/user/'.($user->id)) }}">{{ $user->name }}</a></h2>
									<br>
									<a href="{{$user->homepage}}">{{$user->name.'\'s site'}}</a>
								</div>
							</header>
									@foreach ($snippets as $snippet)
									@if($snippet->user_id === $user->id)
										<h2>{{ $snippet->text }}</h2>
										<p><i>@ {{ $snippet->created_at }}</i></p>
									@endif
					@endforeach
				</article>
				@endforeach
				@endif
			</div>

						<!-- About -->


						<!-- Footer -->


					</section>

			</div>

		<!-- Scripts -->
			<script src="/js/jquery.min.js"></script>
			<script src="/js/skel.min.js"></script>
			<script src="/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="/js/main.js"></script>
			<script src="/js/jquery-validation-1.15.0/dist/jquery.validate.min.js"></script>

			<script>
			$(function() {
				$("#submit1").click(function(){
					$('#logForm').validate({
						rules: {
							logUsername: {
								required: true
							},
							logPassword: {
								required: true
							}
						},
					});
				});
			});
			</script>

			<script>
			$(function() {
				$("#submit2").click(function(){
					$('#signUpForm').validate({
						rules: {
							username: {
								minlength: 2,
								required: true
							},
							email: {
								required: true,
								email: true
							},
							password: {
								minlength: 2,
								required: true
							},
							confirmPassword: {
								required: true,
								equalTo: "#password"
							}
						},
					});
				});
			});
			</script>

			<script>
			$(function() {
				$("#submit5").click(function(){
					$('#forgotPasswordForm').validate({
						rules: {
							passResetEmail: {
								required: true,
								email: true
							}
						},
					});
				});
			});
			</script>

			<script>
			$('#li1').click(function(){
				document.getElementById('id02').style.display='none';
				document.getElementById('id01').style.display='block';
			});
			$('#li2').click(function(){
				document.getElementById('id01').style.display='none';
				document.getElementById('id02').style.display='block';
			});
			$('#forgotPassword').click(function(){
				document.getElementById('id05').style.display='block';
			});
			</script>


	</body>
</html>
