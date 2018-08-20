<?php get_header(); ?>
    <div class="hero" style="background-image:url(<?php the_field('hero_image'); ?>); <?php the_field('hero_image_css'); ?>">
    </div>
    <div class="bluebar">
      <h1>Adopt An Animal.</h1>
      <p>Open your heart and home and adopt a furry friend today!  First time adopting? <a href="<?php echo home_url('adoption-process'); ?>">Learn about our process.</a></p>
    </div>
    <div class="main">
      <div class="container">
        <div class="row">
          <div class="col-sm-8">
            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
              <h1><?php the_title(); ?></h1>
              <?php the_content(); ?>
            <?php endwhile; else: ?>
              <h3>Sorry, this page doesn't exist.</h3>
            <?php endif; ?>
          </div>
          <div class="col-sm-4 border-left">
            <?php get_template_part('custom-sidebar'); ?>
          </div>
        </div>
      </div>
      <div class="bluebar">
        <h1>Featured Animals</h1>
        <p>Open Your Heart And Home And Adopt A Furry Friend Today!<br />First Time Adopting? <a href="<?php echo home_url('adoption_process'); ?>">Learn About Our Process.</a></p>
      </div>
      <div class="container">
        <div class="row">
          <?php if(have_rows('featured_pets', 'option')): ?>
            <?php while(have_rows('featured_pets', 'option')) : the_row(); ?>
              <?php $pet_id = get_sub_field('featured_pet'); ?>
              <div class="col-sm-4 mt40">
                <div class="pet-block">
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
                $featured_pet = new WP_Query(array('post_type' => 'pets', 'posts_per_page' => 3));
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
            <a href="<?php echo home_url('adopt-a-pet'); ?>">View All Animals</a>
          </p>
        </div>
      </div>
      <div class="off-site-adoption">
        <div class="container">
          <div class="row">
            <div class="col-sm-8">
              <h2><?php the_field('offsite_adoption_title', 'option'); ?></h2>
              <?php the_field('offsite_adoption_text', 'option'); ?>
            </div>
            <div class="col-sm-4">
              <ul class="quick-links">
                <?php if(have_rows('offsite_adoption_locations', 'option')) : while(have_rows('offsite_adoption_locations', 'option')) : the_row(); ?>
                  <li><?php the_sub_field('when'); ?><p><?php the_sub_field('where'); ?><br /><a href="<?php the_sub_field('directions_link'); ?>">Get Directions</a></p></li>
                <?php endwhile; endif; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    
<?php get_footer(); ?>