<?php
/**
 * NGF Sprekeste Theme functions and definitions
 *
 */
 
add_theme_support( 'post-thumbnails' ); 
 
function register_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_menu' );

// Show the Admin Bar only to administrators
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  show_admin_bar(false);
	}
}
add_action('after_setup_theme', 'remove_admin_bar');