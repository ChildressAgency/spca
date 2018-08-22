<?php get_header(); ?>
    <div class="hero" style="background-image:url(<?php the_field('hero_image', 8); ?>); <?php the_field('hero_image_css', 8); ?>">
    </div>
    <?php if(get_field('show_bluebar',8)): ?>
      <div class="bluebar">
        <h1><?php the_field('bluebar_title',8); ?></h1>
        <?php the_field('bluebar_text',8); ?>
      </div>
    <?php endif; ?>
    <div class="main">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <?php
              $featured_blog_args = array(
                'posts_per_page' => 1,
                'post_status' => 'publish'
              );
              $featured_blog = new WP_Query($featured_blog_args);
              if($featured_blog->have_posts()) : while($featured_blog->have_posts()) : $featured_blog->the_post(); 
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
                          <td class="blog-date"><p><?php echo get_the_date('F\<\s\p\a\n\>j\<\/\s\p\a\n\>'); ?></p></td>
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
        </div>
        <div class="category-nav">
          <p>SELECT A CATEGORY</p>
          <?php $categories = get_categories(array('orderby' => 'name', 'order' => 'ASC')); ?>
          <ul>
            <li><a href="<?php echo home_url('blog'); ?>">VIEW ALL</a></li>
            <?php 
              foreach($categories as $category){
                echo '<li><a href="' . get_category_link($category->term_id) . '">View ' . $category->name . '</a></li>';
              }
            ?>
          </ul>
        </div>
        <div class="row" id="posts">
          <?php 
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            //$ppp = (get_query_var('paged')) ? 6 : 7;
			$ppp = ($paged == 1) ? 7 : 6;
            $query = new WP_Query(array('posts_per_page' => $ppp, 'paged' => $paged));
            
            if(have_posts()) : 
              $i = 0;
          ?>
            <div class="page" id="p<?php echo $paged; ?>">
              <?php while(have_posts()) : the_post(); ?>
                <?php if($i > 0): ?>
                  <?php 
                  if($i<5){
                    if($i%4==0){ 
                      echo '<div class="clearfix"></div>'; 
                    }
                  }
                  else if(($i-1)%3 == 0){
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
              <?php endif; $i++; endwhile; ?>
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