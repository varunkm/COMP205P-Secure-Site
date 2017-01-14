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

					@elseif (Auth::user()->id == $user->id)
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

<div id="id03" class="modal">
	<form id="settingsForm" class="modal-content animate" action="{{ url('/user/edit/'.$user->id) }}" method = "POST" >
		{{ csrf_field() }}
		<div class="imgcontainer">
			<span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>
			<div class = "avatarImage">
				<img src="images/img_avatar2.png" alt="Avatar" class="avatar">
			</div>
		</div>

		<div class="logcontainer">
			<label><b>Username</b></label>
			<input type="text" placeholder="Current Username" name="newUsername" id="newUsername"value="{{ $user->name }}" required>
			<label><b>Old Password</b></label>
			<input type="text" placeholder="Enter Current Password" name="oldPassword">
			<label><b>New Password</b></label>
			<input type="password" placeholder="Enter New Password" name="newPassword" id="newPassword">
			<label><b>Confirm New Password</b></label>
			<input type="password" placeholder="Confirm New Password" name="confirmNewPassword" id="confirmNewPassword">
			<label><b>Homepage</b></label>
			<input type="text" placeholder="Homepage URL" name="homepage">
			<label><b>Image URL</b></label>
			<input type="text" placeholder="Image URL" name="imagURL">
			<label><b>Profile Colour</b></label>
			<input type="text" placeholder="Profile Colour" name="profileColour">
			<label><b>Private Snippet</b></label>
			<textarea id="snippet" name="private_snippet" rows="4" style="resize: vertical" placeholder="Enter text here..."></textarea>
			<input class="logbutton" type="submit" id="submit3" name="submit3" value="Save">

		</div>

		<div class="container" style="background-color:#f1f1f1">
			<button type="button" onclick="document.getElementById('id03').style.display='none'" class="logcancelbtn">Cancel</button>
		</div>
	</form>
</div>


<div id="id04" class="modal">
	<form class="modal-content animate" method="POST" action="{{ url('/file') }}" files="true" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="imgcontainer">
			<span onclick="document.getElementById('id04').style.display='none'" class="close" title="Close Modal">&times;</span>
		</div>

		<div class="logcontainer">
			<label><b>Upload Image</b></label>
			<input type="file" name="image_file" accept="image/*">
			<input class="logbutton" type="submit" value="Submit">
		</div>

		<div class="container" style="background-color:#f1f1f1">
			<button type="button" onclick="document.getElementById('id04').style.display='none'" class="logcancelbtn">Cancel</button>
		</div>
	</form>
</div>

</div>

<div id="id06" class="modal">
	<form id="newSnippet" class="modal-content animate" action="{{ route('createSnippet') }}" method="POST">
		{{ csrf_field() }}
		<div class="imgcontainer">
			<span onclick="document.getElementById('id06').style.display='none'" class="close" title="Close Modal">&times;</span>
		</div>

		<div class="logcontainer">
			<label><b>Snippet</b></label>
			<textarea id="snippet" name="text" rows="4" style="resize: vertical" placeholder="Enter Snippet"></textarea>
			<!-- <input class="resizable" type="text" placeholder="Snippet" name="snippet" id="snippet" required> -->
			<input class="logbutton" type="submit" id="submit6" name="submit6" value="Add Snippet">
		</div>

		<div class="container" style="background-color:#f1f1f1">
			<button type="button" onclick="document.getElementById('id06').style.display='none'" class="logcancelbtn">Cancel</button>
		</div>
	</form>
</div>
@if (count($snippets) > 0 and !Auth::guest() and (Auth::user()->id == $user->id or Auth::user()->snippetAccess))
@foreach($snippets as $snippet)
@php $modal_id = 'editmodal'.$snippet->id @endphp

<div id="{{ $modal_id }}" class="modal">
	<form id="newSnippet" class="modal-content animate" action="{{ url('/snippet/edit/'.$snippet->id) }}" method="POST">
		{{ csrf_field() }}
		<div class="imgcontainer">
			<span onclick="document.getElementById('{{ $modal_id }}').style.display='none'" class="close" title="Close Modal">&times;</span>
		</div>

		<div class="logcontainer">
			<label><b>Snippet</b></label>
			<textarea id="snippet" name="text" rows="4" style="resize: vertical" placeholder="{{$snippet->text}}"></textarea>
			<!-- <input class="resizable" type="text" placeholder="Snippet" name="snippet" id="snippet" required> -->
			<input class="logbutton" type="submit" id="submit6" name="submit6" value="Edit Snippet">
		</div>

		<div class="container" style="background-color:#f1f1f1">
			<button type="button" onclick="document.getElementById('{{ $modal_id }}').style.display='none'" class="logcancelbtn">Cancel</button>
		</div>
	</form>
</div>
@endforeach
@endif
<div style="margin-left:20px">
	<img src="{{ $user->icon_url }}" alt="User Image" width = "100px">
	<h2 style="color:{{$user->colour}}">{{ $user->name }}</h2>
	<a href="{{ $user->homepage }}">My Site</a>
	<br><br>
	@if(!Auth::guest() and Auth::user()->id == $user->id)
	<h5>Private Snippet:</h5>
	<p>{{ $user->private_snippet }}</p>
		@endif
	</div>
	<br><br>
	@if (count($snippets) > 0)
	<div class="content table-responsive table-full-width">
		<table class="table table-hover table-striped my-table">
			<thead>
				<th>ID</th>

				<th>Snippet</th>

				<th>Date Created</th>


			</thead>
			<tbody>
				@foreach ($snippets as $snippet)
				<tr>
					<td>{{ $snippet->id }}</td>

					<td>{{ $snippet->text }} </td>

					<td>{{ $snippet->created_at}}</td>

					@if(!Auth::guest() and (Auth::user()->id == $user->id or Auth::user()->snippetAccess))
					<td class="td-actions text-right">
						<button type="button" rel="tooltip" title="Edit Citation" class="btn btn-info btn-simple btn-xs" data-toggle="modal" data-target="{{ '#editmodal'.$snippet->id }}">
							<i class="fa fa-edit"></i>
						</button>
						<form action="{{ url('/snippet/'.$snippet->id) }}" method="POST">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<button type="submit" id="rowDelete" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
								<i class="fa fa-times"></i>
							</button>
						</form>
					</td>
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>

	</div>
	@else
	<p style="margin-left:20px"><i>This user has no snippets...</i></p>
	@endif

	<!-- Scripts -->
	<script src="/js/jquery.min.js"></script>
	<script src="/js/skel.min.js"></script>
	<script src="/js/util.js"></script>
	<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
	<script src="/js/main.js"></script>
	<script src="/js/jquery-validation-1.15.0/dist/jquery.validate.min.js"></script>
	<script src="/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="/js/my-style.js"></script>


	<script>
	$(function() {
		$("#submit3").click(function(){
			$('#settingsForm').validate({
				rules: {
					newUsername: {
						minlength: 2,
						required: true
					},
					confirmNewPassword: {
						equalTo: "#newPassword"
					}
				},
			});
		});
	});
	</script>

	<script>
	$(function() {
		$("#submit6").click(function(){
			$('#newSnippet').validate({
				rules: {
					snippet: {
						required: true
					},
				},
			});
		});
	});
	</script>


	<script>
	$('#li3').click(function(){
		document.getElementById('id04').style.display='none';
		document.getElementById('id06').style.display='none';
		document.getElementById('id03').style.display='block';
	});
	$('#li4').click(function(){
		document.getElementById('id03').style.display='none';
		document.getElementById('id06').style.display='none';
		document.getElementById('id04').style.display='block';
	});
	$('#li6').click(function(){
		document.getElementById('id03').style.display='none';
		document.getElementById('id04').style.display='none';
		document.getElementById('id06').style.display='block';
	});
	</script>


</body>
</html>
