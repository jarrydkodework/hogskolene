<?php
/**
 * The Header template for our theme
 *
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<title><?php bloginfo('name'); ?></title>
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css?v=1.0">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.css?v=1.0">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css?v=1.0">

	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<?php wp_head(); ?>
</head>

<body <?php body_class();?>>
	<?php $frontpage_id = get_option('page_on_front'); ?>
	<header class="header">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 logo">
					<a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" class="img-responsive" alt="<?php bloginfo('name'); ?>" /></a>
				</div>
			</div>
		</div>
	</header>