<?php
  get_header();
?>

<div class="container post-container">
<?php
  while(have_posts()) {
    the_post(); ?>
    <div class="">
      <h2 class=""><a href="<?= the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <div class="metabox">
        <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('n.j.y'); ?> in <?= get_the_category_list(', '); ?></p>
      </div>
      <div class="">
        <?php the_excerpt(); ?>
        <p><a class="btn" href="<?= the_permalink(); ?>">Continue Reading &raquo;</a></p>
      </div>
    </div>
  <?php };
  echo paginate_links();
?>
</div>

<?php

get_footer();

?>