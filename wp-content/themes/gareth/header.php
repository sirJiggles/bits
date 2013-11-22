<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>

    	<title><?php wp_title('-', true, 'right'); ?><?php bloginfo('name'); ?></title>

        <link rel="dns-prefetch" href="http://fonts.googleapis.com">
        <link rel="dns-prefetch" href="https://maps.googleapis.com">
            
        <!--[if lt IE 9]>
            <script src="<?php bloginfo('stylesheet_directory') ?>/assets/js/vendor/htmlshiv.min.js"></script>
        <![endif]-->


        <script type="text/javascript">
            var html = document.getElementsByTagName("html")[0];
            if(html.className == "no-js") {
                html.className = html.className.replace("no-js", "js");
            } 
            var siteAssetsPath = '/wp-content/themes/tyrrell/';
        </script>

        <!-- META -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, minimum-scale=1" />
    	<meta name="author" content="" />
        <meta name="keywords" content="" />
	
        <!-- Humans file -->
        <link rel="author" type="text/plain" href="/humans.txt" />

        <!-- Favicons -->
        <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory') ?>/assets/favicons/16.ico" />
    	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php bloginfo('stylesheet_directory') ?>/assets/favicons/57.png" />
    	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo('stylesheet_directory') ?>/assets/favicons/72.png" />
    	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo('stylesheet_directory') ?>/assets/favicons/114.png" />
    	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo('stylesheet_directory') ?>/assets/favicons/144.png" />
        
    	<!-- CSS -->
    	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/assets/css/screen.css" media="screen" type="text/css"/>
    
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:700,600,400" rel="stylesheet" type="text/css">

        <!-- Google Map -->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAII0d8q8BIaCWjpFb2-SxinfRwP9lwz4I&sensor=false"></script>
        
        <?php wp_head(); ?>
    </head>
    <!--[if IE 7 ]><body class="ie7"><![endif]-->
    <!--[if IE 8 ]><body class="ie8"><![endif]-->
    <!--[if gte IE 9]><body><![endif]-->

        <!-- TOOLTIP -->
        <div class="tooltip"></div>

        <!-- used for sticky footer -->
        <div id="site-wrapper">

            <header id="nav-header" role="banner">

               
            	<div class="row">

                    <div class="grid-12 end">
                		<div class="nav-controls">
                			<a title="click here to toggle nav" href="#"><span></span></a>
                		</div>
                    </div>

                     <div class="main-nav-standard">
                        <nav role="navigation" class="grid-12 end">
                            <?php

                            wp_nav_menu(array(
                                    'menu'          => 'Primary Navigation',
                                    'container'     => false,
                                    'menu_class'    => false,
                                    'echo'          => true,
                                    'before'        => '',
                                    'after'         => '',
                                    'link_before'   => '',
                                    'link_after'    => '',
                                    'depth'         => 1
                                ));

                            ?>
                        </nav>
                    </div>

                    <form method="get" action="<?php bloginfo('home'); ?>">
                        <input type="text" name="s" placeholder="Search" />
                        <input type="submit" name="submit" value=""/>
                        <a class="js-submit icon-search" href="#" title="Click to search"></a>
                    </form>

                    <a class="title" href="/" title="Tyrrell and Company">
                        <h1>Tyrrell and Company</h1>
                    </a>

                    <div class="header-right">
                        <h2>To get in touch call <a href="tel:01223832477" title="Call us on 01223 832 477">01223 832 477</a></h2>
                        <h3>Cambridge accountants, independent financial advice, tax planning &amp; credit management</h3>
                    </div>

                </div>

            </header>
