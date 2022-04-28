<?php
  get_header();
?>

<div class="container container--grid page genre">
    <div class="post">
      <div class="post--body">
        <h2 class="post--title page--title">Genres</h2>
        <div class="post--content genre--columns">
          <ul class="genre--list">
            <?= wp_list_categories(array(
              'taxonomy' => 'genres',
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