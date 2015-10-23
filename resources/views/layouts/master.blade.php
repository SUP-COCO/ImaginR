<!DOCTYPE html>
<html>
	<head>
		<title>Imagin'R - @yield('title')</title>

		<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
		<link href="{{ asset('bower/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

		<style>
			html, body {
				height: 100%;
			}

			body {
				margin: 0;
				padding: 0;
				width: 100%;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 96px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			@yield('content')
		</div>
	</body>
</html>