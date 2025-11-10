<?php
/**
 * Custom Taxonomías y relaciones para Ferrocarril Esp
 *
 * @package Ferrocarril_Esp
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registrar taxonomías personalizadas: Ciudad
 */
function ferrocarril_register_taxonomies() {
    register_taxonomy(
        'ciudad',
        array('post', 'ferroblog_linea', 'ferroblog_proyecto', 'ferroblog_estacion', 'ferroblog_event'),
        array(
            'label'        => 'Ciudades',
            'hierarchical' => true, // Permite subciudades si deseas en el futuro
            'show_in_rest' => true,
            'rewrite'      => array('slug' => 'ciudad'),
        )
    );
}
add_action('init', 'ferrocarril_register_taxonomies');

/**
 * Añadir 20 ciudades españolas importantes (primera letra en mayúscula) al activar el tema
 */
function ferrocarril_insert_default_ciudades() {
    $ciudades = ['Madrid','Barcelona','Valencia','Sevilla','Bilbao','A Coruña','Zaragoza','Málaga','Oviedo','Murcia','Palma de Mallorca','Las Palmas de Gran Canaria','Alicante','Córdoba','Valladolid','Vigo','Gijón','Granada','Santander','Pamplona'];
    foreach ($ciudades as $ciudad) {
        if (!term_exists($ciudad, 'ciudad')) {
            wp_insert_term($ciudad, 'ciudad');
        }
    }
}
add_action('after_switch_theme', 'ferrocarril_insert_default_ciudades');

/**
 * Filtrar búsqueda en sidebar para solo filtrar ciudades en Noticias y todos los CPTs ferroviarios
 */
function ferrocarril_get_filtered_city_posts($term_slug, $post_types = ['post', 'ferroblog_linea', 'ferroblog_proyecto', 'ferroblog_estacion', 'ferroblog_event']) {
    $args = [
        'post_type' => $post_types, // Noticias y todos los CPTs ferroviarios
        'tax_query' => [
            [
                'taxonomy' => 'ciudad',
                'field'    => 'slug',
                'terms'    => $term_slug,
            ],
        ],
        'posts_per_page' => 10,
        'post_status' => 'publish',
    ];
    return get_posts($args);
}
