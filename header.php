<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">

    <title>Fredericksburg SPCA</title>
    <?php wp_head(); ?>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php
      if(is_singular('pets')){
        $description = wp_trim_words($wp_query->post->post_content, 50);
        echo '<meta property="og:title" content="' . single_post_title('', false) . '">';
        echo '<meta property="og:url" content="' . get_permalink() . '">';
        echo '<meta property="og:image" content="' . get_field('pet_featured_image') . '">';
        echo '<meta property="og:description" content="' . $description . '">';
        echo '<meta property="og:site_name" content="Fredericksburg SPCA">';
      }
    ?>
  </head>
  <body>
    <nav class="navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo home_url(); ?>" class="logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/spca-logo.png" class="img-responsive" alt="Fredericksburg SPCA" /></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"></button>
        </div>
        <?php
          $defaults = array(
            'theme_location' => 'header-nav',
            'menu' => '',
            'container' => 'div',
            'container_class' => 'collapse',
            'container_id' => 'navbar',
            'menu_class' => 'nav navbar-nav navbar-right',
            'menu_id' => '',
            'echo' => true,
            'fallback_cb' => 'wp_page_menu',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth' => 2,
            'walker' => new wp_bootstrap_navwalker()
          );
          wp_nav_menu($defaults);
          /*
            <div id="navbar" class="collapse">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#">HOME</a></li>
                <li><a href="#">Foster A Pet</a></li>
                <li><a href="#">Sponser A Pet</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contact Us</a></li>
              </ul>
            </div>
          */
        ?>
      </div>
      <div class="sub-nav">
        <div class="container">
          <ul class="nav nav-justify">
            <li><a href="<?php echo home_url('adopt'); ?>">ADOPT</a></li>
            <li class="bluebar"><a href="<?php echo home_url('donate'); ?>">DONATE</a></li>
            <li><a href="<?php echo home_url('foster'); ?>">FOSTER</a></li>
            <li class="bluebar"><a href="<?php echo home_url('volunteer'); ?>">VOLUNTEER</a></li>
            <li><a href="<?php echo home_url('events'); ?>">EVENTS</a></li>
          </ul>
        </div>
      </div>
    </nav>
