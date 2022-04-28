<?php
  get_header();

  $genre = get_queried_object();
  $parentGenre = get_term_by('id', $genre->parent, 'genres');
  $parent = $parentGenre ? $parentGenre : $genre;

  if ($parent) {
    $args = array(
      'taxonomy'               => 'genres',
      'orderby'                => 'name',
      'order'                  => 'ASC',
      'hide_empty'             => false,
      'child_of'               => $parent->term_id
    );
    $childrenArr = new WP_Term_Query($args);
    $children = $childrenArr->get_terms();
  }
  
?>

<div class="container archive genre">

  <div class="archive--headline">
    <h2><?=get_the_archive_title();?></h2>
    <p><?=get_the_archive_description();?></p>
  </div>

  <div class="container--grid genre--grid">

    <?php
      $genrePosts = new WP_Query([
        'posts_per_page' => 12,
        'post_type' => 'post',
        'tax_query' => array(
          array(
            'taxonomy' => 'genres',
            'field' => 'term_id',
            'terms' => $genre->term_id,
            'include_children' => true
          )
        )
      ]);

      while ($genrePosts->have_posts()) {
        $genrePosts->the_post();
        get_template_part('template-parts/content', 'postmd');
      }
      wp_reset_postdata();
    ?>

    <div class="preview post-lg genre--tree">
      <div class="preview--body">
        <div class="preview--content">
          <h5 class="genre-list--header">Genre Navigation</h5>
          <ul class="genre--list">
            <li><a href="<?=get_term_link($parent);?>"><?=$parent->name;?></a><ul>
            <?php foreach($children as $child) { ?>
              <li class="<?php if ($child->term_id == $genre->term_id) { echo 'bold-italic'; }?>">
                <a href="<?=get_term_link($child);?>"><?=$child->name;?></a>
            </li>
            <?php } ?>
            </ul></li>
            <?= wp_list_categories(array(
              'taxonomy' => 'genres',
              'hide_empty' => true,
              'exclude' => $parent->term_id,
              'title_li' => '',
              'number' => 7,
              'depth' => 1
            )); ?>
          </ul>
          <p><a href='<?=get_permalink( get_page_by_path( 'Genres' ) );?>'>Click here</a> to view all genres</p>
        </div>
      </div>
    </div>

  </div>

  <div class="archive--paginate">
    <?php
      echo paginate_links();
    ?>
  </div>
  
</div>

<?php

get_footer();

?>