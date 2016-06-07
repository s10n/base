<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo( 'name' ); ?> &mdash; 피드" href="<?php echo esc_url( get_feed_link() ); ?>">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="container">
  <!--[if IE]><div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>지원하지 않는 브라우저입니다. 브라우저를 <a class="alert-link" href="http://www.whatbrowser.org/intl/ko">업그레이드</a>하세요.</div><![endif]-->
  <a class="sr-only sr-only-focusable" href="#content">본문으로 건너뛰기</a>
</div>

<header id="masthead" class="site-header" role="banner">
  <?php $args = array( 'title_li' => '', 'depth' => 1 ); ?>
  <nav id="gnb" class="site-navigation gnb gnb-mobile navbar navbar-default navbar-fixed-top visible-xs" role="navigation" aria-label="메뉴">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#gnb-collapse">
          <span class="sr-only">메뉴 토글</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse navbar-right" id="gnb-collapse">
        <ul class="nav navbar-nav"><?php wp_list_categories( $args ); ?></ul>
      </div>
    </div>
  </nav>
  <nav class="site-navigation gnb gnb-desktop text-center" role="navigation">
    <div class="container">
      <h1 id="brand" class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
      <?php if ( get_bloginfo( 'description' ) ) : ?><p class="site-description"><?php bloginfo( 'description' ); ?></p><?php endif; ?>
      <p class="site-about"><a href="<?php echo home_url( '/about' ) ?>" class="btn btn-default btn-sm">about</a></p>
      <ul class="cat-list list-inline hidden-xs"><?php wp_list_categories( $args ); ?></ul>
    </div>
  </nav>
</header>

<section class="site-search">
  <div class="container">
    <?php get_search_form(); ?>
  </div>
</section>

<div id="content" class="site-content">
