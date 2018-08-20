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
          <div class="col-sm-8">
            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <div class="content">
              <div class="contact-info">
                <h1><?php the_field('hours_1', 'option'); ?></h1>
                <h4><?php the_field('hours_2', 'option'); ?></h4>
                <p><?php the_field('address_1', 'option'); ?><br /><?php the_field('address_2', 'option'); ?></p>
                <a href="<?php the_field('directions_link', 'option'); ?>">Get Directions</a>
                <table class="table">
                  <tbody>
                    <tr>
                      <td><p><a href="tel:<?php the_field('phone_number', 'option'); ?>"><?php the_field('phone_number', 'option'); ?></a><span>CALL US</span></p></td>
                      <td><p><a href="mailto:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a><span>E-MAIL US</span></p></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <?php the_content(); ?>
            </div>
            <?php endwhile; endif; ?>
            <hr />
            <div class="share-this">
              <p>Share This!</p>
              <?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { 
                ADDTOANY_SHARE_SAVE_KIT( array( 'use_current_page' => true ) );
              } ?>
            </div>
          </div>
          <div class="col-sm-4">
            <?php get_template_part('custom-sidebar'); ?>
          </div>
        </div>
      </div>
    </div>

<?php get_footer(); ?>