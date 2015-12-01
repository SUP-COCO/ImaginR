<html>
	<head>
		<title>Imagin'R - @yield('title')</title>
		@section('style-script')
			<link rel="stylesheet" type="text/css" href="../vendor/bower_dl/bootstrap/dist/css/bootstrap.css">
			<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
			<script type="text/javascript" src="../vendor/bower_dl/jquery/dist/jquery.js"></script>
			<script type="text/javascript" src="../vendor/bower_dl/bootstrap/dist/js/bootstrap.min.js"></script>
			<link rel="stylesheet" type="text/css" href="../vendor/bower_dl/bootstrap-fileinput/css/fileinput.min.css">
			<script type="text/javascript" src="../vendor/bower_dl/bootstrap-fileinput/js/fileinput.min.js"></script>
		@show
	</head>
	<style type="text/css">
		body{
			    background: url('./images/bg_forfait_3.jpg') center center no-repeat fixed;
				  -webkit-background-size: cover;
				  -moz-background-size: cover;
				  -o-background-size: cover;
				  background-size: cover;
		}
	</style>
	<body>
		<div class="container">
			@yield('content')
		</div>
		@yield('script')
	</body>
</html>