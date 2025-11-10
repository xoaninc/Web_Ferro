<?php
/**
 * Functions.php para el tema Ferrocarril Esp
 * Mantiene la estructura estática del HTML original con mejoras de WordPress
 */

if (!defined('ABSPATH')) {
    exit;
}

// ==================================================================================
// INCLUIR ARCHIVOS ADICIONALES
// ==================================================================================
require get_template_directory() . '/inc/custom-post-types.php';
require get_template_directory() . '/inc/custom-nav-walker.php';
require get_template_directory() . '/inc/custom-taxonomies.php';
if (file_exists(get_template_directory() . '/inc/event-post-type.php')) {
    require get_template_directory() . '/inc/event-post-type.php';
}
if (file_exists(get_template_directory() . '/inc/event-api-sync.php')) {
    require get_template_directory() . '/inc/event-api-sync.php';
}

// ==================================================================================
// CONFIGURACIÓN BÁSICA DEL TEMA
// ==================================================================================
function ferrocarril_esp_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('ferrocarril-featured', 800, 450, true);
    add_image_size('ferrocarril-thumbnail', 300, 200, true);
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('site-title', 'site-description'),
    ));
    register_nav_menus(array(
        'primary'     => 'Menú Principal',
        'quick-links' => 'Enlaces Rápidos Sidebar',
        'footer'      => 'Menú Footer',
    ));
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array(
        'search-form','comment-form','comment-list','gallery','caption','script','style',
    ));
    add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'ferrocarril_esp_setup');

// ==================================================================================
// MAPEO DE CATEGORÍAS HTML-WORDPRESS
// ==================================================================================
function get_category_mapping() {
    return array(
        'ancho_iberico' => 'ancho-iberico',
        'ancho_metrico' => 'ancho-metrico',
        'ancho_internacional' => 'ancho-internacional',
        'lineas_cerradas' => 'lineas-cerradas',
        'proyectos_cancelados' => 'proyectos-cancelados',
        'proyectos_actuales' => 'proyectos-actuales',
        'proyectos_en_marcha' => 'proyectos-en-marcha',
        'proyectos_estudio' => 'proyectos-en-estudio',
        'noticias' => 'noticias',
        'metro' => 'metro',
        'tram' => 'tranvia',
        'ave' => 'ave',
        'cercanias' => 'cercanias',
        'apertura_linea' => 'apertura-linea',
        'inicio_obras' => 'inicio-obras',
        'fin_obras' => 'fin-obras',
        'evento_especial' => 'evento-especial',
        'mantenimiento' => 'mantenimiento',
        'aniversario' => 'aniversario',
        'cambio_horarios' => 'cambio-horarios',
        // Ciudades (ejemplo extendido)
        'madrid' => 'Madrid','barcelona' => 'Barcelona','valencia' => 'Valencia','sevilla' => 'Sevilla','bilbao' => 'Bilbao','a_coruna' => 'A Coruña','zaragoza' => 'Zaragoza','malaga' => 'Málaga','oviedo' => 'Oviedo','murcia' => 'Murcia','palma_de_mallorca' => 'Palma de Mallorca','las_palmas_de_gran_canaria' => 'Las Palmas de Gran Canaria','alicante' => 'Alicante','cordoba' => 'Córdoba','valladolid' => 'Valladolid','vigo' => 'Vigo','gijon' => 'Gijón','granada' => 'Granada','santander' => 'Santander','pamplona' => 'Pamplona',
    );
}

// ==================================================================================
// FUNCIONES AUXILIARES PARA CATEGORÍAS
// ==================================================================================
function ferrocarril_get_category_link($cat_name) {
    $category = get_category_by_slug(sanitize_title($cat_name));
    if ($category) {
        return get_category_link($category->term_id);
    }
    return home_url();
}

// ==================================================================================
// ENQUEUE SCRIPTS Y STYLES ACTUALIZADO
// ==================================================================================
function ferrocarril_esp_scripts() {
    wp_enqueue_style('ferrocarril-style', get_template_directory_uri() . '/assets/css/styles.css', array(), '1.0.2');
    	wp_enqueue_style('ferrocarril-wp-style', get_template_directory_uri() . '/assets/css/wp-style.css', array('ferrocarril-style'), '1.0.2');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap', array(), null);
    if (is_page_template('plantilla-informacion.php')) {
        wp_enqueue_style('informacion-specific', get_template_directory_uri() . '/informacion/informacion-styles.css', array('ferrocarril-style'), '1.0.0');
    }
    if (is_page_template('noticia.php')) {
        wp_enqueue_style('noticia-specific', get_template_directory_uri() . '/noticias/noticia-styles.css', array('ferrocarril-style'), '1.0.0');
    }
    wp_enqueue_script('ferrocarril-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0.1', true);
    wp_enqueue_script('ferrocarril-wp-search', get_template_directory_uri() . '/assets/js/wp-search.js', array('jquery', 'ferrocarril-script'), '1.0.1', true);
    wp_enqueue_script('ferrocarril-config', get_template_directory_uri() . '/assets/js/config.js', array(), '1.0.1', true);
    wp_localize_script('ferrocarril-wp-search', 'ferrocarril_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ferrocarril_search'),
        'home_url' => home_url()
    ));
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'ferrocarril_esp_scripts');

// ==================================================================================
// WIDGETS Y SIDEBARS
// ==================================================================================
function ferrocarril_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar Principal', 'ferrocarril-esp'),
        'id'            => 'sidebar-1',
        'description'   => __('Añade widgets aquí.', 'ferrocarril-esp'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'ferrocarril_widgets_init');

// ==================================================================================
// AJAX SEARCH HANDLER
// ==================================================================================
function ferrocarril_ajax_search() {
    check_ajax_referer('ferrocarril_search', 'nonce');
    $search_term = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    if (empty($search_term)) {
        wp_send_json_error(array('message' => 'Término de búsqueda vacío'));
        return;
    }
    $args = array(
        's' => $search_term,
        'posts_per_page' => 10,
        'post_type' => array('post', 'ferroblog_event'),
        'orderby' => 'relevance',
    );
    $query = new WP_Query($args);
    $results = array();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $results[] = array(
                'title' => get_the_title(),
                'url' => get_permalink(),
                'excerpt' => wp_trim_words(get_the_excerpt(), 20),
                'date' => get_the_date(),
                'type' => get_post_type(),
            );
        }
        wp_reset_postdata();
    }
    wp_send_json_success(array('results' => $results));
}
add_action('wp_ajax_ferrocarril_search', 'ferrocarril_ajax_search');
add_action('wp_ajax_nopriv_ferrocarril_search', 'ferrocarril_ajax_search');

// ==================================================================================
// CUSTOM EXCERPT LENGTH
// ==================================================================================
function ferrocarril_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'ferrocarril_excerpt_length');
function ferrocarril_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'ferrocarril_excerpt_more');

// ==================================================================================
// BREADCRUMBS
// ==================================================================================
function ferrocarril_breadcrumbs() {
    if (is_front_page()) {
        return;
    }
    echo '<nav class="breadcrumbs">';
    echo '<a href="' . home_url() . '">🏠 Inicio</a> » ';
    if (is_category() || is_single()) {
        the_category(' » ');
        if (is_single()) {
            echo ' » ' . get_the_title();
        }
    } elseif (is_page()) {
        echo get_the_title();
    } elseif (is_search()) {
        echo 'Resultados de búsqueda para: ' . get_search_query();
    } elseif (is_404()) {
        echo 'Error 404';
    }
    echo '</nav>';
}

// ==================================================================================
// CUSTOMIZER SETTINGS
// ==================================================================================
function ferrocarril_customize_register($wp_customize) {
    $wp_customize->add_section('ferrocarril_colors', array(
        'title' => __('Colores del Tema', 'ferrocarril-esp'),
        'priority' => 30,
    ));
    $wp_customize->add_setting('ferrocarril_primary_color', array(
        'default' => '#f0dfd0',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ferrocarril_primary_color', array(
        'label' => __('Color Principal', 'ferrocarril-esp'),
        'section' => 'ferrocarril_colors',
        'settings' => 'ferrocarril_primary_color',
    )));
}
add_action('customize_register', 'ferrocarril_customize_register');

// ==================================================================================
// SECURITY ENHANCEMENTS
// ==================================================================================
remove_action('wp_head', 'wp_generator');
add_filter('xmlrpc_enabled', '__return_false');
function ferrocarril_remove_version_scripts_styles($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'ferrocarril_remove_version_scripts_styles', 9999);
add_filter('script_loader_src', 'ferrocarril_remove_version_scripts_styles', 9999);
