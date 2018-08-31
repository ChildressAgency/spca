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
      <div class="col-sm-12">
        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
          <h1><?php the_title(); ?></h1>
          <?php the_content(); ?>
        <?php endwhile; endif; ?>
        <div id="PetSearch">
          <div class="form-group">
            <label for="species" class="control-label">Select a species</label>
            <select id="species">
              <option value="All">All</option>
              <option value="Dog">Dogs</option>
              <option value="Cat">Cats</option>
            </select>
          </div>
          <div class="form-group">
            <label for="ageGroup" class="control-label">Select an age group</label>
            <select id="ageGroup">
              <option value="All">All</option>
              <option value="UnderYear">Under a Year</option>
              <option value="OverYear">Over a Year</option>
            </select>
          </div>
          <div class="form-group">
            <label for="gender" class="control-label">Select a gender</label>
            <select id="gender">
              <option value="All">All</option>
              <option value="M">Male</option>
              <option value="F">Female</option>
            </select>
          </div>
          <div class="form-group">
            <p class="btn-spca btn-blue">
              <a href="#" id="searchPets">Search Pets</a>
            </p>
          </div>
        </div>
        <iframe id="petSearchResults" class="embed-responsive-item" src="" width="100%" height="700" frameborder="0" scrolling="auto"></iframe>
        </div>
      </div>
    </div>  
      </div>
  </div>
<?php get_footer(); ?>