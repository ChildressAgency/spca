<?php get_header(); ?>
  <?php if(get_field('hero_image')): ?>
    <div class="hero" style="background-image:url(<?php the_field('hero_image'); ?>); <?php the_field('hero_image_css'); ?>"></div>
  <?php endif; ?>
    <?php if(get_field('show_bluebar')): ?>
      <div class="bluebar">
        <h1><?php the_field('bluebar_title'); ?></h1>
        <?php the_field('bluebar_text'); ?>
      </div>
    <?php endif; ?>
  <div class="main">
    <div class="container">
      <div class="col-sm-8">
        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
          <h1><?php the_title(); ?></h1>
          <script type="text/JavaScript" src="//app.etapestry.com/hosted/eTapestry.com/etapEmbedResponsiveResizing.js"></script><iframe id="etapIframe" style="border:none;width:100%;" src="https://app.etapestry.com/onlineforms/SPCAofFredericksburg/donate.html"></iframe>
        <?php endwhile; endif; ?>
      </div>
      <div class="col-sm-4">
        <?php get_template_part('custom-sidebar'); ?>
      </div>
  </div>
<?php get_footer(); ?>