<?php

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
	
	register_nav_menu( 'primary', 'The menu items to appear in the sidebar' );