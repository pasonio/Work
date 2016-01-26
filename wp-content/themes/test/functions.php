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
    /*Load bootstrap stylesheet*/
    wp_enqueue_style( 'test', get_template_directory_uri() . 'css/bootstrap.min.css' );
    /*Load main stylesheet*/
    wp_enqueue_style( 'test-style', get_stylesheet_uri() );
    /*Load main script file*/
    wp_enqueue_script( 'test-script', get_template_directory_uri() . 'js/main.js', array( 'jquery' ) );
    /*Load Bootstrap scripts*/
    wp_enqueue_script( 'test-script', get_template_directory_uri() . 'js/bootstrap.min.js' );

}

add_action( 'after_setup_theme', 'menu_registration' );
add_action( 'wp_enqueue_scripts', 'test_scripts' );
