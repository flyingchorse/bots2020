<?php
/**
 * Template Name: Team
 * Description: A Home page template
 *
 * @package WordPress
 * @subpackage Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

				<?php while ( have_posts() ) : the_post(); 
					
					?><h1><?php the_title();?></h1><?php
					$my_custom_post_type =  get_post_meta(get_the_ID(), 'type_of_post', true);
					
					$my_args = array('my_post_type' => $my_custom_post_type);
					
					bots_team($my_args);
				?>

					

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>