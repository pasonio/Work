<?php get_header(); ?>
    <div class="wrapper">
        <?php get_sidebar();
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
                        <h2>Thumbnail articles</h2>
                        <?php $args = array( 'post_type' => 'post_thumbnails', 'post_per_page' => 10 );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                    <ul>
                        <h2>Comments articles</h2>
                        <?php $args = array( 'post_type' => 'comments', 'post_per_page' => 10 );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                    <ul>
                        <h2>Hierarchichal articles</h2>
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
    <?php get_footer(); ?>