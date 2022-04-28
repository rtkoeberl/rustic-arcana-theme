<?php
  get_header();
?>

<div class="container container--grid page">
<?php
  while(have_posts()) {
    the_post(); ?>
    <div class="post">
      <div class="post--body">
        <h2 class="post--title"><a href="<?= the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="post--content">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  <?php };
  echo paginate_links();
?>
</div>

<?php

get_footer();

?>