<div id="comments" class="comments-area">
    <?php if( have_comments() ) { ?>
        <h2 id="comment-title">
            <?php echo __( 'Comments: ', 'test') . get_comments_number(); ?>
        </h2>
        <ol class=comment-list">
            <?php
            wp_list_comments( array(
                'style' => 'ul',
                'avatar_size' => 32
            ))
            ?>
        </ol>
    <?php } ?>
</div>