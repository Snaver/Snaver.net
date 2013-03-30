<?php
/**
 * Custom Single post page for Halo Photography
 *
 * @package Snaver
 */

get_header();
?>

    <div id="primary" class="clearfix" role="main">
        <?php while ( have_posts() ) : the_post(); ?>
            <?php
                $game = @array_shift(get_the_terms(get_the_ID(),'halo_games'));
            ?>
            <article id="post-<? the_ID(); ?>" class="post clearfix">
                <header>
                    <h1 class="title">
                        <a href="<?php the_permalink() ?>">
                            <?=(get_the_title() ? the_title() : $game->name.' Screenshot '.$post->post_name);?>
                        </a>
                    </h1>
                    <div class="post-info-top">
                        <span class="post-info-date">Posted by <?php the_author(); ?> on <time class="updated" datetime="<?=get_the_time('Y-m-j');?>" pubdate><?=get_the_time(get_option('date_format'));?></time> <?php edit_post_link('Edit', '[', ']'); ?></span>
                        <span class="gotocomments"><?php comments_popup_link('0 comments', '1 comment', '% comments'); ?><?php if(function_exists('the_views')) { echo " | ";the_views(); } ?></span>
                    </div>
                </header>
                <section class="the_content clearfix">
                    <?php the_content('&raquo; Read more...'); ?>

                    <?php

                        $img_alt = get_the_title().' Thumbnail';

                        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');

                    ?>
                    <a href="<?=$large_image_url[0];?>" title="View full sized <?=get_the_title();?> image" class="item clearfix">
                        <?php the_post_thumbnail( 'medium', array('alt' => $img_alt, 'title' => $img_alt) ); ?>
                    </a>

                    <?php if(function_exists('selfserv_shareaholic')) { selfserv_shareaholic(); } ?>
                </section>
                <footer class="postmetadata post-info">
                    <?php if(has_term('','halo_photography_authors')) { ?>
                        Author: <span class="post-info-author"><?=the_simple_terms('halo_photography_authors');?></span>.
                    <?php } ?>
                    <?php if(has_term('','halo_photography_albums')) { ?>
                        Album: <span class="post-info-album"><?=the_simple_terms('halo_photography_albums');?></span>.
                    <?php } ?>
                    <?php if(has_term('','halo_platforms')) { ?>
                        Platform: <span class="post-info-platform"><?=the_simple_terms('halo_platforms');?></span>.
                    <?php } ?>
                    <?php if(has_term('','halo_games')) { ?>
                        Game: <span class="post-info-game"><?=the_simple_terms('halo_games');?></span>.
                    <?php } ?>
                    <?php if(has_term('','halo_tags')) { ?>
                        Tags: <span class="post-info-tags"><?=the_simple_terms('halo_tags');?></span>.
                    <?php } ?>
                </footer>
            </article>

            <?php comments_template(); ?>
        <?php endwhile; ?>
    </div><!-- #primary -->

    <?php get_sidebar('single'); ?>

<?php get_footer(); ?>