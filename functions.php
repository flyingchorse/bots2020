<?php
/**
 * secondstep functions and definitions
 *
 * @package secondstep
 * @since secondstep 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since secondstep 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );

if ( ! function_exists( 'secondstep_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since secondstep 1.0
 */
function secondstep_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on secondstep, use a find and replace
	 * to change 'secondstep' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'secondstep', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('feature_thumb',300,240, true);
	add_image_size('slide_image',960,350, true);
	add_image_size('feature-thumb',140,112, true);


	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'secondstep' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/* Enable excerpt for pages */
	add_post_type_support( 'page', 'excerpt' );
	
}
endif; // secondstep_setup
add_action( 'after_setup_theme', 'secondstep_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */
function secondstep_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( 'secondstep_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		if ( ! empty( $args['default-image'] ) )
			define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}
}
add_action( 'after_setup_theme', 'secondstep_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since secondstep 1.0
 */
function secondstep_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'secondstep' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widget-title"><h3 class="white-block">',
		'after_title' => '</h3></div>'
	) );
	
	register_sidebar(array(
	'name' => 'HomePage Widget',
	'id' => 'sidebar-2',
	'description' => 'Widgets in this area will be shown on the Homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>'
));

register_sidebar(array(
	'name' => 'Footer Left Widget',
	'id' => 'footer-1',
	'description' => 'Widgets in this area will be shown in the footer.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>'
));


register_sidebar(array(
	'name' => 'Footer Middle Widget',
	'id' => 'footer-2',
	'description' => 'Widgets in this area will be shown in the footer.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>'
));

register_sidebar(array(
	'name' => 'Footer Right Widget',
	'id' => 'footer-3',
	'description' => 'Widgets in this area will be shown in the footer.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>'
));

}
add_action( 'widgets_init', 'secondstep_widgets_init' );



/**
 * Enqueue scripts and styles
 */
function secondstep_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'navigation', get_template_directory_uri() . '/js/navigation.js', null, '20120206', true );

    wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array( ), '20130115', true );
    
    wp_enqueue_style('font_awesome', get_bloginfo('stylesheet_directory') .'/font-awesome.min.css');


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
	
	wp_enqueue_script( 'slideshow', get_template_directory_uri() . '/js/slideshow.js', array( 'jquery' ));
}
add_action( 'wp_enqueue_scripts', 'secondstep_scripts' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );


function _s_add_meta_box() {
	add_meta_box(   'categorydiv', __('Categories'), 'post_categories_meta_box', 
        'page', 'side', 'core');
        
   
}

add_action( 'add_meta_boxes', '_s_add_meta_box' );


function bots_custom_post_employees() {
	$labels = array(
		'name'               => _x( 'Employees', 'post type general name' ),
		'singular_name'      => _x( 'Employee', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'employee' ),
		'add_new_item'       => __( 'Add New Employees' ),
		'edit_item'          => __( 'Edit Employees' ),
		'new_item'           => __( 'New Employees' ),
		'all_items'          => __( 'All Employees' ),
		'view_item'          => __( 'View Employee' ),
		'search_items'       => __( 'Search Employees' ),
		'not_found'          => __( 'No Employees found' ),
		'not_found_in_trash' => __( 'No Employees found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Employees'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our Employees',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments','custom-fields', 'page-attributes' ),
		'capability_type'     => 'page',
		'has_archive'   => true,
	);
	register_post_type( 'employee', $args );	
}
add_action( 'init', 'bots_custom_post_employees' );

function bots_custom_post_recommendations() {
	$labels = array(
		'name'               => _x( 'Recommendation', 'post type general name' ),
		'singular_name'      => _x( 'Recommendation', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Recommendation' ),
		'add_new_item'       => __( 'Add New Recommendation' ),
		'edit_item'          => __( 'Edit Recommendation' ),
		'new_item'           => __( 'New Recommendation' ),
		'all_items'          => __( 'All Recommendation' ),
		'view_item'          => __( 'View Recommendation' ),
		'search_items'       => __( 'Search Recommendation' ),
		'not_found'          => __( 'No Recommendation found' ),
		'not_found_in_trash' => __( 'No Recommendation found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Recommendation'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our Recommendation',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'page-attributes'),
		'capability_type'     => 'page',
		'has_archive'   => true,
	);
	register_post_type( 'recommendation', $args );	
}
add_action( 'init', 'bots_custom_post_recommendations' );

function bots_custom_post_services() {
	$labels = array(
		'name'               => _x( 'Services', 'post type general name' ),
		'singular_name'      => _x( 'Service', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Service' ),
		'add_new_item'       => __( 'Add New Services' ),
		'edit_item'          => __( 'Edit Services' ),
		'new_item'           => __( 'New Services' ),
		'all_items'          => __( 'All Services' ),
		'view_item'          => __( 'View Service' ),
		'search_items'       => __( 'Search Services' ),
		'not_found'          => __( 'No Services found' ),
		'not_found_in_trash' => __( 'No Services found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Services'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our Services',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'page-attributes' ),
		'capability_type'     => 'page',
		'has_archive'   => true,
	);
	register_post_type( 'service', $args );	
}
add_action( 'init', 'bots_custom_post_services' );

function bots_custom_post_slideshow() {
	$labels = array(
		'name'               => _x( 'Slides', 'post type general name' ),
		'singular_name'      => _x( 'Slide', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Slide' ),
		'add_new_item'       => __( 'Add New Slides' ),
		'edit_item'          => __( 'Edit Slides' ),
		'new_item'           => __( 'New Slides' ),
		'all_items'          => __( 'All Slides' ),
		'view_item'          => __( 'View Slide' ),
		'search_items'       => __( 'Search Slides' ),
		'not_found'          => __( 'No Slides found' ),
		'not_found_in_trash' => __( 'No Slides found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Slideshow'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our Slide Images',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments','custom-fields', 'page-attributes' ),
		'capability_type'     => 'page',
		'has_archive'   => true,
	);
	register_post_type( 'slide', $args );	
}
add_action( 'init', 'bots_custom_post_slideshow' );


function myplugin_settings() {  
// Add tag metabox to page

// Add category metabox to page
register_taxonomy_for_object_type('category', 'page');  
}
 // Add to the admin_init hook of your theme functions.php file 
add_action( 'admin_init', 'myplugin_settings' );

// Just before the header div
function secondstep_belowmenu() {
    do_action('secondstep_belowmenu');
} // end thematic_aboveheader

function secondstep_features() {
    do_action('secondstep_features');
} // 



function slideshow() {
global $post;
$template_name = get_post_meta($post->ID,'_wp_page_template',true);
//then define the action to take:


?><div id="slide-container"><div id="art-slideshow"> <?php

		$cat = get_theme_mod( 'featured_category_1', 'default_value' );
		  
		 $args = array('post_type' => 'slide', 'numberposts' => -1, 'order' => 'ASC' , 'orderby' => 'menu_order' );

			$attachments = get_posts($args);
			$loopcount = 1;
			if ($attachments) {
				foreach ( $attachments as $attachment ) {
				// echo apply_filters( 'the_title' , $attachment->post_title ); array('class' => 'alignleft')
				$imageloader =  wp_get_attachment_image_src($attachment->ID);
				if ($loopcount == 1) {
					$slideclass = 'slide-image active slide-' . $loopcount;
				}
				else
				{
					$slideclass = 'slide-image slide-' . $loopcount;
				}
				?><div class="<?php echo $slideclass; ?>">
				<?php
				
				//echo get_the_post_thumbnail($attachment->ID, 'slide_image');
				$imageloader = wp_get_attachment_image_src( get_post_thumbnail_id($attachment->ID), 'slide_image' );?>
				<img src="<?php echo $imageloader[0]; ?>" alt="<?php echo $template_name ?>"/>
				
				
				<div class="slide-text"><?php echo $attachment->post_title; ?></div>
				 <!-- <img class="slide-image <?php if ($loopcount == 1) { echo 'active';} ?>" src="<?php echo $imageloader[0]; ?>" alt="<?php echo $template_name ?>"/> -->
				<?php 
				
				$loopcount = $loopcount + 1;
				?></div><?php }
			}

			
?></div>
<div class="clear-div"></div></div><?php
//end action:
}
//now we can add our new action to the appropriate place like so:


add_action('secondstep_belowmenu', 'slideshow' ,0);

function features() {


//then define the action to take:


?><div class="featured-pages"> <?php

		$cat = get_theme_mod( 'sub_feature_1', 'default_value' );
		  
		 $args = array('post_type' => 'page', 'cat' => $cat , 'numberposts' => -1, 'order' => 'ASC' , 'orderby' => 'menu_order' );

			$features = get_posts($args);
			$loopcount = 1;
			if ($features) {
				foreach ( $features as $feature ) {
				// echo apply_filters( 'the_title' , $feature->post_title ); array('class' => 'alignleft')
				
				
				?>
				<div class="feature-section section-<?php echo $loopcount ?>">
				<div class="feature-section-content">
				<h3><?php echo $feature->post_title; ?></h3>
				<?php echo $feature->post_content; ?></div>
				</div>
				
				<?php 
				
				$loopcount = $loopcount + 1;
				}
			}

			
?>
<div class="clear-div"></div>
</div><?php
//end action:
}
//now we can add our new action to the appropriate place like so:

add_action('secondstep_features', 'features');


function bots_static($custom_class) {
    do_action('bots_static' ,$custom_class);
} // 

function static_features($custom_class) {


//then define the action to take:


?><div class="sticky-section <?php if ($custom_class){ echo $custom_class; }?>"><?php

		$cat = get_theme_mod( 'featured_page_1', 'default_value' );
		  
		 $args = array('post_type' => 'page', 'cat' => $cat , 'numberposts' => -1, 'order' => 'ASC' , 'orderby' => 'menu_order' );

	$theticky_posts = get_posts( $args );
	$featurecount = 1;
	foreach($theticky_posts as $sticky_post){
	// insert here your stuff...
	?>
			<div class="sticky-<?php echo $featurecount; ?> sticky">
			<div class="sticky-content">
			<a href='<?php echo get_permalink($sticky_post->ID); ?>'>
					<?php echo get_the_post_thumbnail($sticky_post->ID,"feature-thumb");?>
					<h3><?php echo $sticky_post->post_title; ?></h3>
					<p><?php echo excerpt(15,$sticky_post->post_content); ?></p>
			</a>
			<div class="clear-div"></div>
			</div>		
			</div>
			
			<?php
			$featurecount++;
			};
			
?>
<div class="clear-div"></div>
</div><?php
//end action:
}
//now we can add our new action to the appropriate place like so:

add_action('bots_static', 'static_features');

function bots_blog($feature_category) {
    do_action('bots_blog' ,$feature_category);
} // 

function blog_home($feature_category) {


//then define the action to take:


?><div class="sticky-section blog-homepage"><?php

		$cat = $feature_category;
		  
		 $args = array('cat' => $cat , 'numberposts' => -1, 'order' => 'DESC'  );

	$theticky_posts = get_posts( $args );
	$featurecount = 1;
	?> <h2><?php echo get_the_category_by_id($cat); ?></h2><?php
	foreach($theticky_posts as $sticky_post){
	// insert here your stuff...
	?>
			<div class="sticky-<?php echo $featurecount; ?> sticky">
			<div class="sticky-content">
			<a href='<?php echo get_permalink($sticky_post->ID); ?>'>
					<?php echo get_the_post_thumbnail($sticky_post->ID,"feature-thumb");?>
					<h3><?php echo $sticky_post->post_title; ?></h3>
					<p><?php echo excerpt(60,$sticky_post->post_content); ?></p>
			</a>
			<div class="clear-div"></div>
			</div>		
			</div>
			
			<?php
			$featurecount++;
			};
			
?>
<div class="clear-div"></div>
</div><?php
//end action:
}
//now we can add our new action to the appropriate place like so:

add_action('bots_blog', 'blog_home');


function bots_team($my_args) {
    do_action('bots_team', $my_args);
} // 

function get_team($my_args) {


//then define the action to take:


?><div class="team-grid"><?php

		  $my_post_type = $my_args['my_post_type'];
		  $my_cat = $my_args['comOrDom'];
		  if ($my_cat) { 
		  $args = array('post_type' => $my_post_type , 'numberposts' => -1, 'order' => 'ASC' , 'orderby' => 'menu_order', 'meta_query' => array(
        array(
            'key' => 'comOrDom',
            'value' => $my_cat
        ), ));
		  }
		  else
		  {
		 $args = array('post_type' => $my_post_type , 'numberposts' => -1, 'order' => 'ASC' , 'orderby' => 'menu_order' );
		 }
		 
		 
	$theticky_posts = get_posts( $args );
	$featurecount = 1;
	$row_count = 1;
	
	foreach($theticky_posts as $sticky_post){
	// insert here your stuff...
		$imageloader = wp_get_attachment_image_src( get_post_thumbnail_id($sticky_post->ID, "feature-thumb"));
	?>
			<div class="employee-<?php echo $featurecount; ?> employee-card <?php echo ($row_count == 4 ? "right" : $row_count) ?>">
			
			<div class="employee-info">
			<a href='<?php echo get_permalink($sticky_post->ID); ?>'>
					<div class="employee-mugshot"><img src="<?php echo $imageloader[0];  ?>"></div>
					<h3><?php echo $sticky_post->post_title; ?></h3>
					<h4><?php echo get_post_meta($sticky_post->ID, 'position', true); ?> </h4>
					<p><?php echo excerpt(15,$sticky_post->post_content); ?></p>
			</a>
			<div class="clear-div"></div>
			</div>		
			</div>
			
			<?php
			
			$row_count = ($row_count == 4 ? 1 : $row_count );
			$row_count++;
			$featurecount++;
			};
			
?>
<div class="clear-div"></div>
</div><?php
//end action:
}
//now we can add our new action to the appropriate place like so:

add_action('bots_team', 'get_team');






function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function excerpt($limit,$the_excerpt) {
	$excerpt = preg_replace('/<img[^>]+./','',$the_excerpt);
      $excerpt = explode(' ', $excerpt, $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      
      return $excerpt;
    }

    function content($limit,$the_content) {
      $content = explode(' ', $the_content, $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
      } else {
        $content = implode(" ",$content);
      } 
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content); 
      $content = str_replace(']]>', ']]&gt;', $content);
      $content = preg_replace('/<img[^>]+./','',$content);
      return $content;
    }
