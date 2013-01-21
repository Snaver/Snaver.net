<?php
/**
 * Single post page
 *
 * @package Snaver
 */

get_header();
get_sidebar('single');
?>

		<div id="primary">
			<div id="content2" role="main">

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
                	<article id="post-<? the_ID(); ?>" class="post clearfix">
                    	<header>
                			<h2 class="title">
                            	<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                           	</h2>
                        </header>
                		<div class="post-info-top">
                            <span class="post-info-date">Posted by <?php the_author(); ?> on <?php the_time(get_option( 'date_format' )); ?> <?php edit_post_link('Edit', '[', ']'); ?></span>
                            <span class="gotocomments"><?php comments_popup_link('0 comments', '1 comment', '% comments'); ?><?php if(function_exists('the_views')) { echo " | ";the_views(); } ?></span>
                        </div>
                        <div class="the_content clearfix">
							<?php the_content('&raquo; Read more...'); ?>
                        </div>
                        <footer class="postmetadata post-info">
               				Posted in <span class="post-info-category"><?php the_category(', ') ?></span>. <?php if(has_tag()) { ?>Tagged with <span class="post-info-tags"><?php the_tags('', ', ', ''); ?></span>.<?php } ?>
                        </footer>
                    </article>
                                        
                    <?php comments_template(); ?>
				<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>