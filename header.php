<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <title><?php akaiv_title(); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php wp_head(); ?>
  <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/html5shiv/dist/html5shiv.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/respond/dest/respond.min.js"></script>
  <![endif]-->
</head>

<body <?php body_class(); ?>>
<a class="sr-only skip-link" href="#content"><?php echo 'Skip to content'; ?></a>

<header id="masthead" class="site-header" role="banner">
  <nav id="gnb" class="site-navigation gnb navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#gnb-collapse">
          <span class="sr-only">메뉴 토글</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a id="brand" class="site-title navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
      </div>
      <?php
        wp_nav_menu( array(
          'theme_location'    => 'gnb',
          'depth'             => 2,
          'container'         => 'div',
          'container_id'      => 'gnb-collapse',
          'container_class'   => 'collapse navbar-collapse navbar-right',
          'menu_class'        => 'nav navbar-nav',
          'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
          'walker'            => new wp_bootstrap_navwalker()
        ) );
      ?>
    </div><!-- .container -->
  </nav>
</header><!-- #masthead -->

<div id="main" class="site-main">
  <?php if ( !is_front_page() ) echo '<div class="container">'; ?>
