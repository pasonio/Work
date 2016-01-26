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