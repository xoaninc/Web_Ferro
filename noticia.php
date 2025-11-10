<?php
/*
Template Name: Noticia
*/
get_header();
?>
<div class="noticia-content">
  <h1><?php the_title(); ?></h1>
  <div class="entry-content">
    <?php the_content(); ?>
  </div>
  <div class="noticia-meta">
    <span><?php the_date(); ?></span> | <span><?php the_author(); ?></span>
  </div>
</div>
<?php get_footer(); ?>
