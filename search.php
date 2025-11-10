<?php
/**
 * Plantilla para mostrar resultados de búsqueda
 *
 * @package Ferrocarril_Esp
 */

get_header(); ?>

<main class="main">
    <div class="container">
        <div class="content-wrapper">
            <div class="content-left">
                <header class="page-header search-header">
                    <h1 class="page-title">
                        <?php
                        printf(
                            'Resultados de búsqueda para: %s',
                            '<span class="search-query">' . get_search_query() . '</span>'
                        );
                        ?>
                    </h1>
                    <?php
                    global $wp_query;
                    if ($wp_query->found_posts > 0) {
                        echo '<p class="search-results-count">Se encontraron ' . $wp_query->found_posts . ' resultado(s)</p>';
                    }
                    ?>
                </header>

                <?php if (have_posts()) : ?>
                    <div class="search-results-list">
                        <?php while (have_posts()) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="result-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('thumbnail'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="result-content">
                                    <h3 class="result-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    
                                    <div class="result-meta">
                                        <span class="result-date">📅 <?php echo get_the_date(); ?></span>
                                        <span class="result-author">👤 <?php the_author(); ?></span>
                                        <?php if (get_the_category()) : ?>
                                            <span class="result-categories">
                                                🏷️ <?php the_category(', '); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="result-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <a href="<?php the_permalink(); ?>" class="result-read-more">Leer más →</a>
                                </div>
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
                    <div class="no-results">
                        <h2>❌ No se encontraron resultados</h2>
                        <p>Lo sentimos, pero no se encontraron resultados para tu búsqueda.</p>
                        <p>Intenta con otros términos de búsqueda:</p>
                        
                        <div class="search-form-wrapper">
                            <?php get_search_form(); ?>
                        </div>

                        <div class="search-suggestions">
                            <h3>Sugerencias:</h3>
                            <ul>
                                <li>Verifica que las palabras estén escritas correctamente</li>
                                <li>Intenta con sinónimos o términos relacionados</li>
                                <li>Usa palabras más generales</li>
                                <li>Reduce el número de palabras clave</li>
                            </ul>
                        </div>

                        <div class="popular-categories">
                            <h3>Explora nuestras categorías populares:</h3>
                            <div class="categories-list">
                                <?php
                                $popular_categories = array('Noticias', 'AVE', 'Metro', 'Ancho Ibérico');
                                foreach ($popular_categories as $cat_name) {
                                    $category = get_category_by_slug(sanitize_title($cat_name));
                                    if ($category) {
                                        echo '<a href="' . get_category_link($category->term_id) . '" class="category-link">' . $cat_name . '</a>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>