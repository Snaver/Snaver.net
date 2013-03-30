<!DOCTYPE html>
<!--[if IE 6]><html id="ie6" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html id="ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title(''); ?></title>
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( !is_user_logged_in() ) { ?>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-737698-1']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
</script>
<?php } ?>
<div id="container" class="clearfix">
    <div id="aside">
        <header role="banner">
            <hgroup>
                <<?=(is_home() ? 'h1' : 'span');?> id="site-title">
                    <span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
                </<?=(is_home() ? 'h1' : 'span');?>>
                <p id="site-description"><?php bloginfo( 'description' ); ?></p>
            </hgroup>

            <nav id="nav" role="navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => null ) ); ?>
            </nav><!-- #nav -->
        </header><!-- #header -->
        <div id="footer">
            &copy; <?=date('Y');?> <a href="http://www.snaver.net/">Snaver.net</a><br />
            <a rel="generator" title="Semantic Personal Publishing Platform" href="http://wordpress.org/">Proudly powered by WordPress</a>
        </div>
    </div>
    <div id="main" class="clearfix">