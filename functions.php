<?php

// 
// SITE SETUP

function arcana_files() {
  wp_enqueue_script('rustic-arcana-js', get_theme_file_uri('/build/index.js'), array(), '1.0', true);
  wp_enqueue_style('arcana_main_styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('font-awesome', "https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
  wp_localize_script('rustic-arcana-js', 'rusticArcanaData', [
    'root_url' => get_site_url(),
    'nonce' => wp_create_nonce('wp_rest')
  ]);
}

add_action('wp_enqueue_scripts', 'arcana_files');

function arcana_features() {
  register_nav_menu('headerMenuLocation', 'Header Menu Location');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support( 'align-wide' );
  add_filter( 'excerpt_length', function($length) {
    return 13;
  }, PHP_INT_MAX );
  add_image_size('previewLarge', 220, 220, true);
  add_image_size('previewMedium', 175, 175, true);
  add_image_size('previewSmall', 100, 100, true);
}

add_action('after_setup_theme', 'arcana_features');


// 
// FORMATTING FUNCTIONS

function get_first_paragraph(){
	global $post;
	
	$str = wpautop( get_the_content() );
	$firstP = strpos( $str, '</p>' );
	$secondP = strpos( $str, '</p>', ($firstP + 1));
	$p1 = substr( $str, 0, $firstP + 4 );
	$p2 = substr( $str, ($firstP + 4), $secondP);
	
	$p1 = strip_tags($p1, '<a><strong><em>');
	$p2 = strip_tags($p2, '<a><strong><em>');

	return '<p>'.$p2.'</p>';
}

function get_medium_excerpt() {
  global $post;
  $length = 200;

  $content = strip_tags(get_the_content(), '<p>');
        
  $lastspace = strpos($content, ' ', $length);
  $add = substr($content, 0, $lastspace);
  return $add.' [...]';
}

function get_album_artist(){
  global $post;
  if (get_the_category()[0]->slug === 'albums') {
    return explode(' | ', get_the_title( $post ))[0];
  } else {
    return get_the_title();
  }
}

function get_album_title(){
  global $post;
  if (get_the_category()[0]->slug === 'albums') {
    return explode(' | ', get_the_title( $post ))[1];
  } else {
    return '';
  }
}

function get_album_year(){
  global $post;
  if (get_the_category()[0]->name === 'Albums' && get_the_terms($post, 'years')) {
    return ' (' . get_the_terms($post, 'years')[0]->name . ')';
  } else {
    return'';
  }
}

function genre_count() {
  global $post;
  if (count(get_the_terms($post, 'genres')) > 2) {
    echo 'hide';
  } else {
    echo '';
  }
}


// 
// CREATE TAXONOMIES

// Years (for posts)
function create_years_taxonomy() {
  $labels = array(
    'name' => _x( 'Years', 'taxonomy general name' ),
    'singular_name' => _x( 'Year', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Years' ),
    'all_items' => __( 'All Years' ),
    'parent_item' => __( 'Decade' ),
    'parent_item_colon' => __( 'Decade:' ),
    'edit_item' => __( 'Edit Year' ),
    'update_item' => __( 'Update Year' ),
    'add_new_item' => __( 'Add New Year' ),
    'new_item_name' => __( 'New Year Name' ),
    'menu_name' => __( 'Years' ),
  );   

  register_taxonomy('years', array('post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'years' ),
  ));
}

add_action( 'init', 'create_years_taxonomy');

// Genres (for posts and artists)
function create_genre_taxonomy() {
  $labels = array(
    'name' => _x( 'Genres', 'taxonomy general name' ),
    'singular_name' => _x( 'Genre', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Genres' ),
    'popular_items' => __( 'Popular Genres' ),
    'all_items' => __( 'All Genres' ),
    'parent_item' => __( 'Parent Genre' ),
    'parent_item_colon' => __( 'Parent Genre:' ),
    'edit_item' => __( 'Edit Genre' ), 
    'update_item' => __( 'Update Genre' ),
    'add_new_item' => __( 'Add New Genre' ),
    'new_item_name' => __( 'New Genre Name' ),
    'separate_items_with_commas' => __( 'Separate genres with commas' ),
    'add_or_remove_items' => __( 'Add or remove genres' ),
    'choose_from_most_used' => __( 'Choose from the most used genres' ),
    'menu_name' => __( 'Genres' ),
  );
 
  register_taxonomy('genres', array('post', 'artist'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'genres' ),
  ));
}

add_action( 'init', 'create_genre_taxonomy');

// Instruments (for artists)
function create_instruments_taxonomy() {
  $labels = array(
    'name' => _x( 'Instruments', 'taxonomy general name' ),
    'singular_name' => _x( 'Instrument', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Instruments' ),
    'all_items' => __( 'All Instruments' ),
    'edit_item' => __( 'Edit Instrument' ),
    'update_item' => __( 'Update Instrument' ),
    'add_new_item' => __( 'Add New Instrument' ),
    'new_item_name' => __( 'New Instrument Name' ),
    'menu_name' => __( 'Instruments' ),
  );   

  register_taxonomy('instrument', array('artist'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'instrument' ),
  ));
}

add_action( 'init', 'create_instruments_taxonomy');

// Filter archive category name from archive title request function
function my_theme_archive_title( $title ) {
  if ( is_category() ) {
      $title = single_cat_title( '', false );
  } elseif ( is_tag() ) {
      $title = single_tag_title( '', false );
  } elseif ( is_author() ) {
      $title = '<span class="vcard">' . get_the_author() . '</span>';
  } elseif ( is_post_type_archive() ) {
      $title = post_type_archive_title( '', false );
  } elseif ( is_tax() ) {
      $title = single_term_title( '', false );
  }

  return ucfirst($title);
}

add_filter( 'get_the_archive_title', 'my_theme_archive_title' );

// Console log

function console_log($output, $with_script_tags = true) {
  $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
  if ($with_script_tags) {
      $js_code = '<script>' . $js_code . '</script>';
  }
  echo $js_code;
}

function get_term_top_most_parent( $term, $taxonomy ) {
  // Start from the current term
  $parent  = get_term( $term, $taxonomy );
  // Climb up the hierarchy until we reach a term with parent = '0'
  while ( $parent->parent != '0' ) {
      $term_id = $parent->parent;
      $parent  = get_term( $term_id, $taxonomy);
  }
  return $parent;
}

// Comment Styling
function mytheme_comment($comment, $args, $depth) {
  ?>
  <div <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <div class="comment--avatar">
      <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
    </div>
    <div class="comment--content">
      <?php if ( $comment->comment_approved == '0' ) : ?>
        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
          <br />
      <?php endif; ?>

      <div class="comment-meta commentmetadata">
        <p class="timecode"><a href="<?= htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
          <?php printf( __('%1$s | %2$s'), get_comment_date("n.j.Y"),  get_comment_time("H:i") ); ?>
        </a></p>
        <p>
          <?php printf( __( '<cite class="fn bold-italic">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() );?>
        </p>
      </div>

      <?php comment_text(); ?>

      <div class="reply">
        <?php edit_comment_link( __( 'Edit' ), '', ' | ' );
        comment_reply_link( array_merge( $args, array( 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </div>
    </div>
  <?php
  }