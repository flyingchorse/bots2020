<?php
/**
 * secondstep Theme Customizer
 *
 * @package secondstep
 * @since secondstep 1.2
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @since secondstep 1.2
 */

add_action( 'customize_register', 'secondstep_customize_register' ); 
 
function secondstep_customize_register( $wp_customize ) {

class Taxonomy_Dropdown_Customize_Control extends WP_Customize_Control {
    public $type = 'taxonomy_dropdown';
    var $defaults = array();
    public $args = array();
 
    public function render_content(){
        // Call wp_dropdown_cats to ad data-customize-setting-link to select tag
        add_action('wp_dropdown_cats', array($this, 'wp_dropdown_cats'));
 
        // Set some defaults for our control
        $this->defaults = array(
            'show_option_none' => __('None'),
            'orderby' => 'name', 
            'hide_empty' => 0,
            'id' => $this->id,
            'selected' => $this->value(),
        );
 
        // Parse defaults against what the user submitted
        $r = wp_parse_args($this->args, $this->defaults);
 
?>
	<label><span class="customize-control-title"><?php echo esc_html($this->label); ?></span></label>
<?php  
        // Generate our select box
        wp_dropdown_categories($r);
    }
 
    function wp_dropdown_cats($output){
        // Search for <select and replace it with <select data-customize=setting-link="my_control_id"
        $output = str_replace('<select', '<select ' . $this->get_link(), $output);
        return $output;
    }
}



	$wp_customize->add_section('my_theme_blog_featured_categories', array(
	'title' => __('Slideshow: Featured Pages'),
	'priority' => 36,
	'args' => array(), // arguments for wp_dropdown_categories function...optional
));
 
$wp_customize->add_setting('featured_category_1', array(
	'default' => get_option('default_category', ''),
));
 
$wp_customize->add_control( new Taxonomy_Dropdown_Customize_Control($wp_customize, 'featured_category_1', array(
	'label' => __('Featured Area 1'),
	'section' => 'my_theme_blog_featured_categories',
	'settings' => 'featured_category_1',
)));

class Pages_Dropdown_Customize_Control extends WP_Customize_Control {
    public $type = 'pages_dropdown';
    var $defaults = array();
    public $args = array();
 
    public function render_content(){
        // Call wp_dropdown_cats to ad data-customize-setting-link to select tag
        add_action('wp_dropdown_page', array($this, 'wp_dropdown_page'));
 
        // Set some defaults for our control
        $this->defaults = array(
            'show_option_none' => __('None'),
            'orderby' => 'name', 
            'hide_empty' => 0,
            'id' => $this->id,
            'selected' => $this->value(),
        );
 
        // Parse defaults against what the user submitted
        $r = wp_parse_args($this->args, $this->defaults);
 
?>
	<label><span class="customize-control-title"><?php echo esc_html($this->label); ?></span></label>
<?php  
        // Generate our select box
        wp_dropdown_pages($r);
    }

    function wp_dropdown_page($output){
        // Search for <select and replace it with <select data-customize=setting-link="my_control_id"
        $output = str_replace('<select', '<select ' . $this->get_link(), $output);
        return $output;
    }
}



$wp_customize->add_section('my_theme_blog_featured_pages', array(
	'title' => __('Asides: Featured Pages'),
	'priority' => 36,
	'args' => array(), // arguments for wp_dropdown_categories function...optional
));
 
$wp_customize->add_setting('featured_page_1', array(
	'default' => get_option('default_page', ''),
));
 
$wp_customize->add_control( new Taxonomy_Dropdown_Customize_Control($wp_customize, 'featured_page_1', array(
	'label' => __('Featured Page 1'),
	'section' => 'my_theme_blog_featured_pages',
	'settings' => 'featured_page_1',
)));

/*----------------------------------------*/

$wp_customize->add_setting('sub_feature_1', array(
	'default' => get_option('default_page', ''),
));

$wp_customize->add_control( new Taxonomy_Dropdown_Customize_Control($wp_customize, 'sub_feature_1', array(
	'label' => __('Sub Feature Page 1'),
	'section' => 'my_theme_blog_featured_pages',
	'settings' => 'sub_feature_1',
)));


/*----------------------------------------*/

$wp_customize->add_section('my_theme_homepage_blogs', array(
	'title' => __('Homepage: Featured Blogs'),
	'priority' => 36,
	'args' => array(), // arguments for wp_dropdown_categories function...optional
));



$wp_customize->add_setting('blog_cat_1', array(
	'default' => get_option('default_page', ''),
));

$wp_customize->add_control( new Taxonomy_Dropdown_Customize_Control($wp_customize, 'blog_cat_1', array(
	'label' => __('Blog Category 1'),
	'section' => 'my_theme_homepage_blogs',
	'settings' => 'blog_cat_1',
)));

/*----------------------------------------*/


$wp_customize->add_setting('blog_cat_2', array(
	'default' => get_option('default_page', ''),
));

$wp_customize->add_control( new Taxonomy_Dropdown_Customize_Control($wp_customize, 'blog_cat_2', array(
	'label' => __('Blog Category 2'),
	'section' => 'my_theme_homepage_blogs',
	'settings' => 'blog_cat_2',
)));

/*----------------------------------------*/

$wp_customize->add_setting('blog_cat_3', array(
	'default' => get_option('default_page', ''),
));

$wp_customize->add_control( new Taxonomy_Dropdown_Customize_Control($wp_customize, 'blog_cat_3', array(
	'label' => __('Blog Category 3'),
	'section' => 'my_theme_homepage_blogs',
	'settings' => 'blog_cat_3',
)));
/*----------------------------------------*/

 


	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	

}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since secondstep 1.2
 */
function secondstep_customize_preview_js() {
	wp_enqueue_script( 'secondstep_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'secondstep_customize_preview_js' );
