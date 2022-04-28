<?php
  get_header();
?>

<div class="container container--grid front-page">
  <!-- 3 Large Posts -->
  <?php
  $postsLarge = new WP_Query([
    'posts_per_page' => 3
  ]);

  while ($postsLarge->have_posts()) {
    $postsLarge->the_post();
    get_template_part('template-parts/content', 'postlg');
  }
  wp_reset_postdata(); ?>

  <!-- 5 Medium Posts -->
  <?php
  $postsMedium = new WP_Query([
    'posts_per_page' => 5,
    'offset' => 3
  ]);

  while ($postsMedium->have_posts()) {
    $postsMedium->the_post();
    get_template_part('template-parts/content', 'postmd');
  }
  wp_reset_postdata(); ?>

  <!-- 4 Small Posts -->
  <?php
  $postsSmall = new WP_Query([
    'posts_per_page' => 4,
    'offset' => 8
  ]);

  while ($postsSmall->have_posts()) {
    $postsSmall->the_post();
    get_template_part('template-parts/content', 'postsm');
  }
  wp_reset_postdata(); ?>

  <div class="preview post-sm infobox">
    <div class="preview--body">
    <div class="preview--content">
      <p><b>Pretty Good Not Bad</b> is a blog about musical discovery: deep cuts, hidden gems, and overlooked treasures. From bargain bin records to vintage reissues, read on in the hopes of hearing something new.</p>
    </div>
    </div>
  </div>
</div>

<?php

get_footer();

?>