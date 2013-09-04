var application = (function () {

	var app = {};

	// doc ready callback
	app.ready = function () {

		// add select2 to select boxes
		$('select').select2({
			minimumResultsForSearch: 10
		});

		// add confirm to these links
		$('a.confirm').on('click', app.confirm);

		return;
	};

	app.confirm = function () {
		return confirm('Are you sure you want to delete?');
	};

	return app;
}());

$(document).on('ready', application.ready);
