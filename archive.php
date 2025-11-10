<?php
/**
 * Plantilla para mostrar archivos de categorías y taxonomías
 *
 * @package Ferrocarril_Esp
 */

get_header(); ?>

<main class="main">
    <div class="container">
        <div class="content-wrapper">
            <div class="content-left">
                <header class="archive-header">
                    <?php
                    the_archive_title('<h1 class="archive-title">', '</h1>');
                    the_archive_description('<div class="archive-description">', '</div>');
                    ?>
                </header>

                <?php if (have_posts()) : ?>
                    <div class="posts-grid">
                        <?php while (have_posts()) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <header class="entry-header">
                                    <h2 class="entry-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <div class="entry-meta">
                                        <span class="posted-on">📅 <?php echo get_the_date(); ?></span>
                                        <span class="byline">👤 <?php the_author(); ?></span>
                                    </div>
                                </header>

                                <div class="entry-summary">
                                    <?php the_excerpt(); ?>
                                </div>

                                <footer class="entry-footer">
                                    <div class="entry-categories">
                                        <?php the_category(', '); ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="read-more">Leer más →</a>
                                </footer>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <?php
                    the_posts_pagination(array(
                        'prev_text' => '← Anterior',
                        'next_text' => 'Siguiente →',
                        'mid_size' => 2,
                    ));
                    ?>

                <?php else : ?>
                    <div class="no-posts-found">
                        <h2>No se encontraron entradas</h2>
                        <p>No hay contenido disponible en esta sección todavía.</p>
                        <p><a href="<?php echo esc_url(home_url()); ?>" class="btn">← Volver al inicio</a></p>
                    </div>
                <?php endif; ?>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
