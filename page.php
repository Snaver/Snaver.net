<?php
/**
 * @package Snaver
 */

get_header();
get_sidebar();
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
                        <div class="the_content clearfix">
							<?php the_content(); ?>
                        </div>
                    </article>
				<?php endwhile; ?>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>