<?php

global $porto_settings;

$post_layout = 'medium';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post post-' . $post_layout); ?>>

    <div class="row">
        <?php if (has_post_thumbnail()) : ?>
        <div class="col-sm-5">
            <?php // Post Slideshow ?>
            <?php get_template_part('slideshow', 'medium'); ?>
        </div>
        <div class="col-sm-7">
            <?php else : ?>
            <div class="col-sm-12">
                <?php endif; ?>

                <div class="post-content">

                    <h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>

                    <?php
                    porto_render_rich_snippets( false );
                    if ($porto_settings['blog-excerpt']) {
                        echo porto_get_excerpt( $porto_settings['blog-excerpt-length'], false );
                    } else {
                        echo '<div class="entry-content">';
                        the_content();
                        wp_link_pages( array(
                            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'porto' ) . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                            'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'porto' ) . ' </span>%',
                            'separator'   => '<span class="screen-reader-text">, </span>',
                        ) );
                        echo '</div>';
                    }
                    ?>

                </div>
            </div>
        </div>

        <div class="post-meta clearfix">
            <span><i class="fa fa-calendar"></i> <?php echo get_the_date() ?></span>
            <span><i class="fa fa-user"></i> <?php echo __('By', 'porto'); ?> <?php the_author_posts_link(); ?></span>
            <?php
            $cats_list = get_the_category_list(', ');
            if ($cats_list) : ?>
                <span><i class="fa fa-folder-open"></i> <?php echo $cats_list ?></span>
            <?php endif; ?>
            <?php
            $tags_list = get_the_tag_list('', ', ');
            if ($tags_list) : ?>
                <span><i class="fa fa-tag"></i> <?php echo $tags_list ?></span>
            <?php endif; ?>
            <span><i class="fa fa-comments"></i> <?php comments_popup_link(__('0 Comments', 'porto'), __('1 Comment', 'porto'), '% '.__('Comments', 'porto')); ?></span>
            <a class="btn btn-xs btn-primary pt-right" href="<?php echo esc_url( apply_filters( 'the_permalink', get_permalink() ) ) ?>"><?php _e('Read more...', 'porto') ?></a>
        </div>

</article>