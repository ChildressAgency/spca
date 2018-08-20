<?php get_header(); ?>
    <div class="hero" style="background-image:url(<?php the_field('hero_image'); ?>); <?php the_field('hero_image_css'); ?>">
    </div>
    <?php
      //$blog_page_id = 8;
      if(get_field('show_bluebar')): ?>
      <div class="bluebar">
        <h1><?php the_field('bluebar_title'); ?></h1>
        <?php the_field('bluebar_text'); ?>
      </div>
    <?php endif; ?>
    <div class="main">
      <div class="container">
        <div class="row">
          <div class="col-sm-8">
            <?php
              $home_page_id = 6;
              if(get_field('featured_blog_post', $home_page_id)){
                $featured_blog_id = get_field('featured_blog_post', $home_page_id);
                if(get_post_type($featured_blog_id) == 'events'){
                  $featured_blog_args = array(
                    'p' => $featured_blog_id,
                    'post_type' => 'events'
                  );
                }
                else{
                  $featured_blog_args = array(
                    'posts_per_page' => 1,
                    'post_status' => 'publish',
                    'post_type' => 'events'
                  );
                }
              }
              else{
                $featured_blog_args = array(
                  'posts_per_page' => 1,
                  'post_status' => 'publish',
                  'post_type' => 'events'
                );
              }
              $featured_blog = new WP_Query($featured_blog_args);
              if($featured_blog->have_posts()) : while($featured_blog->have_posts()) : $featured_blog->the_post(); 
              $post_not_in[] = get_the_ID();
            ?>
            <div class="blog-feature">
              <h1><?php the_title(); ?></h1>
              <img src="<?php the_field('featured_image'); ?>" class="img-responsive center-block" alt="" />
              <div class="row mt20">
                <div class="col-sm-6">
                  <div class="blog-details">
                    <h2>Details</h2>
                    <table class="table">
                      <tbody>
                        <tr>
                          <?php 
                            $event_date = get_field('date_of_event', false, false);
                            $event_date = new DateTime($event_date);
                          ?>
                          <td class="blog-date"><p><?php echo $event_date->format('F\<\s\p\a\n\>j\<\/\s\p\a\n\>'); ?></p></td>
                          <td class="blog-author"><p><?php the_author(); ?></p></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="share-this">
                    <p>SHARE THIS!</p>
                    <?php 
                      if(function_exists('ADDTOANY_SHARE_SAVE_KIT')){ 
                        ADDTOANY_SHARE_SAVE_KIT(array('linkname' => get_the_title(), 'linkurl' => get_permalink()));
                      } 
                    ?>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="blog-excerpt">
                    <?php if(get_field('blog_summary_header')): ?>
                      <h2 style="margin-top:20px; text-transform:uppercase; margin-bottom:20px;"><?php the_field('blog_summary_header'); ?></h2>
                    <?php endif; ?>
                    <?php the_excerpt(); ?>
                    <p class="btn-spca btn-blue">
                      <a href="<?php the_permalink(); ?>">Read More</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <?php endwhile; endif; wp_reset_postdata(); ?>
          </div>
          <div class="col-sm-4 border-left">
            <?php get_template_part('custom-sidebar'); ?>
          </div>
        </div>
        <div class="row" id="posts">
          <?php
            //$cat = get_the_category(); 
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $ppp = (get_query_var('paged')) ? 6 : 7;
            $query = new WP_Query(array(
              'posts_per_page' => $ppp, 
              'paged' => $paged, 
              'post_type' => 'events', 
              'post__not_in' => $post_not_in, 
              'post_status' => 'publish'
            ));
            
            if($query->have_posts()) : 
              $i = 0;
          ?>
            <div class="page" id="p<?php echo $paged; ?>">
              <?php while($query->have_posts()) : $query->the_post(); ?>
                <?php 
                  if($i<5){
                    if($i%4==0){ 
                      echo '<div class="clearfix"></div>'; 
                    }
                  }
                  else if($i%3 == 0){
                    echo '<div class="clearfix"></div>';
                  }
                  ?>
                  <div class="col-sm-4 mt40">
                    <div class="feature-block">
                      <h2><?php the_title(); ?></h2>
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
                      <?php the_excerpt(); ?>
                      <p class="btn-spca btn-blue">
                        <a href="<?php the_permalink(); ?>">Read More</a>
                      </p>
                      <hr />
                      <div class="share-this">
                        <p>Share This!</p>
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
      <p class="btn-spca btn-blue">
        <a href="#">
          <span class="has-spinner">View More <span class="spinner"><i class="glyphicon glyphicon-refresh gly-spin"></i></span></span>
        </a>
      </p>
    </div>

<?php get_footer(); ?>