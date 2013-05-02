<?php

    function load_scripts_styles() {

        wp_enqueue_script( 'site', get_template_directory_uri().'/js/site.js' , array('jquery'), '1', true );
        wp_enqueue_script( 'jquery.masonry', get_template_directory_uri().'/js/jquery.masonry.min.js' , array('jquery','site'), '2.1.08', true );


        //wp_enqueue_style( 'validationEngine', get_template_directory_uri().'/styles/validationEngine.jquery.css', array() , '2.5.3' );

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
                'label' => __( 'Halo Games' ),
                'show_admin_column' => true
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
                'show_admin_column' => true
            )
        );

		// Random Halo related tags
        register_taxonomy(
            'halo_tags',
            array(
                'halo_mods',
                'halo_photography'
            ),
            array(
                'label' => __( 'Halo Tags' )
            )
        );
		
		// Halo Photography specific taxonomy
		register_taxonomy(
            'halo_photography_authors',
            array(
                'halo_photography'
            ),
            array(
                'labels' => array(
					'name'			=> 'Authors',
					'singular_name'	=> 'Author',
				),
				'show_admin_column' => true
				
            )
        );		
		register_taxonomy(
            'halo_photography_albums',
            array(
                'halo_photography'
            ),
            array(
                'labels' => array(
					'name'			=> 'Albums',
					'singular_name'	=> 'Album',
				),
				'show_admin_column' => true
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
                'supports'		=> array( 'title', 'editor', 'thumbnail', 'custom-fields' )
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
                'description'   =>  'Random Halo Mods, Utilities and Map Packs',
                'menu_icon'     =>  '',
                'has_archive'   =>  true,
                'exclude_from_search'	=>	false,
                'publicly_queryable'    =>  true,
                'public'		=>  true,
                'supports'		=>  array( 'title', 'editor' ),
                'taxonomies'    =>  array(
                    'halo_games',
                    'halo_platforms',
                    'halo_tags'
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
                'supports'		=>  array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
                'taxonomies'    =>  array(
                    'halo_games',
                    'halo_platforms',
                    'halo_tags',
                    'halo_photography_authors',
                    'halo_photography_albums'
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

    function halo_custom_rewrites() {
        add_rewrite_rule('^halo/photography/([^/]+)/?$','index.php?halo_games=$matches[1]&post_type=halo_photography','top');
        add_rewrite_rule("^halo/photography/([^/]+)/([^/]+)/?",'index.php?post_type=halo_photography&halo_photography=$matches[2]&halo_games=$matches[1]','top');


        add_rewrite_rule('^halo/mods/([^/]+)/?$','index.php?halo_games=$matches[1]&post_type=halo_mods','top');
        add_rewrite_rule("^halo/mods/([^/]+)/([^/]+)/?",'index.php?post_type=halo_mods&halo_mods=$matches[2]&halo_games=$matches[1]','top');
    }
    add_action('init','halo_custom_rewrites');

    function halo_custom_perm_link( $post_link, $id, $leavename, $sample ) {

        $post = get_post($id);

        if ( (is_wp_error($post) || empty($post->post_name)) && ($post->post_type != 'halo_photography' || $post->post_type != 'halo_mods') )
            return $post_link;

        // Get the games
        $games = get_the_terms($post->ID, 'halo_games');

        if( is_wp_error($games) || !$games ) {
            $game = 'uncategorised';
        }
        else {
            $game_obj = array_pop($games);
            $game = $game_obj->slug;
        }

        switch($post->post_type){
            case "halo_photography":
                return home_url(user_trailingslashit( "halo/photography/$game/$post->post_name" ));
            break;
            case "halo_mods":
                return home_url(user_trailingslashit( "halo/mods/$game/$post->post_name" ));
            break;
        }
    }
    add_filter( 'post_type_link', 'halo_custom_perm_link' , 10, 2 );

    // Removes this <meta name="generator" content="WordPress x.x.x" /> from being in the header (Security risk)
    remove_action('wp_head', 'wp_generator');

    function the_simple_terms($term_name) {
        global $post;
        $terms = get_the_terms($post->ID,$term_name,'',', ','');
        $terms = array_map('_simple_cb', $terms);
        return implode(', ', $terms);
    }

    function _simple_cb($t) {
        return $t->name;
    }