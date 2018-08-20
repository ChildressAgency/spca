<?php get_header(); ?>
    <div class="hero" style="background-image:url(<?php the_field('hero_image'); ?>); <?php the_field('hero_image_css'); ?>">
    </div>
    <?php if(get_field('show_bluebar')): ?>
      <div class="bluebar">
        <h1><?php the_field('bluebar_title'); ?></h1>
        <?php the_field('bluebar_text'); ?>
      </div>
    <?php endif; ?>
    <div class="main">
      <div class="container">
        <div class="row">
          <div class="col-sm-5 mt40 text-right">
            <h3 style="margin-bottom:25px;">Who We Are...</h3>
            <?php the_field('who_we_are_content'); ?>
          </div>
          <div class="col-sm-7 mt40 text-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/puppies-in-box.jpg" class="img-responsive center-block" alt="" />
            <div class="about-us-adopt">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/application-icon.png" class="img-responsive pull-left" alt="" />
              <p><span>APPLICATION PROCESS</span><br />Start the process to make an adoption today!</p>
            </div>
              <p class="btn-spca btn-blue">
                <a href="<?php echo home_url('adoption-process'); ?>">Begin Now</a>
              </p>
              <h4 style="color:#2ec4b6;">Let's get started! <a href="<?php echo home_url('contact-us'); ?>">Contact Us.</a></h4>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-7 mt40">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/cat-paper.jpg" class="img-responsive center-block" alt="" />
          </div>
          <div class="col-sm-5 mt40">
            <h3 style="margin-bottom:25px;">Why We Are <span style="color:#2ec4b6;">Different...</span></h3>
            <?php the_field('why_we_are_different_content'); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-7 col-sm-push-5 mt40">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/puppy-laying-down.jpg" class="img-responsive center-block" alt="" />
          </div>
          <div class="col-sm-5 col-sm-pull-7 mt40">
            <h3 style="margin-bottom:25px;">What Is <span style="color:#2ec4b6;">"Live &amp; Let Thrive"?</span></h3>
            <?php the_field('what_is_section'); ?>
          </div>
        </div>
      </div>
    </div>

<?php get_footer(); ?>