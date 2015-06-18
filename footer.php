<?php
/**
 * The template for displaying the footer
 *
 */
?>
	<?php $frontpage_id = get_option('page_on_front'); ?>
	<div class="bg-overlay <?php if(is_page_template('success.php')){echo 'gradient';};?>"></div>
	<!-- jQuery -->
	<script type="text/javascript" charset="utf8" src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
	<script>
		jQuery(document).ready(function($) {
			// Set Container Height
			var w = $(window).height();
			var l = $('.header').height();
			$('.body-wrapper').height(w - l);
			
			// On resize
			$(window).resize(function(){
				var w = $(window).height();
				var l = $('.header').height();
				$('.body-wrapper').height(w - l);
			});
		});
	</script>
	<?php wp_footer();?>
</body>
</html>