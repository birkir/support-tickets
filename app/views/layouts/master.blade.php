<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Support Tickets</title>

		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	</head>
	<body>
		<div class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="/" class="navbar-brand">Support Tickets</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav pull-right">
						<li><a href="/tickets">@lang('Tickets')</a></li>
						@if (Auth::check())
							<li><a href="/account/logout">@lang('Logout')</a></li>
						@else
							<li><a href="/account/login">@lang('Login')</a></li>
						@endif
					</ul>
				</div>
			</div>
		</div>
		<div class="container">
			@yield('content')
		</div>
		<script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	</body>
</html>