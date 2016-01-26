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
    /*Load main stylesheet*/
    wp_enqueue_style( 'style-test', get_stylesheet_uri() );
    /*Load main script file*/
    wp_enqueue_script( 'test-script', get_template_directory_uri() . '/js/main.js', array( 'jquery' ) );
}
/*Register sidebar for displaying widgets*/
function test_widget_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'test'),
		'id' => 'sidebar-1',
		'description' => __( 'Add widgets here to appear in your sidebar.', 'test'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
	));
}

add_action( 'after_setup_theme', 'menu_registration' );
add_action( 'wp_enqueue_scripts', 'test_scripts' );
add_action( 'widgets_init', 'test_widget_init' );
