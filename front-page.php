<?php get_header(); ?>
  <?php if(have_rows('home_page_hero_layout')) : while(have_rows('home_page_hero_layout')) : the_row(); 
    if(get_row_layout() == 'slideshow'): 
      if(have_rows('slides')): ?>
        <div id="slideshow" class="hero homepage carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <?php $i=0; while(have_rows('slides')) : the_row(); ?>
              <div class="item<?php if($i==0){ echo ' active'; } ?>" style="background-image:url(<?php the_sub_field('slide_image'); ?>); <?php the_sub_field('slide_image_css'); ?>">
                <div class="caption-wrap">
                  <div class="caption">
                    <?php if(get_sub_field('slide_caption_image')): ?>
                      <img src="<?php the_sub_field('slide_caption_image'); ?>" class="img-responsive center-block" alt="" />
                    <?php endif; ?>
                    <h2><?php the_sub_field('slide_caption'); ?></h2>
                    <?php if(get_sub_field('slide_link')): ?>
                      <p class="btn-spca btn-grey">
                        <a href="<?php the_sub_field('slide_link'); ?>"><?php the_sub_field('slide_link_text'); ?></a>
                      </p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php $i++; endwhile; ?>
          </div>
          <a href="#slideshow" class="left carousel-control" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a href="#slideshow" class="right carousel-control" role="button" data-slide="next">
            <span class="glyphicon glyphicon-triangle-right" aria-hidden="false"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      <?php endif; ?>
    <?php else: ?>
      <div class="hero homepage" style="background-image:url(<?php the_field('hero_image'); ?>); <?php the_field('hero_image_css'); ?>">
        <div class="caption">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/spca-paw-logo.png" class="img-resonsive center-block" alt="" />
          <h2><?php the_field('hero_title'); ?></h2>
          <?php if(get_field('hero_link')): ?>
            <p class="btn-spca btn-grey">
              <a href="<?php the_field('hero_link'); ?>"><?php the_field('hero_link_text'); ?></a>
            </p>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  <?php endwhile; endif; ?>
    <?php //echo do_shortcode('[contact-form-7 id="105" title="Subscribe Bar"]'); ?>
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
            <div class="blog-feature">
              <?php
                if(get_field('featured_blog_post')){
                  $featured_blog_id = get_field('featured_blog_post');
                  $featured_blog_args = array(
                    'p' => $featured_blog_id,
                    'post_type' => array('post', 'events')
                  );
                }
                else{
                  $featured_blog_args = array(
                    'posts_per_page' => 1,
                    'post_status' => 'publish'
                  );
                }
                $featured_blog = new WP_Query($featured_blog_args);
                if($featured_blog->have_posts()) : while($featured_blog->have_posts()) : $featured_blog->the_post();
              ?>
              <h1><?php the_title(); ?></h1>
              <?php 
                $featured_image = get_stylesheet_directory_uri() . '/images/blog-pic-placeholder.jpg';
                if(get_field('featured_image')){ $featured_image = get_field('featured_image'); }
              ?>
              <img src="<?php echo $featured_image; ?>" class="img-responsive center-block" alt="" />
              <div class="row mt20">
                <div class="col-sm-6">
                  <div class="blog-details">
                    <h2>Details</h2>
                    <table class="table">
                      <tbody>
                        <tr>
                          <?php
                            $display_date = get_the_date('F\<\s\p\a\n\>j\<\/\s\p\a\n\>');
                            if(get_field('date_of_event')){
                              $event_date = get_field('date_of_event', false, false);
                              $event_date = new DateTime($event_date);
                              $display_date = $event_date->format('F\<\s\p\a\n\>j\<\/\s\p\a\n\>');
                            }
                          ?>
                          <td class="blog-date"><p><?php echo $display_date ?></p></td>
                          <td class="blog-author"><p><?php the_author(); ?></p></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="share-this">
                    <p>SHARE THIS!</p>
                    <?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { 
                      ADDTOANY_SHARE_SAVE_KIT( array( 'use_current_page' => true ) );
                    } ?>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="blog-excerpt">
                    <div style="margin-top:40px;">
                      <?php the_excerpt(); ?>
                    </div>
                    <p class="btn-spca btn-blue">
                      <a href="<?php the_permalink(); ?>">Learn More</a>
                    </p>
                  </div>
                </div>
              </div>
              <?php endwhile; endif; wp_reset_postdata(); ?>
            </div>
          </div>
          <div class="col-sm-4 border-left">
            <?php get_template_part('custom-sidebar'); ?>
          </div>
        </div>
      </div>
      <?php if(get_field('featured_sponsor', 'option')): ?>
        <div class="featured-sponsor">
          <div class="caption">
            <h1><?php the_field('featured_sponsor_title', 'option'); ?></h1>
            <img src="<?php the_field('featured_sponsor_logo', 'option'); ?>" class="img-responsive center-block" alt="" />
            <h2><?php the_field('featured_sponsor_text', 'option'); ?></h2>
            <hr />
            <div class="share-this">
              <p>Share This!</p>
              <?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { 
                ADDTOANY_SHARE_SAVE_KIT( array( 'use_current_page' => true ) );
              } ?>
            </div>
          </div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dog-cat-bg.jpg" alt="" />
        </div>
      <?php endif; ?>
      <div class="bluebar">
        <h1>Adopt An Animal.</h1>
        <p>Open Your Heart And Home And Adopt A Furry Friend Today!<br />First Time Adopting? <a href="<?php echo home_url('adoption-process'); ?>">Learn About Our Process.</a></p>
      </div>
      <div class="container">
        <div class="row">
          <?php if(have_rows('featured_pets', 'option')): ?>
            <?php while(have_rows('featured_pets', 'option')) : the_row(); ?>
              <?php $pet_id = get_sub_field('featured_pet'); ?>
              <div class="col-sm-4 mt40">
                <div class="feature-block">
                  <h2><?php echo get_the_title($pet_id); ?></h2>
                  <img src="<?php echo (get_field('pet_featured_image', $pet_id)) ? get_field('pet_featured_image', $pet_id) : get_stylesheet_directory_uri() . '/images/pet-profile-placeholder.jpg'; ?>" class="img-responsive center-block" alt="" />
                  <h3><?php the_field('pet_adoption_status', $pet_id); ?></h3>
                  <table class="table">
                    <tr>
                      <td class="gender"><h2><?php the_field('pet_gender', $pet_id); ?></h2></td>
                      <td class="pet-age"><p><?php the_field('pet_age', $pet_id); ?></p></td>
                    </tr>
                  </table>
                  <?php the_field('pet_short_description', $pet_id); ?>
                  <p class="btn-spca btn-blue">
                    <a href="<?php echo get_permalink($pet_id); ?>">Profile</a>
                  </p>
                  <hr />
                  <div class="share-this">
                    <p>Share Me!</p>
                    <?php 
                      if(function_exists('ADDTOANY_SHARE_SAVE_KIT')){ 
                        ADDTOANY_SHARE_SAVE_KIT(array('linkname' => get_the_title($pet_id), 'linkurl' => get_permalink($pet_id)));
                      } 
                    ?>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
            <?php else: ?>
              <?php 
                $orderby = 'date';
                if(get_field('show_random_pets')){ $orderby = 'rand'; }
                $featured_pet = new WP_Query(array('post_type' => 'pets', 'posts_per_page' => 3, 'orderby' => $orderby, 'post_status' => 'publish'));
                if($featured_pet->have_posts()) : while($featured_pet->have_posts()) : $featured_pet->the_post();
              ?>
                  <div class="col-sm-4 mt40">
                    <div class="pet-block">
                      <h2><?php the_title(); ?></h2>
                      <div class="img-with-caption">
                        <img src="<?php echo (get_field('pet_featured_image')) ? get_field('pet_featured_image') : get_stylesheet_directory_uri() . '/images/pet-profile-placeholder.jpg'; ?>" class="img-responsive center-block" alt="" />
                        <h3><?php the_field('pet_adoption_status'); ?></h3>
                      </div>
                      <table class="table">
                        <tr>
                          <td class="gender"><h2><?php the_field('pet_gender'); ?></h2></td>
                          <td class="pet-age"><p><?php the_field('pet_age'); ?></p></td>
                        </tr>
                      </table>
                      <?php the_field('pet_short_description'); ?>
                      <p class="btn-spca btn-blue">
                        <a href="<?php the_permalink(); ?>">Profile</a>
                      </p>
                      <hr />
                      <div class="share-this">
                        <p>Share Me!</p>
                    <?php 
                      if(function_exists('ADDTOANY_SHARE_SAVE_KIT')){ 
                        ADDTOANY_SHARE_SAVE_KIT(array('linkname' => get_the_title(), 'linkurl' => get_permalink()));
                      } 
                    ?>
                      </div>
                    </div>          
                  </div>
              <?php endwhile; endif; ?>
            <?php endif; ?>
        </div> 
      </div>
    </div>
  
<?php get_footer(); ?>