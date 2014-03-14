<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
  	<meta name='description' content="<?php bloginfo('description'); ?>">

    <!--==META==-->    
    <!-- Open Graph data -->
    <meta property="og:title" content="<?php wp_title('', true, 'right'); ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="" /> 
    <meta property="og:image" content="http://example.com/image.jpg" />
    <meta property="og:description" content="Description Here" />
    <meta property="og:site_name" content="Site Name, i.e. Moz" />
    <meta property="article:published_time" content="2013-09-17T05:59:00+01:00" />
    <meta property="article:modified_time" content="2013-09-16T19:08:47+01:00" />
    <meta property="article:section" content="Article Section" />
    <meta property="article:tag" content="Article Tag" />
    <meta property="fb:admins" content="Facebook numberic ID" />

    <!--==CSS==-->
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen">
    <?php  wp_head(); ?>
</head>


<?php get_template_part( 'header', 'head' ); ?>
