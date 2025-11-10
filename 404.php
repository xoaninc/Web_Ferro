<?php
/**
 * Plantilla para página de error 404
 *
 * @package Ferrocarril_Esp
 */

get_header(); ?>

<main class="main">
    <div class="container">
        <div class="content-wrapper">
            <div class="content-left">
                <section class="error-404 not-found">
                    <header class="page-header">
                        <h1 class="page-title">🚂 ¡Vaya! Página no encontrada</h1>
                    </header>

                    <div class="page-content">
                        <p class="error-message">
                            Parece que este tren se ha desviado de la vía. La página que buscas no existe o ha sido movida.
                        </p>

                        <div class="error-search">
                            <h3>🔍 Busca lo que necesitas:</h3>
                            <?php get_search_form(); ?>
                        </div>

                        <div class="error-suggestions">
                            <h3>📍 ¿Qué tal si pruebas estas secciones?</h3>
                            <div class="suggestions-grid">
                                <div class="suggestion-card">
                                    <h4>🚆 Líneas</h4>
                                    <ul>
                                        <?php
                                        $lineas_cats = array('Ancho Ibérico', 'Ancho Métrico', 'Ancho Internacional');
                                        foreach ($lineas_cats as $cat_name) {
                                            $category = get_category_by_slug(sanitize_title($cat_name));
                                            if ($category) {
                                                echo '<li><a href="' . get_category_link($category->term_id) . '">' . $cat_name . '</a></li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>

                                <div class="suggestion-card">
                                    <h4>📋 Proyectos</h4>
                                    <ul>
                                        <?php
                                        $proyectos_cats = array('Proyectos Actuales', 'Proyectos en Marcha', 'Proyectos en Estudio');
                                        foreach ($proyectos_cats as $cat_name) {
                                            $category = get_category_by_slug(sanitize_title($cat_name));
                                            if ($category) {
                                                echo '<li><a href="' . get_category_link($category->term_id) . '">' . $cat_name . '</a></li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>

                                <div class="suggestion-card">
                                    <h4>📰 Noticias</h4>
                                    <ul>
                                        <?php
                                        $noticias_cats = array('Noticias', 'AVE', 'Metro', 'Cercanías');
                                        foreach ($noticias_cats as $cat_name) {
                                            $category = get_category_by_slug(sanitize_title($cat_name));
                                            if ($category) {
                                                echo '<li><a href="' . get_category_link($category->term_id) . '">' . $cat_name . '</a></li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>

                                <div class="suggestion-card">
                                    <h4>🏛️ Ciudades</h4>
                                    <ul>
                                        <?php
                                        $ciudades_cats = array('Madrid', 'Barcelona', 'Sevilla', 'Valencia', 'Bilbao');
                                        foreach ($ciudades_cats as $cat_name) {
                                            $category = get_category_by_slug(sanitize_title($cat_name));
                                            if ($category) {
                                                echo '<li><a href="' . get_category_link($category->term_id) . '">' . $cat_name . '</a></li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="error-home-link">
                            <a href="<?php echo esc_url(home_url()); ?>" class="btn btn-primary">
                                ← Volver a la estación principal
                            </a>
                        </div>

                        <div class="recent-posts-404">
                            <h3>🔥 Últimas noticias ferroviarias</h3>
                            <div class="recent-posts-grid">
                                <?php
                                $recent_posts = wp_get_recent_posts(array(
                                    'numberposts' => 3,
                                    'post_status' => 'publish'
                                ));
                                
                                foreach ($recent_posts as $recent) {
                                    echo '<div class="recent-post-item">';
                                    echo '<h4><a href="' . get_permalink($recent['ID']) . '">' . $recent['post_title'] . '</a></h4>';
                                    echo '<p class="post-date">' . get_the_date('d/m/Y', $recent['ID']) . '</p>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
