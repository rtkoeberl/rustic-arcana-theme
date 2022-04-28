<?php
  get_header();
?>

<div class="post-container">
  index
<?php
  while(have_posts()) {
    the_post(); ?>
    <div class="post-content">
      <h2 class="title"><a href="<?= the_permalink(); ?>"><?php echo str_replace(' | ', '<br />', get_the_title()); ?></a></h2>
      <div class="metabox">
        <p><?php the_time('n.j.y'); ?> | <?= get_the_category_list(', '); ?></p>
      </div>
      
      <div class="">

        <?php
          if ( has_post_thumbnail() ) {
            the_post_thumbnail();
          }
        
        the_content(); ?>

      </div>
    </div>
<?php }; ?>
  <div class="post-related">
    
  </div>
</div>

<?php

get_footer();

?>