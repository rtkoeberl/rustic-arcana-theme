<div class="preview post-lg">
  <div class="preview--image">
    <?php
    if ( has_post_thumbnail() ) {
      ?>
      <a href="<?= the_permalink(); ?>"><?php the_post_thumbnail('previewLarge'); ?></a>
      <?php
    }
    ?>
  </div>
  <div class="preview--body">
    
    <div class="preview--content">
      <div class="preview--metabox">
        <h2 class="preview--artist"><a href="<?= the_permalink(); ?>"><?php echo get_album_artist(); ?></a></h2>
        <h4 class="preview--title"><a href="<?= the_permalink(); ?>"><?php echo get_album_title() . get_album_year(); ?></a></h4>
        <p class="preview--info"><?= get_the_term_list($post, 'genres', '', ', ');?> | <?= get_the_date("n.j.Y"); ?></p>
      </div>

      <?php
        echo get_first_paragraph();
      ?>
    </div>

    <div class="read-more">
      <div><a href="<?= the_permalink(); ?>">Read More &raquo;</a></div>
    </div>
    
  </div>
</div>