<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title><?=$title.(empty($sub) ? NULL : ' › '.$sub);?></title>

		<!-- Bootstrap core CSS -->
		<link href="/media/css/bootstrap.min.css" rel="stylesheet">
		<link href="/media/css/select2.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="/media/js/html5shiv.js"></script>
			<script src="/media/js/respond.min.js"></script>
		<![endif]-->

		<?php $controller = Request::current()->controller(); ?>
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
					<a class="navbar-brand" href="/"><?=$title;?></a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav pull-right">
						<li class="<?= ($controller === 'Ticket' ? 'active' : NULL); ?>"><a href="/Ticket"><?=__('Tickets');?></a></li>
						<?php if ($auth->logged_in()): ?>
							<li><a href="/Account/Logout"><?=__('Logout');?></a></li>
						<?php else: ?>
							<li class="<?= ($controller === 'Account' ? 'active' : NULL); ?>"><a href="/Account"><?=__('Login');?></a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>

		<div class="container">
			<?= (isset($view) ? $view : NULL); ?>
		</div>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="/media/js/jquery.js"></script>
		<script src="/media/js/bootstrap.min.js"></script>
		<script src="/media/js/select2.min.js"></script>
		<script src="/media/js/application.js"></script>
	</body>
</html>
