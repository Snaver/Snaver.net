<?php

    function load_scripts_styles() {

    }
    add_action('wp_enqueue_scripts', 'load_scripts_styles');

	// Homepage widget area
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'snaver' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Singlepage widgets
	register_sidebar( array(
		'name' => __( 'Single Sidebar', 'snaver' ),
		'id' => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

    // Register the main nav
	register_nav_menu( 'primary', 'The menu items to appear in the sidebar' );

    // Do various things at init
    function snaver_init() {

        // Register some custom taxonomies
        register_taxonomy(
            'halo_games',
            array(
                'halo_mods',
                'halo_photography'
            ),
            array(
                'label'     => __( 'Halo Games' ),
                'rewrite'   => array(
                    'slug' => 'halo/photography'
                )
            )
        );

        register_taxonomy(
            'halo_platforms',
            array(
                'halo_mods',
                'halo_photography'
            ),
            array(
                'label' => __( 'Halo Platforms' ),
                //'rewrite' => array( 'slug' => 'person' )
            )
        );

        // Portfolio
        register_post_type(
            'snaver_portfolio',
            array(
                'labels'	=>	array(
                    'name'			=>	__( 'Portfolio' ),
                    'singular_name'	=>	__( 'Portfolio' )
                ),
                'exclude_from_search'	=>	true,
                'publicly_queryable'    =>  false,
                'public'		=> true,
                'supports'		=> array( 'title', 'editor' )
            )
        );

        // Halo Archive Files
        register_post_type(
            'halo_mods',
            array(
                'labels'        =>	array(
                    'name'			=>	__( 'Halo Modding Files Archive' ),
                    'menu_name'		=>	__( 'Halo Mods' ),
                    'singular_name'	=>	__( 'Halo Mod' )
                ),
                'description'   =>  'Random Halo Mods and Map Packs',
                'menu_icon'     =>  '',
                'has_archive'   =>  true,
                'exclude_from_search'	=>	false,
                'publicly_queryable'    =>  true,
                'public'		=>  true,
                'supports'		=>  array( 'title', 'editor' ),
                'taxonomies'    =>  array(
                    'halo_games',
                    'halo_platforms'
                ),
                'rewrite'       =>  array(
                    'slug'          =>  'halo/mods',
                    'with_front'    =>  false,
                    'feeds'         =>  false,
                    'pages'         =>  true
                )
            )
        );

        // Halo Photography
        register_post_type(
            'halo_photography',
            array(
                'labels'        =>	array(
                    'name'			=>	__( 'Halo Photography' ),
                    'menu_name'		=>	__( 'Halo Photography' ),
                    'singular_name'	=>	__( 'Halo Photo' )
                ),
                'description'   =>  'Halo Photography Galleries',
                'menu_icon'     =>  '',
                'has_archive'   =>  true,
                'exclude_from_search'	=>	false,
                'publicly_queryable'    =>  true,
                'public'		=>  true,
                'supports'		=>  array( 'title', 'editor' ),
                'taxonomies'    =>  array(
                    'halo_games',
                    'halo_platforms'
                ),
                'rewrite'       =>  array(
                    'slug'          =>  'halo/photography',
                    'with_front'    =>  false,
                    'feeds'         =>  false,
                    'pages'         =>  true
                )
            )
        );
    }
    add_action( 'init', 'snaver_init' );

    function wptuts_custom_tags() {
        add_rewrite_rule("^halo/photography/([^/]+)/([^/]+)/?",'index.php?post_type=halo_photography&halo_photography=$matches[2]&halo_games=$matches[1]','top');
    }
    add_action('init','wptuts_custom_tags');

    function wptuts_book_link( $post_link, $id = 0 ) {

        $post = get_post($id);

        if ( is_wp_error($post) || 'halo_photography' != $post->post_type || empty($post->post_name) )
            return $post_link;

        // Get the genre:
        $terms = get_the_terms($post->ID, 'halo_games');

        if( is_wp_error($terms) || !$terms ) {
            $genre = 'uncategorised';
        }
        else {
            $genre_obj = array_pop($terms);
            $genre = $genre_obj->slug;
        }

        return home_url(user_trailingslashit( "halo/photography/$genre/$post->post_name" ));
    }
    add_filter( 'post_type_link', 'wptuts_book_link' , 10, 2 );

    // Removes this <meta name="generator" content="WordPress x.x.x" /> from being in the header (Security risk)
    remove_action('wp_head', 'wp_generator');