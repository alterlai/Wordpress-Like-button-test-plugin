(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	

	 $(document).ready(function() {
		$('.cookie-clicker').click(function() {

			// disable de button
			var $this = $(this);
			$(this).prop('disabled', true);

			var nonce = $(this).data('nonce'); 
			var post_id = $this.data('post_id');

			$.ajax({
				url: cc_data.ajax_url,
				type: 'POST',
				dateType: 'json',
				data: {
					'nonce': nonce,
					'post_id': post_id,
					'action': 'add_one_to_post_meta'
				},
				success: function(data) {
					console.log(data);
					$('#counter').html(data.clicks);
				},
				error: function(error) {
					console.log(error);
				},
				complete: function() {
					$this.prop('disabled', false);
				}
			});
			
		});
		
	});
	
})( jQuery );