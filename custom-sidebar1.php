<div class="sidebar">
    <?php if(is_front_page()): ?>
      <h2>Welcome...</h2>
    <?php else: ?>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/spca-logo-no-paw.png" class="img-resonsive" alt="" />
    <?php endif; ?>
    <ul class="quick-links">
      <?php if(have_rows('quick_links', 'option')) : while(have_rows('quick_links', 'option')) : the_row(); ?>
        <li><?php the_sub_field('quick_link_title'); ?> <a href="<?php the_sub_field('quick_link_link'); ?>">Learn More.</a><p><?php the_sub_field('quick_link_text'); ?></p></li>
      <?php endwhile; endif; ?>
    </ul>
<?php
  //$sidebar_widgets = get_field('sidebar_settings');
  //if($sidebar_widgets):
?>
  <?php if(in_array('location_info', $sidebar_widgets)): ?>
    <div class="location">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/location-icon.png" class="img-responsive" alt="" />
      <p>Our Location<br /><?php the_field('address_1', 'option'); ?><br /><?php the_field('address_2', 'option'); ?><br /><span><?php the_field('hours', 'option'); ?></span></p>
      <p><span>Phone </span><?php the_field('phone_number', 'option'); ?><br /><span>Fax </span><?php the_field('fax_number', 'option'); ?><br /><span>E-Mail Us </span><?php the_field('email', 'option'); ?></p>
    </div>
  <?php endif; ?>
  <?php if(in_array('show_featured_blog', $sidebar_widgets)): ?>
    <?php 
      $featured_blog_id = get_field('featured_blog', 'option'); 
      $featured_blog = new WP_Query(array('p' => $featured_blog_id));
      if($featured_blog->have_posts()) : while($featured_blog->have_posts()) : $featured_blog->the_post();
    ?>
    <div class="featured-blog">
      <div class="feature-block">
        <h2><?php the_title(); ?></h2>
        <?php 
          $featured_image = get_stylesheet_directory_uri() . '/images/blog-pic-placeholder.jpg';
          if(get_field('featured_image')){ $featured_image = get_field('featured_image'); }
        ?>
        <img src="<?php echo $featured_image; ?>" class="img-responsive center-block"  alt="" />
        <?php 
          if(get_field('date_of_event')){
            echo '<h3>' . the_field('date_of_event') . '</h3>';
          }
          else{
            echo '<h3>' . the_date() . '</h3>';
          }
        ?>
        <?php the_excerpt(); ?>
        <p class="btn-spca btn-blue">
          <a href="<?php the_permalink(); ?>">Learn More</a>
        </p>
        <hr />
        <div class="share-this">
          <p>Share This!</p>
          <?php 
            if(function_exists('ADDTOANY_SHARE_SAVE_KIT')){ 
              ADDTOANY_SHARE_SAVE_KIT(array('linkname' => get_the_title($pet_id), 'linkurl' => get_permalink($pet_id)));
            } 
          ?>
        </div>        
      </div>
    </div>
    <?php endwhile; endif; ?>
  <?php endif; ?>
<?php //endif; ?>
</div>