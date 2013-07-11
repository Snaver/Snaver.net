<?php
/**
 * Halo Single post page
 *
 * @package Snaver
 */

get_header();
the_post();
?>

    <div id="primary" class="clearfix" role="main">
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
                <?php the_content(); ?>

                <?php if(get_field('images')){ ?>
                    <h2>Images</h2>
                    <?php while(has_sub_field('images')){ $image = get_sub_field('image'); ?>
                        <img src="<?=$image['url'];?>" alt="<?=$image['title'];?>" width="300" />
                    <?php } ?>
                <?php } ?>

                <?php if(get_field('files')){ ?>
                <h2>Files</h2>
                    <?php while(has_sub_field('files')){ $file = get_sub_field('file'); ?>
                        <a href="<?=$file['url'];?>">Download <?=$file['title'];?></a>
                    <?php } ?>
                <?php } ?>
            </section>
            <footer class="postmetadata post-info">
                <?php if(get_field('author')) { ?>
                <strong>Author(s):</strong> <span class="post-info-author"><?=get_field('author');?></span>.
                <?php } ?>
                <?php if(get_field('release_date')) { ?>
                <strong>Release Date:</strong> <span class="post-info-album"><?=date('l jS F Y', strtotime(get_field('release_date')));?></span>.
                <?php } ?>
                <?php if(has_term('','halo_platforms')) { ?>
                <strong>Platform:</strong> <span class="post-info-platform"><?=the_simple_terms('halo_platforms');?></span>.
                <?php } ?>
                <?php if(has_term('','halo_games')) { ?>
                <strong>Game:</strong> <span class="post-info-game"><?=the_simple_terms('halo_games');?></span>.
                <?php } ?>
                <?php if(has_term('','halo_tags')) { ?>
                <strong>Tags:</strong> <span class="post-info-tags"><?=the_simple_terms('halo_tags');?></span>.
                <?php } ?>
            </footer>
        </article>

        <?php comments_template(); ?>
    </div><!-- #primary -->

    <?php get_sidebar('single'); ?>

<?php get_footer(); ?>