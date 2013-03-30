<?php
/**
 * Archive page for the custom post type 'halo_photography'
 *
 * @package Snaver
 */

get_header();

query_posts(
    array_merge(
        $wp_query->query_vars,
        array(
            'posts_per_page'    => 50,
            'meta_key'          => 'hsn_rating',
            'orderby'           => 'meta_value_num'
        )
    )
);
?>

    <div id="primary" class="clearfix fullWidth" role="main">
        <article class="post clearfix">
            <h1>Halo Photography and Screenshots</h1>
            <p>These Panoramas, Photos and Screenshots are from the various Halo Games (1, 2, 3, Recon/ODST and Reach) and on most platforms (Xbox 1, 360 and PC/Mac).</p>
            <div id="masonry">
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php

                        $img_alt = get_the_title().' Thumbnail';

                    ?>

                    <a href="<?php the_permalink() ?>" title="View full sized image <?php the_title_attribute(); ?>" class="item clearfix">
                        <?php the_post_thumbnail( 'medium', array('alt' => $img_alt, 'title' => $img_alt) ); ?>
                    </a>

                <?php endwhile; wp_reset_query(); ?>
            </div>
        </article>

        <?php get_template_part( 'navigation', 'index' ); ?>
    </div><!-- #primary -->

<?php get_footer(); ?>