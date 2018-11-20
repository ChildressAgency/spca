    <div class="footer">
      <?php if(is_page('volunteer')): ?>
        <div class="get-involved" style="background-image:url(<?php the_field('donate_background_image', 'option'); ?>); <?php the_field('donate_background_image_css', 'option'); ?>">
          <div class="caption">
            <h1>We Need Your Support.</h1>
            <p class="btn-spca btn-grey">
              <a href="<?php echo home_url('donate'); ?>">Donate</a>
            </p>
          </div>
        </div>
      <?php else: ?>
        <div class="get-involved" style="background-image:url(<?php the_field('volunteer_background_image', 'option'); ?>); <?php the_field('volunteer_background_image_css', 'option'); ?>">
          <div class="caption">
            <h1>Get Involved.</h1>
            <p class="btn-spca btn-grey">
              <a href="<?php echo home_url('volunteer'); ?>">Volunteer</a>
            </p>
          </div>
        </div>
      <?php endif; ?>
      <div class="about-contact">
        <div class="container">
          <div class="row">
            <div class="col-sm-5">
              <?php the_field('about_us_tagline', 'option'); ?>
              <p class="btn-spca btn-white">
                <a href="<?php echo home_url('whoweare'); ?>">About Us</a>
              </p>
            </div>
            <div class="col-sm-2">
              <div class="paw-icon-with-line">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/paw-icon-white.png" />
              </div>
            </div>
            <div class="col-sm-5">
              <h1>Follow Us.</h1>
              <div class="social">
                <a href="<?php the_field('facebook', 'option'); ?>" class="facebook"></a>
                <a href="<?php the_field('twitter', 'option'); ?>" class="twitter"></a>
                <a href="<?php the_field('instagram', 'option'); ?>" class="instagram"></a>
                <?php if(get_field('linkedin', 'option')): ?>
	                <a href="<?php the_field('linkedin', 'option'); ?>" class="linkedin"></a>
	        <?php endif; if(get_field('google_plus', 'option')): ?>
	                <a href="<?php the_field('google_plus', 'option'); ?>" class="google-plus"></a>
	        <?php endif; ?>
              </div>
              <p class="btn-spca btn-white">
                <a href="<?php echo home_url('contact-us'); ?>">Contact Us</a>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom" style="background-image:url(<?php the_field('footer_bottom_image', 'option'); ?>); <?php the_field('footer_bottom_image_css', 'option'); ?>">
        <div class="container">
          <div class="row">
            <div class="col-sm-5">
              <div class="contact-phone">
                <h2>Contact</h2>
		<br>
		<font color="2EC4B6">
		<h3>10819 Courthouse Road</h3>
		<h3>Fredericksburg, Virginia 22408</h3>
		<h3>(540) 898-1500 (Phone)</h3>
		<h3>(540) 898-1583 (Fax)</h3>
		</font>
		<br>
		<br>
		<h2>Donate</h2>
		<br>
		<font color="2EC4B6">
                <h3>CFC - 63530 | CVC - 3625</h3>
		<h3>Local Government - 7411</h3>
		</font>
                <p><?php the_field('donation_phone_number', 'option'); ?></p>
              </div>
              <p style="margin-top:40px; text-align:center;">website created by <a href="https://childressagency.com">The Childress Agency</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>