<?php get_header(); ?>
<body>
<div class="wrap">
    <?php
    while( have_posts() ) : the_post(); ?>
        <article id="<?php the_ID(); ?>">
            <div class="entry-header">
                <h2 class="entry-title">
                    <a href="<?php get_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
            </div>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; ?>
</div>
</body>