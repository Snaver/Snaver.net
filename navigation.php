<nav class="navigation paging-navigation" role="navigation">
    <div class="nav-links">
        <?php if ( get_next_posts_link() ) : ?>
        <div class="nav-previous"><?php next_posts_link( '<span class="meta-nav">&larr;</span> Older posts' ); ?></div>
        <?php endif; ?>

        <?php if ( get_previous_posts_link() ) : ?>
        <div class="nav-next"><?php previous_posts_link( 'Newer posts <span class="meta-nav">&rarr;</span>' ); ?></div>
        <?php endif; ?>
    </div><!-- .nav-links -->
</nav><!-- .navigation -->