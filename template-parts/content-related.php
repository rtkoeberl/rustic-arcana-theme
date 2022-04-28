<div class="related--box">
  <?php
    if ($args['phrase'] && $args['shared']) {
      echo '<div class="related--cat">'.$args['phrase'].$args['shared'].'...</div>';
    }
  ?>
  <div class="related--post">
    <div class="preview--image">
      <?php
      if ( has_post_thumbnail() ) {
        ?>
        <a href="<?= the_permalink(); ?>"><?php the_post_thumbnail('previewSmall'); ?></a>
        <?php
      }
      ?>
    </div>
    <div class="preview--body">
      
      <div class="preview--metabox">
        <h5 class="preview--artist"><a href="<?= the_permalink(); ?>"><?php echo get_album_artist(); ?></a></h5>
        <h5 class="preview--title"><a href="<?= the_permalink(); ?>"><?php echo get_album_title() . get_album_year(); ?></a></h5>
      </div>
      <div class="preview--content">
        <?php
        if (the_excerpt()) {
          the_excerpt();
        }
        
        ?>
        <div class="read-more"><div><a href="<?= the_permalink(); ?>">Read More &raquo;</a></div></div>
      </div>
    </div>
  </div>
</div>