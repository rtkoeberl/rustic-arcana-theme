<?php
  get_header();
?>

<div class="container container--grid single">
  <div class="single--main">
    
  <?php
  while (have_posts()) {   
    the_post();
    ?>
    <div class="post">
      <div class="post--image">
        <?php
        if ( has_post_thumbnail() ) {
          ?>
          <a href="<?= the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
          <?php
        }
        ?>
      </div>
      <div class="post--body">
        <div class="post--metabox">
          <h1 class="post--artist"><?= get_album_artist(); ?></h1>
          <h2 class="post--title"><?php echo get_album_title() . get_album_year(); ?></h2>
          <p class="post--info"><span class="<?php genre_count(); ?>"><?= get_the_term_list($post, 'genres', '', ', ');?> | </span><?= get_the_date("n.j.Y"); ?></p>
        </div>

        <div class="post--content">
          <?php
            the_content();
          ?>
        </div>
        <div class="post--tags">
          <p><strong>Tags:</strong> 
          
          <?php if(false){ ?>
          <?php
          $relatedArtists = get_field('related-artists');
          $before = '';
          if ($relatedArtists) {
            $before = ', ';
            $artistLength = count($relatedArtists);

            foreach($relatedArtists as $artist) { ?>
              <a class="bold-italic" href="<?=get_the_permalink($artist);?>"><?=get_the_title($artist);?></a>
            <?php
              if ($artistLength > 1) echo ", ";
              $artistLength -= 1;
            }
          }
          echo $before; ?>
          <?php } ?>

          <?php
          echo the_tags('', ', ', ', ');
          echo get_the_term_list($post, 'genres', '', ', ', ', ');
          echo get_the_term_list($post, 'years', '', ', ');
          ?></p>
        </div>
      </div>
    </div>
  <?php }; ?>

  <?php
  if ( comments_open() || get_comments_number() ) :
    comments_template();
  endif;
  ?>
    
  </div>

  <div class="related">
    <?php
    $orig_post = $post;
    global $post;
    $post_not_in = [$post->ID];
    $count = 4;

    if ($relatedArtists) {
      $artist_ids = array();
      // get the tag ids
      foreach ($relatedArtists as $individual_artist) {
        $artist_id = $individual_artist->ID;

        $artist_args = array(
          'post_type' => 'post',
          'meta_key' => 'related-artists',
          'post__not_in' => $post_not_in,
          'posts_per_page' => $count,
          'ignore_sticky_posts' => 1,
          'meta_query' => [
            'key' => 'related-artists',
            'compare' => 'LIKE',
            'value' => $artist_id
          ]
        );

        $artist_query = new WP_Query($artist_args);
        $count -= $artist_query->found_posts;
        if ($artist_query->have_posts()) {

          while ($artist_query->have_posts()) {
            $artist_query->the_post();
            $post_not_in[] = $post->ID;
            get_template_part('template-parts/content', 'related', array(
              'phrase' => 'Also featuring ',
              'shared' => $individual_artist->post_title
            ));
          }
        }
        wp_reset_query();
      }
    }
    
    // find all tags on post
    $tags = wp_get_post_tags($post->ID);

    // if there are tags
    if ($tags) {
      $tag_ids = array();
      // get the tag ids
      foreach ($tags as $individual_tag) {
        $tag_id = $individual_tag->term_id;

        $tag_args = array(
          'post_type' => 'post',
          'tag_id' => $tag_id,
          'post__not_in' => $post_not_in,
          'posts_per_page' => $count,
          'ignore_sticky_posts' => 1
        );

        $tag_query = new WP_Query($tag_args);
        $count -= $tag_query->found_posts;
        if ($tag_query->have_posts()) {

          while ($tag_query->have_posts()) {
            $tag_query->the_post();
            $post_not_in[] = $post->ID;
            get_template_part('template-parts/content', 'related', array(
              'phrase' => 'Also featuring ',
              'shared' => $individual_tag->name
            ));
          }
        }
        wp_reset_query();
      }
    }

    if ($count > 0) {
      $genres = get_the_terms($post, 'genres');
      if ($genres) {
        $genre_ids = array();
        foreach ($genres as $individual_genre) {
          $genre_id = $individual_genre->term_id;
  
          $genre_args = array(
            'post_type' => 'post',
            'post__not_in' => $post_not_in,
            'posts_per_page' => $count,
            'ignore_sticky_posts' => 1,
            'tax_query' => array(
              array(
                'taxonomy' => 'genres',
                'field' => 'term_id',
                'terms' => $genre_id
              )
            )
          );
  
          $genre_query = new WP_Query($genre_args);
          $count -= $genre_query->found_posts;
          if ($genre_query->have_posts()) {
  
            while ($genre_query->have_posts()) {
              $genre_query->the_post();
              $post_not_in[] = $post->ID;
              get_template_part('template-parts/content', 'related', array(
                'phrase' => 'Also ',
                'shared' => $individual_genre->name,
              ));
            }
          }
          wp_reset_query();
        }
      }
    }

    if ($count > 0) {
      $years = get_the_terms($post, 'years');
      if ($years) {
        $year_ids = array();
        foreach ($years as $individual_year) {
          $year_id = $individual_year->term_id;
      
          $year_args = array(
            'post_type' => 'post',
            'post__not_in' => $post_not_in,
            'posts_per_page' => $count,
            'ignore_sticky_posts' => 1,
            'tax_query' => array(
              array(
                'taxonomy' => 'years',
                'field' => 'term_id',
                'terms' => $year_id,
                'include_children' => false
              )
            )
          );
  
          $year_query = new WP_Query($year_args);
          $count -= $year_query->found_posts;
          if ($year_query->have_posts()) {
            while ($year_query->have_posts()) {
              $year_query->the_post();
              $post_not_in[] = $post->ID;
              get_template_part('template-parts/content', 'related', array(
                'phrase' => 'Also from ',
                'shared' => $individual_year->name,
              ));
            }
          }
          wp_reset_query();
        }
      }
    }
  
    $post = $orig_post;
    ?>
  </div>
</div>

<?php

get_footer();

?>