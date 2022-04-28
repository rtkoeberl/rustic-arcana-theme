<footer class="footer">
  <div class="footer--container">
    <div class="footer--column footer--headline">
      <p class="italic"><span>Pretty Good Not Bad</span>, 2022</p>
      <p><a class="italic" href="https://github.com/rtkoeberl/rusticarcana" target="_blank">Rustic Arcana</a> theme by <a href="https://rosskoeberl.online/" target="_blank">Ross Koeberl</a></p>
      <p><a href="<?=site_url();?>">Home</a> | <a href="<?=get_permalink( get_page_by_path( 'about' ) );?>">About</a></p>
    </div>
    <div class="footer--column">
      <ul>
        <li class="footer--cat">Read</li>
        <!-- <li><a href="<?=site_url();?>">Home</a></li> -->
        <!-- <li><a href="<?=get_permalink( get_page_by_path( 'about' ) );?>">About</a></li> -->
        <li><a href="<?= get_category_link(2) ?>">Albums</a></li>
        <li><a href="<?= get_category_link(4) ?>">Features</a></li>
      </ul>
    </div>
    <div class="footer--column">
      <ul>
        <li class="footer--cat">Browse</li>
        <li><a href="<?=get_permalink( get_page_by_path( 'years' ) );?>">Years</a></li>
        <li><a href="<?=get_permalink( get_page_by_path( 'genres' ) );?>">Genres</a></li>
        <!-- <li><a href="<?=get_permalink( get_page_by_path( 'artists' ) );?>">Artists</a></li> -->
        <!-- <li><a href="<?=get_permalink( get_page_by_path( 'instrument' ) );?>">Instruments</a></li> -->
      </ul>
    </div>
  </div>
  
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>

      