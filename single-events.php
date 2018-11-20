<?php get_header(); ?>
  <?php
    $hero_image = get_stylesheet_directory_uri() . '/images/sunset-girl-dog.jpg';
    $hero_image_css = 'background-position:88% 50%;';
    if(get_field('hero_image')){ 
      $hero_image = get_field('hero_image'); 
      if(get_field('hero_image_css')){
        $hero_image_css = get_field('hero_image_css');
      }
      else{
        $hero_image_css = '';
      }
    }
  ?>
    <div class="hero" style="background-image:url(<?php echo $hero_image; ?>); <?php echo $hero_image_css; ?>"></div>
    <div class="main">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <div class="blog-intro">
              <div class="img-with-caption">
                <?php
                  $featured_image = get_stylesheet_directory_uri() . '/images/blog-pic-placeholder.jpg';
                  if(get_field('featured_image')){ $featured_image = get_field('featured_image'); }
                ?>
                <img src="<?php echo $featured_image; ?>" class="img-responsive center-block" alt="" />
                <?php
                  if(get_field('date_of_event')){
                    echo '<h3>' . get_field('date_of_event') . '</h3>';
                  }
                  else{
                    echo '<h3>' . get_the_date() . '</h3>';
                  }
                ?>
              </div>
              <h2 class="blog-title"><?php the_title(); ?></h2>
              <hr />
              <div class="blog-content">
                <?php the_content(); ?>
              </div>
              <div class="blog-author">
                <?php echo get_avatar(get_the_author_meta('ID'), 100, null, null, array('class' => array('img-responsive', 'pull-left'))); ?>
                <h3><?php the_author(); ?></h3>
              </div>
              <div class="share-this">
                <p>Share This</p>
              <?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { 
                ADDTOANY_SHARE_SAVE_KIT( array( 'use_current_page' => true ) );
              } ?>
              </div>
              <p class="btn-spca btn-blue">
                <span>I'D LIKE TO LEARN MORE</span>
                <a href="<?php echo home_url('contact-us'); ?>">Contact Us</a>
              </p>
            </div>
            <?php endwhile; endif; ?>
          </div>
        </div>
      </div>
      <div class="bluebar">
        <h1>Featured Animals.</h1>
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
                $featured_pet = new WP_Query(array('post_type' => 'pets', 'posts_per_page' => 3));
                if($featured_pet->have_posts()) : while($featured_pet->have_posts()) : $featured_pet->the_post();
              ?>
                  <div class="col-sm-4 mt40">
                    <div class="feature-block">
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
        <div class="view-all-pets">
          <h2>We Have More Furry Friends!</h2>
          <p class="btn-spca btn-blue">
            <a href="<?php echo home_url('adopt-a-pet'); ?>">View All Animals</a>
          </p>
        </div>        
      </div>
    </div>
  
<?php get_footer(); ?>