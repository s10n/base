  <?php if ( ! is_home() && ! is_front_page() ) echo '</div><!-- .container -->'; ?>
</div><!-- #main -->

<footer id="colophon" class="site-footer" role="contentinfo">
  <div class="container">
    <div class="site-info">
      <?php $admin = get_users( array( 'role' => 'administrator' ) )[0]; ?>
      <p class="pull-left">
        <?php echo $admin->display_name; ?> &copy; <?php echo date( 'Y', current_time( 'timestamp' ) ); ?>
      </p>
      <p class="pull-right">
        <a data-toggle="tooltip" data-placement="top" title="아카이브" href="http://akaiv.com/" target="_blank">akaiv</a>
        <a class="link-admin" href="<?php echo get_admin_url(); ?>" target="_blank"><i class="fa fa-smile-o"></i></a>
        <a data-toggle="tooltip" data-placement="top" title="Proudly Powered by WordPress" href="http://wordpress.org/" target="_blank">WordPress</a>
      </p>
    </div><!-- .site-info -->
  </div><!-- .container -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>
</body>
</html>
