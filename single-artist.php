<?php
  get_header();
?>

<div class="container container--grid artist-grid">
  <?php

  $artist_args = array(
    'post_type' => 'post',
    'meta_key' => 'related-artists',
    'posts_per_page' => 16,
    'ignore_sticky_posts' => 1,
    'meta_query' => [
      'key' => 'related-artists',
      'compare' => 'LIKE',
      'value' => $post->ID
    ]
  );

  $artist_query = new WP_Query($artist_args);
  if ($artist_query->have_posts()) {

    while ($artist_query->have_posts()) {
      $artist_query->the_post();
      get_template_part('template-parts/content', 'postmd');
    }
  }
  wp_reset_query();

  while (have_posts()) {
    the_post(); ?>
    <div class="post artist-bio">
      <?php
      if ( has_post_thumbnail() ) {
        ?>
        <div class="post--image">
          <a href="<?= the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
        </div>
        <?php
      }
      ?>
      
      <div class="post--body">
        <div class="post--metabox">
          <h1 class="post--artist"><?php echo get_the_title() ?></h1>
        </div>

        <div class="post--content">
          <?php
            the_content();
            console_log($post);
          ?>
        </div>
        <div class="post--tags">
          <?php if (get_the_terms($post, 'instrument')) {?>
          <p><strong>Instrument:</strong> <?= get_the_term_list($post, 'instrument', '', ', ');?></p>
          <?php } ?>
          <p><strong>Genres:</strong> <?= get_the_term_list($post, 'genres', '', ', ');?></p>
          
        </div>
      </div>
    </div>
  <?php }
?>

</div>