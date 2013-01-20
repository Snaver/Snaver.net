<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Snaver
 */

get_header();
get_sidebar();
?>

		<div id="primary">
			<div id="content2" role="main">

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
                	<article id="post-<? the_ID(); ?>" class="post clearfix">
                		<header>
                        	<h2 class="title">
                            	<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                            </h2>
                            <div class="post-info-top">
                                <span class="post-info-date">Posted by <?php the_author(); ?> on <?php the_time(get_option( 'date_format' )); ?> <?php edit_post_link('Edit', '[', ']'); ?></span>
                                <span class="gotocomments"><?php comments_popup_link('0 comments', '1 comment', '% comments'); ?><?php if(function_exists('the_views')) { echo " | ";the_views(); } ?></span>
                            </div>
                		</header>
                        <div class="the_content clearfix">
							<?php the_content('&raquo; Read more...'); ?>
                        </div>
                        <footer class="postmetadata post-info">
               				Posted in <span class="post-info-category"><?php the_category(', ') ?></span>. <?php if(has_tag()) { ?>Tagged with <span class="post-info-tags"><?php the_tags('', ', ', ''); ?></span>.<?php } ?>
                        </footer>
                    </article>
				<?php endwhile; ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title">Nothing Found</h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>