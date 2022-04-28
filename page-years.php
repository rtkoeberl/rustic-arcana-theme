<?php
  get_header();
?>

<div class="container container--grid page years">
    <div class="post">
      <div class="post--body">
        <h2 class="post--title page--title">Years</h2>
        <div class="post--content">
          <ul class="year--list">
            <?= wp_list_categories(array(
              'taxonomy' => 'years',
              'hide_empty' => false,
              'title_li' => ''
            )); ?>
          </ul>
        </div>
      </div>
    </div>
</div>

<?php

get_footer();

?>