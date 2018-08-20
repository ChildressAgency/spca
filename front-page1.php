<?php get_header(); ?>
    <div class="hero homepage" style="background-image:url(<?php the_field('hero_image'); ?>)">
      <div class="caption">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/spca-paw-logo.png" class="img-resonsive center-block" alt="" />
        <h2><?php the_field('hero_title'); ?></h2>
        <p class="btn-spca btn-grey">
          <a href="<?php echo home_url('adopt-a-pet'); ?>">View Our Pets</a>
        </p>
      </div>
    </div>
    <?php echo do_shortcode('[contact-form-7 id="105" title="Subscribe Bar"]'); ?>
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
                    'p' => $featured_blog_id
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
                          <td class="blog-date"><p><?php echo get_the_date('F\<\s\p\a\n\>j\<\/\s\p\a\n\>'); ?></p></td>
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
                    <div class="margin-top:20px;">
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
        <h1>Adopt A Pet.</h1>
        <p>Open Your Heart And Home And Adopt A Furry Friend Today!<br />First Time Adopting? <a href="<?php echo home_url('adoption_process'); ?>">Learn About Our Process.</a></p>
      </div>
      <div class="container">
        <div class="row">
          <?php if(have_rows('featured_pets', 'option')): ?>
            <?php while(have_rows('featured_pets', 'option')) : the_row(); ?>
              <?php $pet_id = get_sub_field('featured_pet'); ?>
              <div class="col-sm-4 mt40">
                <div class="feature-block">
                  <h2><?php echo get_the_title($pet_id); ?></h2>
                  <img src="<?php the_field('pet_featured_image', $pet_id); ?>" class="img-responsive center-block" alt="" />
                  <h3><?php the_field('pet_adoption_status', $pet_id); ?></h3>
                  <table class="table">
                    <tr>
                      <td class="gender"><h2><?php the_field('pet_gender', $pet_id); ?></h2></td>
                      <td class="pet-age"><p><?php the_field('pet_age', $pet_id); ?></p></td>
                    </tr>
                  </table>
                  <?php the_field('pet_short_description', $pet_id); ?>
                  <p class="btn-spca btn-blue">
                    <a href="<?php echo get_permalink($pet_id); ?>">Pet Profile</a>
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
                        <img src="<?php the_field('pet_featured_image'); ?>" class="img-responsive center-block" alt="" />
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
                        <a href="<?php the_permalink(); ?>">Pet Profile</a>
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
        <div class="view-all-pets">
          <h2>We Have More Furry Friends!</h2>
          <p class="btn-spca btn-blue">
            <a href="<?php echo home_url('adopt-a-pet'); ?>">View All Pets</a>
          </p>
        </div>
      </div>
    </div>
  
<?php get_footer(); ?>