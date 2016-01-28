<<<<<<< HEAD
<?php get_header(); ?>
	<body>
        <?php get_sidebar(); ?>
		<div class="wrapper">
            <?php
            while( have_posts() ) : the_post(); ?>
            <article id="<?php the_ID(); ?>">
                <div class="entry-header">
                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                </div>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
                <div class="custom-post-types">
                    <ul>
                        <?php $args = array( 'post_type' => 'post_thumbnails', 'post_per_page' => 10 );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                    <ul>
                        <?php $args = array( 'post_type' => 'comments', 'post_per_page' => 10 );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                    <ul>
                        <?php
                        $args = array( 'post_type' => 'hierarchical', 'post_per_page' => 10 );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
            </article>
            <?php endwhile; ?>
		</div>
	</body>
=======
<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );
>>>>>>> 7f7401914b51c9f61f4e672c78fee8a30346d739
