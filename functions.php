<?php
add_action('wp_enqueue_scripts', 'jquery_cdn');
function jquery_cdn(){
  if(!is_admin()){
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', false, null, true);
    wp_enqueue_script('jquery');
  }
}

add_action('wp_enqueue_scripts', 'spca_scripts', 100);
function spca_scripts(){
  wp_register_script(
    'bootstrap-script', 
    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', 
    array('jquery'), 
    '', 
    true
  );
  wp_register_script(
    'spca-scripts', 
    get_template_directory_uri() . '/js/spca-scripts.js', 
    array('jquery'), 
    '', 
    true
  );
  
  
  wp_enqueue_script('bootstrap-script');
  wp_enqueue_script('spca-scripts');  
}

add_action('wp_enqueue_scripts', 'spca_styles');
function spca_styles(){
  wp_register_style('bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
  wp_register_style('spca', get_template_directory_uri() . '/style.css');
  
  wp_enqueue_style('bootstrap-css');
  wp_enqueue_style('spca');
}

register_nav_menu( 'header-nav', 'Header Navigation' );

/**
 * Class Name: wp_bootstrap_navwalker
 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 3 navigation style in a custom theme using the WordPress built in menu manager.
 * Version: 2.0.4
 * Author: Edward McIntyre - @twittem
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

class wp_bootstrap_navwalker extends Walker_Nav_Menu {

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ( $args->has_children )
				$class_names .= ' dropdown';

			if ( in_array( 'current-menu-item', $classes ) )
				$class_names .= ' active';

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->title )	? $item->title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

			// If item has_children add atts to a.
			if ( $args->has_children && $depth === 0 ) {
				//$atts['href']   		= '#';
                                $atts['href'] = ! empty( $item->url ) ? $item->url : '';
				//$atts['data-toggle']	= 'dropdown';
				$atts['class']			= 'dropdown-toggle';
				$atts['aria-haspopup']	= 'true';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			/*
			 * Glyphicons
			 * ===========
			 * Since the the menu item is NOT a Divider or Header we check the see
			 * if there is a value in the attr_title property. If the attr_title
			 * property is NOT null we apply it as the class name for the glyphicon.
			 */
			if ( ! empty( $item->attr_title ) )
				$item_output .= '<a'. $attributes .' class="bold"><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
			else
				$item_output .= '<a'. $attributes .' class="bold">';

			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo $fb_output;
		}
	}
}

add_action('init', 'spca_create_post_type');
function spca_create_post_type(){
  $pets_labels = array(
    'name' => 'Pets',
    'singular_name' => 'Pet',
    'menu_name' => 'Pets',
    'add_new_item' => 'Add New Pet',
    'search_items' => 'Search Pets'
  );
  $pets_args = array(
    'labels' => $pets_labels,
    'capability_type' => 'post',
    'public' => true,
    'menu_position' => 5,
    'query_var' => 'pets',
    'supports' => array('title', 'editor', 'custom_fields')
  );
  
  register_post_type('pets', $pets_args);
  
  register_taxonomy('pet_categories',
    'pets',
    array(
      'hierarchical' => true,
      'labels' => array(
        'name' => 'Pet Categories',
        'singular_name' => 'Pet Category',
      )
    )
  );
  
  $events_labels = array(
    'name' => 'Events',
    'singular_name' => 'Event',
    'menu_name' => 'Events',
    'add_new_item' => 'Add New Event',
    'search_items' => 'Search Events'
  );
  $events_args = array(
    'labels' => $events_labels,
    'capability_type' => 'post',
    'public' => true,
    'menu_position' => 5.1,
    'query_var' => 'events',
    'supports' => array('title', 'editor', 'custom_fields', 'author')
  );
  register_post_type('events', $events_args);
}

add_filter('gettext', 'spca_change_title_text');
function spca_change_title_text($input){
  global $post_type;
  if($input == 'Enter title here'){
    if($post_type == 'pets'){
      return 'Enter Pet Name';
    }
  }
  return $input;
}

add_filter('manage_edit-pets_columns', 'spca_edit_pets_columns');
function spca_edit_pets_columns($columns){
  $columns = array(
    'cb' => '<input type="checkbox" />',
    'title' => __('Pet Name'),
    'pet_id' => __('Pet ID'),
    'pet_categories' => __('Category'),
    'pet_adoption_status' => __('Adoption Status')
  );
  return $columns;
}

add_action('manage_pets_posts_custom_column', 'spca_manage_pets_columns', 10, 2);
function spca_manage_pets_columns($column, $post_id){
  switch($column){
    case 'pet_id':
      $pet_id = the_field('pet_id');
      echo $pet_id;
    break;
    case 'pet_categories':
      $terms = get_the_terms($post_id, 'pet_categories');
      if(!empty($terms)){
        $out = array();
        foreach($terms as $term){
          $out[] = sprintf('<a href="%s">%s</a>',
            esc_url(add_query_arg(array('post_type' => 'pets', 'pet_categories' => $term->slug), 'edit.php')),
            esc_html(sanitize_term_field('name', $term->name, $term->term_id, 'pet_categories', 'display')));
        }
        echo join(', ', $out);
      }
    break;
    case 'pet_adoption_status':
      $pet_adoption_status = the_field('pet_adoption_status');
      echo $pet_adoption_status;
    break;
  }
}

add_filter('manage_edit-pets_sortable_columns', 'spca_manage_sortable_columns');
function spca_manage_sortable_columns($columns){
  $columns['pet_id'] = 'pet_id';
  $columns['pet_categories'] = 'pet_categories';
  $columns['pet_adoption_status'] = 'pet_adoption_status';
  return $columns;
}

if(function_exists('acf_add_options_page')){
  acf_add_options_page(array(
    'page_title' => 'SPCA General Settings',
    'menu_title' => 'SPCA General Settings',
    'menu_slug' => 'spca-general-settings',
    'capability' => 'edit_posts',
    'redirect' => false
  ));
  
  acf_add_options_sub_page(array(
    'page_title' => 'Featured Sponsor',
    'menu_title' => 'Featured Sponsor',
    'parent_slug' => 'spca-general-settings'
  ));
  
  acf_add_options_sub_page(array(
    'page_title' => 'Featured Pets',
    'menu_title' => 'Featured Pets',
    'parent_slug' => 'spca-general-settings'
  ));
  
  acf_add_options_sub_page(array(
    'page_title' => 'Sidebar Quick Link Settings',
    'menu_title' => 'Sidebar Quick Link Settings',
    'parent_slug' => 'spca-general-settings'
  ));
  
  acf_add_options_sub_page(array(
    'page_title' => 'Footer Settings',
    'menu_title' => 'Footer Settings',
    'parent_slug' => 'spca-general-settings'
  ));
  
  acf_add_options_sub_page(array(
    'page_title' => 'Location Info',
    'menu_title' => 'Location Info',
    'parent_slug' => 'spca-general-settings'
  ));
  
  acf_add_options_sub_page(array(
    'page_title' => 'Offsite Adoption Info',
    'menu_title' => 'Offsite Adoption Info',
    'parent_slug' => 'spca-general-settings'
  ));
}

add_filter('excerpt_length', 'spca_custom_excerpt_length', 999);
function spca_custom_excerpt_length($length){
  return 20;
}
/*
session_start();
add_filter('posts_orderby', 'randomise_with_pagination');
function randomise_with_pagination($orderby){
  if(is_page('adopt-a-pet') || is_tax('pet_categories')){
    if(!get_query_var('paged') || get_query_var('paged') == 0 || get_query_var('paged') == 1){
      if(isset($_SESSION['seed'])){
        unset($_SESSION['seed']);
      }
    }
        
    $seed = false;
    if(isset($_SESSION['seed'])){
      $seed = $_SESSION['seed'];
    }
    if(!$seed){
      $seed = rand();
      $_SESSION['seed'] = $seed;
    }
        
    $orderby = 'RAND(' . $seed . ')';
  }
  return $orderby;
}
*/