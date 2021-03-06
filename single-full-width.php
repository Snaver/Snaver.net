<?php
/**
 * Template Name Posts: Full width
 *
 * @package Snaver
 */

get_header();
?>

    <div id="primary" class="clearfix" role="main" style="width:100%">
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<? the_ID(); ?>" class="post clearfix">
                <header>
                    <h1 class="title">
                        <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                    </h1>
                    <div class="post-info-top">
                        <span class="post-info-date">Posted by <?php the_author(); ?> on <time class="updated" datetime="<?=get_the_time('Y-m-j');?>" pubdate><?=get_the_time(get_option('date_format'));?></time> <?php edit_post_link('Edit', '[', ']'); ?></span>
                        <span class="gotocomments"><?php comments_popup_link('0 comments', '1 comment', '% comments'); ?><?php if(function_exists('the_views')) { echo " | ";the_views(); } ?></span>
                    </div>
                </header>
                <section class="the_content clearfix">
                    <?php the_content('&raquo; Read more...'); ?>
                </section>
                <footer class="postmetadata post-info">
                    Posted in <span class="post-info-category"><?php the_category(', ') ?></span>. <?php if(has_tag()) { ?>Tagged with <span class="post-info-tags"><?php the_tags('', ', ', ''); ?></span>.<?php } ?>
                </footer>
            </article>

            <?php comments_template(); ?>
        <?php endwhile; ?>
    </div><!-- #primary -->

<?php get_footer(); ?>