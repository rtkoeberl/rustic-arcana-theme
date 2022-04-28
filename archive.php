<?php
get_header();
?>

<div class="container archive">

  <div class="archive--headline">
    <h2>Results for <?=get_the_archive_title();?></h2>
  </div>

  <div class="container--grid archive--grid">
    <?php
      while(have_posts()) {
        the_post();
        get_template_part('template-parts/content', 'postmd');
      }
    ?>
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