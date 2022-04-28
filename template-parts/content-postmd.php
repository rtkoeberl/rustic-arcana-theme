<div class="preview post-md">
  <div class="preview--image">
    <?php
    if ( has_post_thumbnail() ) {
      ?>
      <a href="<?= the_permalink(); ?>"><?php the_post_thumbnail('previewMedium'); ?></a>
      <?php
    }
    ?>
  </div>
  <div class="preview--body">

    <div class="preview--content">
      <div class="preview--metabox">
        <h3 class="preview--artist"><a href="<?= the_permalink(); ?>"><?php echo get_album_artist(); ?></a></h3>
        <h5 class="preview--title"><a href="<?= the_permalink(); ?>"><?php echo get_album_title() . get_album_year(); ?></a></h5>
        <p class="preview--info"><?= get_the_term_list($post, 'genres', '', ', ');?> | <?= get_the_date("n.j.Y"); ?></p>
      </div>
      <?php        
        echo get_medium_excerpt();
      ?>
    </div>

    <div class="read-more">
      <div><a href="<?= the_permalink(); ?>">Read More &raquo;</a></div>
    </div>
    
  </div>
</div>