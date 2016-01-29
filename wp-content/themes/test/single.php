<?php get_header(); ?>
    <div class="wrapper">
        <?php
        get_sidebar();
        if ( has_post_thumbnail() ) {
            the_post_thumbnail( 'medium' );
        }
        while( have_posts() ) : the_post(); ?>
            <article id="<?php the_ID(); ?>">
                <div class="entry-header">
                    <h2 class="entry-title">
                        <a href="<?php get_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                </div>
                <div class="entry-content">
                    <?php if ( has_excerpt()) {
                        the_excerpt();
                    } else {
                        the_content();
                    } ?>
                </div>
                <?php if( comments_open() || get_comments_number() ) :
                    comments_template();
                endif; ?>
            </article>
        <?php endwhile; ?>
    </div>
<?php get_footer(); ?>