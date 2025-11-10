<?php
/*
Template Name: Plantilla Información
*/
get_header();
?>
<article class="informacion-article">
    <header class="article-header">
        <h1 class="article-title"><?php the_title(); ?></h1>
        <div class="article-meta">
            <span class="article-date">📅 <?php the_time('j \d\e F \d\e Y'); ?></span>
            <span class="article-author">👤 <?php the_author(); ?></span>
        </div>
    </header>
    <div class="article-description">
        <?php the_excerpt(); ?>
    </div>
    <div class="article-image">
        <?php if(has_post_thumbnail()): ?>
            <?php the_post_thumbnail('large', ['class' => 'main-image']); ?>
        <?php endif; ?>
        <!-- Opcional: pie de foto -->
        <p class="image-caption"><?php echo get_post_meta(get_the_ID(), '_pie_foto', true); ?></p>
    </div>
    <div class="article-content">
        <?php the_content(); ?>
    </div>
    <div class="article-copyright">
        <p><strong>© <?php echo date('Y'); ?> Blog Ferrocarril Esp.</strong> Todos los derechos reservados.</p>
    </div>
    <div class="article-categories">
        <h3>Categorías:</h3>
        <div class="categories-list">
            <?php the_category(' '); ?>
        </div>
    </div>
</article>
<?php get_footer(); ?>
