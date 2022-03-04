<?php
/**
 * Tech Task functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Tech_Task
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tech_task_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Tech Task, use a find and replace
		* to change 'tech-task' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'tech-task', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'tech-task' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'tech_task_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'tech_task_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tech_task_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tech_task_content_width', 640 );
}
add_action( 'after_setup_theme', 'tech_task_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tech_task_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'tech-task' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'tech-task' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'tech_task_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tech_task_scripts() {
	wp_enqueue_style( 'tech-task-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'tech-task-style', 'rtl', 'replace' );

	wp_enqueue_script( 'tech-task-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script('jquery-cdn', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', array(), _S_VERSION, true);


	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'tech_task_scripts' );

add_action('wp_head', 'myplugin_ajaxurl');
function myplugin_ajaxurl() {
    echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// add active class on current menu item
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}


// remove Archive: from the title archive (leave only post type name, e.g. 'Speakers')
add_filter( 'get_the_archive_title', function ($title) {    
	if (is_post_type_archive()) {
		$title = post_type_archive_title( '', false );
	}
	return $title;    
});




function mysite_filter_function(){

	//position checkboxes
	if( $groups = get_terms( array( 'taxonomy' => 'positions' ) ) ) :
	$groups_terms = array();
	
	foreach( $groups as $group ) {
		if( isset( $_POST['positions_' . $group->term_id ] ) && $_POST['positions_' . $group->term_id] == 'on' )
			 $groups_terms[] = $group->slug;
	}
	endif;
	
	//country checkboxes
	if( $teachers = get_terms( array( 'taxonomy' => 'countries' ) ) ) :
	$teachers_terms = array();
	
	foreach( $teachers as $teacher ) {
		if( isset( $_POST['countries_' . $teacher->term_id ] ) && $_POST['countries_' . $teacher->term_id] == 'on' )
			 $teachers_terms[] = $teacher->slug;
	}
	endif;

	$tax_query = array( 'relation' => 'AND' );

	if ( ! empty( $groups_terms ) ) {
		$tax_query[] = array(
			'taxonomy' => 'positions',
			'field'    => 'slug',
			'terms'    => $groups_terms,
		);
	}

	if ( ! empty( $teachers_terms ) ) {
		$tax_query[] = array(
			'taxonomy' => 'countries',
			'field'    => 'slug',
			'terms'    => $teachers_terms,
		);
	}

	$args = array(
		'orderby'        => 'date',
		'post_type'      => 'speakers',
		'posts_per_page' => -1,
		'tax_query'      => $tax_query,
	);

	
	$query = new WP_Query( $args );
	$output = '';
	if( $query->have_posts() ) :
		while( $query->have_posts() ): $query->the_post();

			echo '<article class="speakers">';
			echo '<div class="entry-item">';
			tech_task_post_thumbnail();
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			echo '</div></article>';
			

		endwhile;
		wp_reset_postdata();
	else :
		echo 'No posts found';
	endif;
	
	die();
}
add_action('wp_ajax_myfilter', 'mysite_filter_function');
add_action('wp_ajax_nopriv_myfilter', 'mysite_filter_function');

// load more speakers function
function more_post_ajax(){
    $offset = $_GET["offset"];


     $args = array(
        'post_type' => 'speakers',
         'status' => 'publish',
         'posts_per_page' => 20,
         'order' => 'ASC',
         'offset' => $offset,
     );

    $post = new WP_Query($args);
    while ($post->have_posts()) { $post->the_post(); 
		echo '<article class="speakers">';
		echo '<div class="entry-item">';
		tech_task_post_thumbnail();
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		echo '</div></article>';
    }

   wp_reset_postdata();

     die();
  }

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax'); 
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');