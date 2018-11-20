<?php get_header(); ?>
    <div class="hero" style="background-image:url(<?php the_field('hero_image'); ?>); <?php the_field('hero_image_css'); ?>"></div>
    <?php if(get_field('show_bluebar')): ?>
      <div class="bluebar">
        <h1><?php the_field('bluebar_title'); ?></h1>
        <?php the_field('bluebar_text'); ?>
      </div>
    <?php endif; ?>
    <div class="main">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="row icon-row">
              <div class="col-sm-4 border-right">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/walk-icon.png" class="img-responsive center-block" alt="" />
                <p class="visible-xs-block">Walk &amp; Clean The Animals</p>
              </div>
              <div class="col-sm-4 border-right">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/feed-icon.png" class="img-responsive center-block" alt="" />
                <p class="visible-xs-block">Feed &amp; Care For The Animals</p>
              </div>
              <div class="col-sm-4">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/play-icon.png" class="img-responsive center-block" alt="" />
                <p class="visible-xs-block">Play With The Animals</p>
              </div>
            </div>
            <div class="row icon-row-titles hidden-xs">
              <div class="col-sm-4">
                <p>Walk &amp; Clean The Animals</p>
              </div>
              <div class="col-sm-4">
                <p>Feed &amp; Care For The Animals</p>
              </div>
              <div class="col-sm-4">
                <p>Play With The Animals</p>
              </div>
            </div>
            <div class="vol-content">
              <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                <?php the_content(); ?>
              <?php endwhile; endif; ?>
            </div>
            <br />
            <br />
          </div>
        </div>
      </div>
    </div>

<?php get_footer(); ?>