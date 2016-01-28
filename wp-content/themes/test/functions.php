<?php
/*Basic theme setup*/
add_theme_support( 'post-thumbnails' );
/*register theme's nav menus*/
function menu_registration() {
	register_nav_menu( 'primary', __( 'Main menu', 'test' ) );
	register_nav_menu( 'secondary', __( 'Secondary menu', 'test' ) );
}
add_action( 'init', 'create_post_type' );

function create_post_type() {
	register_post_type( 'post_thumbnails',
		array(
			'labels' => array(
				'name' => __( 'Thumbnails', 'test'),
				'singular_name' => __( 'Thumbnail', 'test' )
			),
			'public' => true,
			'supports' => array( 'thumbnail', 'title', 'editor')
		));
	register_post_type( 'comments',
		array(
			'labels' => array(
				'name' => __( 'Comment posts', 'test' ),
				'singular_name' => __( 'Comment posts', 'test' )
			),
			'public' => true,
			'supports' => array( 'title', 'editor', 'comments' )
		) );
	register_post_type( 'hierarchical',
		array(
			'labels' => array(
				'name' => __( 'Hierarchical posts', 'test' ),
				'singular_name' => __( 'Hierarchical posts', 'test' )
			),
			'public' => true,
			'hierarchical' => true,
			'supports' => array( 'title', 'editor', 'excerpt', 'post-attributes' )
		));
}
/* Register stylesheet and js files*/
function test_scripts() {
	/*Load Bootstrap's styles*/
	wp_enqueue_style( 'style-tb-test', get_template_directory_uri() . '/css/bootstrap.min.css');
	/*Load Bootstrap's scripts*/
	wp_enqueue_script( 'script-tb-test', get_template_directory_uri() . '/js/bootstrap.min.js');
	/*Load main stylesheet*/
	wp_enqueue_style( 'style-test', get_stylesheet_uri() );
	/*Load main js file*/
	wp_enqueue_script( 'script-test', get_template_directory_uri() . '/js/main.js', array( 'jquery' ) );
	/*Load text message for js scripts*/
	$text_array = array(
		'text_message' => __( "Hi I'm from PHP side.", "test")
	);
	wp_localize_script( 'script-test', 'show_message', $text_array );
}
function test_widgets_init() {
	register_sidebar(array(
		'name' => __( 'Sidebar', 'test' ),
		'id' => 'side',
		'description' => __( 'Add widgets here to appear in the sidebar', 'test' ),
		'before_widget' => '<div class="widget"',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}
function foobar_func( $atts ) {
	return "Hi! I am from shortcode.";
}
function custom_excerpt_lenght( $lenght ) {
	return 20;
}
add_action( 'after_setup_theme', 'menu_registration' );
add_action( 'wp_enqueue_scripts', 'test_scripts' );
add_action ( 'widgets_init', 'test_widgets_init' );
add_shortcode( 'foobar', 'foobar_func');
add_filter( 'excerpt_length', 'custom_excerpt_lenght', 999 );