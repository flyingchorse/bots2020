<?php
/**
 * Template Name: Homepage
 * Description: A Home page template
 *
 * @package WordPress
 * @subpackage Toolbox
 * @since Toolbox 0.1
 */

get_header(); 
secondstep_belowmenu();
secondstep_features();
bots_static('',1);
?>


		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
				<?php 
				$blogcat1 = get_theme_mod( 'blog_cat_1', 'default_value' );
				$blogcat2 = get_theme_mod( 'blog_cat_2', 'default_value' );
				$blogcat3 = get_theme_mod( 'blog_cat_3', 'default_value' );
				blog_home($blogcat1);
				blog_home($blogcat2);
				blog_home($blogcat3); ?>
				
			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
<?php 
get_sidebar('home');
get_footer(); ?>