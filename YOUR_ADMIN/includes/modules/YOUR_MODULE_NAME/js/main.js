jQuery(function() {
	// --- example ajax call
	jQuery(document).on('click', '#ajax-action', function(event) {
		var url = FILENAME_YOUR_MODULE_NAME + '?action=ajax_action_example';
		jQuery.ajax({
			url: url,
			type: 'GET',
			dataType: 'html',
			success: function (response) {
				alert(response);
			}
		});
	});
});
