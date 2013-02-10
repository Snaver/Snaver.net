<?php
/**
 * @package Snaver
 */

get_header();
?>

    <div id="primary" class="clearfix" role="main">
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<? the_ID(); ?>" class="post clearfix">
                <header>
                    <h1 class="title">
                        <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                    </h1>
                </header>
                <section class="the_content clearfix">
                    <?php the_content(); ?>
                </section>
            </article>
        <?php endwhile; ?>
    </div><!-- #primary -->

    <?php get_sidebar('single'); ?>

<?php get_footer(); ?>