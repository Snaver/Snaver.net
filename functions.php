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

    // Add the custom post type
    function create_post_types() {

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
                'exclude_from_search'	=>	false,
                'publicly_queryable'    =>  true,
                'public'		=>  true,
                'supports'		=>  array( 'title', 'editor' ),
                'rewrite'       =>  array(
                    'slug'          =>  'halo/mods',
                    'with_front'    =>  false
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
                    'singular_name'	=>	__( 'Halo Photography' )
                ),
                'description'   =>  'Halo Photography Galleries',
                'menu_icon'     =>  '',
                'exclude_from_search'	=>	false,
                'publicly_queryable'    =>  true,
                'public'		=>  true,
                'supports'		=>  array( 'title', 'editor' ),
                'rewrite'       =>  array(
                    'slug'          =>  'halo/photography',
                    'with_front'    =>  false
                )
            )
        );

    }
    add_action( 'init', 'create_post_types' );

    // Removes this <meta name="generator" content="WordPress 3.3.1" /> from being in the header (Security risk)
    remove_action('wp_head', 'wp_generator');