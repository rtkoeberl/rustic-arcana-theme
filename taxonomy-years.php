<?php
  get_header();

  $year = get_queried_object();
  $parentDecade = get_term_by('id', $year->parent, 'years');

  if ($parentDecade) {
    $yearInt = (int)$year->name;
    $previous = get_term_by('slug', $yearInt-1, 'years');
    $next = get_term_by('slug', $yearInt+1, 'years');
    console_log($next);
  }
  

  if (!$parentDecade) {
    $args = array(
      'taxonomy'               => 'years',
      'orderby'                => 'name',
      'order'                  => 'ASC',
      'hide_empty'             => false,
      'child_of'               => $year->term_id
    );
    $the_query = new WP_Term_Query($args);
    console_log($the_query->get_terms());
  }
  
?>

<div class="container archive year">

  <div class="year--headline">
    <div class="yearscroll">
      <div class="previousYear">
        <?php if ($previous) { ?>
          <a href=<?=get_term_link($previous, 'years');?>>
            <h4>&#171; <?=$previous->name;?></h4>
          </a>
        <?php }?>
      </div>

      <div class="currentYear">
      <h2><?=get_the_archive_title();?></h2>
      </div>

      <div class="nextYear">
        <?php if ($next) { ?>
          <a href=<?=get_term_link($next, 'years');?>>
            <h4><?=$next->name;?> &#187;</h4>
          </a>
        <?php }?>
      </div>
    </div>

    <div class="decade">
      <?php if ($parentDecade) {?>
        <a href=<?=get_term_link($parentDecade, 'years');?>>&hookrightarrow;&#xFE0E; <?=$parentDecade->name;?></a>
      <?php } else { foreach($the_query->get_terms() as $term){ ?>
        <a href=<?=get_term_link($term, 'years');?>><?=$term->name;?></a>
      <?php } }?>  
    </div>

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