<?php get_header(); ?>
    <div class="hero" style="background-image:url(<?php the_field('hero_image', 12); ?>); <?php the_field('hero_image_css', 12); ?>">
    </div>
    <?php
      $adopt_a_pet_page_id = 12;
      if(get_field('show_bluebar', $adopt_a_pet_page_id)): ?>
      <div class="bluebar">
        <h1><?php the_field('bluebar_title', $adopt_a_pet_page_id); ?></h1>
        <?php the_field('bluebar_text', $adopt_a_pet_page_id); ?>
      </div>
    <?php endif; ?>
<div class="main">
  <div class="container">
    <div class="adopt-apply-instructions">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/application-icon.png" class="img-responsive pull-left" alt="" />
      <p>If you're interested in adopting an animal, please visit <a href="<?php echo home_url('contact-us'); ?>">Our Facility</a> at your earliest convenience to meet them and complete your <a href="<?php echo home_url('adoption-process'); ?>"> Adoption Application</a>.</p>
    </div>
    <div class="category-nav">
      <p>SELECT A CATEGORY</p>
      <?php $terms = get_terms('pet_categories', array('hide_empty' => 0)); ?>
      <ul>
        <li><a href="<?php echo home_url('adopt-a-pet'); ?>">VIEW ALL</a></li>
        <?php
          foreach($terms as $term){
            echo '<li><a href="' . get_term_link($term) . '">View ' . $term->name . '</a></li>';
          }
        ?>
      </ul>
    </div>
    <div class="row" id="posts">
      <?php
        global $wp_query;
        $term = $wp_query->get_queried_object();
        $cat = $term->name;
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $query_args = array(
          'post_type' => 'pets',
          //'posts_per_page' => 6,
          'paged' => $paged,
          'tax_query' => array(
            array(
              'taxonomy' => 'pet_categories',
              'field' => 'name',
              'terms' => $cat
            )
          )
        );
        $query = new WP_Query($query_args);
        if($query->have_posts()) : 
        $i = 0;
      ?>
        <div class="page" id="p<?php echo $paged; ?>">
      <?php
        while($query->have_posts()) : $query->the_post();
          if($i%3 == 0){ echo '<div class="clearfix"></div>'; }
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
      <?php $i++; endwhile; ?>
      </div>
      <?php endif; ?>
    </div>
        <div class="view-all-pets">
          <h2>We Have More Furry Friends!</h2>
          <p class="btn-spca btn-blue">
            <a style="cursor:pointer;">
              <span class="has-spinner">View More <span class="spinner"><i class="glyphicon glyphicon-refresh gly-spin"></i></span></span>
            </a>
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