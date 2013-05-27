<?php

$url = end(explode('/',$_SERVER["REQUEST_URI"]));

if($url){
    $the_query = new WP_Query(array(
        'post_type' => 'attachment',
        'post_status' => 'inherit',
        's'         => '+'.(string)urldecode($url)
    ));

    if($the_query->have_posts()){
        $the_query->the_post();

        wp_redirect( wp_get_attachment_url(), 301 );
        exit;
    }

    wp_reset_postdata();
}


get_header();
?>

<div id="primary" class="clearfix" role="main">

    <article id="post-0" class="post no-results not-found">
        <header class="entry-header">
            <h1 class="entry-title">Nothing Found</h1>
        </header><!-- .entry-header -->

        <section class="entry-content">
            <p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
            <?php get_search_form(); ?>
        </section><!-- .entry-content -->
    </article><!-- #post-0 -->

</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>