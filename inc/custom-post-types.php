<?php
/**
 * Custom Post Types para el tema Ferrocarril Esp
 * 
 * Define tipos de contenido personalizados para:
 * - Líneas ferroviarias
 * - Proyectos
 * - Estaciones
 *
 * @package Ferrocarril_Esp
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registrar Custom Post Types y Taxonomías
 */
function ferrocarril_register_post_types() {
    // ==================================================================================
    // CUSTOM POST TYPE: LÍNEAS
    // ==================================================================================
    $linea_labels = array(
        'name'                  => 'Líneas',
        'singular_name'         => 'Línea',
        'menu_name'             => 'Líneas',
        'name_admin_bar'        => 'Línea',
        'add_new'               => 'Añadir Línea',
        'add_new_item'          => 'Añadir Nueva Línea',
        'new_item'              => 'Nueva Línea',
        'edit_item'             => 'Editar Línea',
        'view_item'             => 'Ver Línea',
        'all_items'             => 'Todas las Líneas',
        'search_items'          => 'Buscar Líneas',
        'parent_item_colon'     => 'Línea Padre:',
        'not_found'             => 'No se encontraron líneas',
        'not_found_in_trash'    => 'No hay líneas en la papelera',
        'featured_image'        => 'Imagen destacada',
        'set_featured_image'    => 'Establecer imagen destacada',
        'remove_featured_image' => 'Eliminar imagen destacada',
        'use_featured_image'    => 'Usar como imagen destacada',
        'archives'              => 'Archivo de Líneas',
        'insert_into_item'      => 'Insertar en línea',
        'uploaded_to_this_item' => 'Subido a esta línea',
        'filter_items_list'     => 'Filtrar lista de líneas',
        'items_list_navigation' => 'Navegación de líneas',
        'items_list'            => 'Lista de líneas',
    );
    $linea_args = array(
        'labels'             => $linea_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'lineas'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-location',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'comments'),
        'show_in_rest'       => true, // Habilita Gutenberg
    );
    register_post_type('ferroblog_linea', $linea_args);
    // ==================================================================================
    // CUSTOM POST TYPE: PROYECTOS
    // ==================================================================================
    $proyecto_labels = array(
        'name'                  => 'Proyectos',
        'singular_name'         => 'Proyecto',
        'menu_name'             => 'Proyectos',
        'name_admin_bar'        => 'Proyecto',
        'add_new'               => 'Añadir Proyecto',
        'add_new_item'          => 'Añadir Nuevo Proyecto',
        'new_item'              => 'Nuevo Proyecto',
        'edit_item'             => 'Editar Proyecto',
        'view_item'             => 'Ver Proyecto',
        'all_items'             => 'Todos los Proyectos',
        'search_items'          => 'Buscar Proyectos',
        'parent_item_colon'     => 'Proyecto Padre:',
        'not_found'             => 'No se encontraron proyectos',
        'not_found_in_trash'    => 'No hay proyectos en la papelera',
    );
    $proyecto_args = array(
        'labels'             => $proyecto_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'proyectos'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-chart-line',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'comments'),
        'show_in_rest'       => true,
    );
    register_post_type('ferroblog_proyecto', $proyecto_args);
    // ==================================================================================
    // CUSTOM POST TYPE: ESTACIONES
    // ==================================================================================
    $estacion_labels = array(
        'name'                  => 'Estaciones',
        'singular_name'         => 'Estación',
        'menu_name'             => 'Estaciones',
        'name_admin_bar'        => 'Estación',
        'add_new'               => 'Añadir Estación',
        'add_new_item'          => 'Añadir Nueva Estación',
        'new_item'              => 'Nueva Estación',
        'edit_item'             => 'Editar Estación',
        'view_item'             => 'Ver Estación',
        'all_items'             => 'Todas las Estaciones',
        'search_items'          => 'Buscar Estaciones',
        'not_found'             => 'No se encontraron estaciones',
        'not_found_in_trash'    => 'No hay estaciones en la papelera',
    );
    $estacion_args = array(
        'labels'             => $estacion_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'estaciones'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-building',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'comments'),
        'show_in_rest'       => true,
    );
    register_post_type('ferroblog_estacion', $estacion_args);
    // ==================================================================================
    // TAXONOMÍA: TIPO DE LÍNEA
    // ==================================================================================
    $tipo_linea_labels = array(
        'name'              => 'Tipos de Línea',
        'singular_name'     => 'Tipo de Línea',
        'search_items'      => 'Buscar Tipos',
        'all_items'         => 'Todos los Tipos',
        'parent_item'       => 'Tipo Padre',
        'parent_item_colon' => 'Tipo Padre:',
        'edit_item'         => 'Editar Tipo',
        'update_item'       => 'Actualizar Tipo',
        'add_new_item'      => 'Añadir Nuevo Tipo',
        'new_item_name'     => 'Nombre del Nuevo Tipo',
        'menu_name'         => 'Tipos de Línea',
    );
    $tipo_linea_args = array(
        'labels'            => $tipo_linea_labels,
        'hierarchical'      => true, // Como categorías
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'tipo-linea'),
        'show_in_rest'      => true,
    );
    register_taxonomy('tipo_linea', array('ferroblog_linea'), $tipo_linea_args);
    // ==================================================================================
    // TAXONOMÍA: ESTADO DEL PROYECTO
    // ==================================================================================
    $estado_proyecto_labels = array(
        'name'              => 'Estado del Proyecto',
        'singular_name'     => 'Estado',
        'search_items'      => 'Buscar Estados',
        'all_items'         => 'Todos los Estados',
        'edit_item'         => 'Editar Estado',
        'update_item'       => 'Actualizar Estado',
        'add_new_item'      => 'Añadir Nuevo Estado',
        'new_item_name'     => 'Nombre del Nuevo Estado',
        'menu_name'         => 'Estado',
    );
    $estado_proyecto_args = array(
        'labels'            => $estado_proyecto_labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'estado-proyecto'),
        'show_in_rest'      => true,
    );
    register_taxonomy('estado_proyecto', array('ferroblog_proyecto'), $estado_proyecto_args);
    // ==================================================================================
    // TAXONOMÍA: PROVINCIA (para estaciones)
    // ==================================================================================
    $provincia_labels = array(
        'name'              => 'Provincias',
        'singular_name'     => 'Provincia',
        'search_items'      => 'Buscar Provincias',
        'all_items'         => 'Todas las Provincias',
        'edit_item'         => 'Editar Provincia',
        'update_item'       => 'Actualizar Provincia',
        'add_new_item'      => 'Añadir Nueva Provincia',
        'new_item_name'     => 'Nombre de la Nueva Provincia',
        'menu_name'         => 'Provincias',
    );
    $provincia_args = array(
        'labels'            => $provincia_labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'provincia'),
        'show_in_rest'      => true,
    );
    register_taxonomy('provincia', array('ferroblog_estacion'), $provincia_args);
}
add_action('init', 'ferrocarril_register_post_types');
/**
 * Crear términos predeterminados al activar el tema
 */
function ferrocarril_create_default_terms() {
    // Términos para Tipo de Línea
    $tipos_linea = array(
        'Ancho Ibérico',
        'Ancho Métrico',
        'Ancho Internacional',
        'Metro',
        'Tranvía',
        'AVE',
        'Cercanías',
    );
    foreach ($tipos_linea as $tipo) {
        if (!term_exists($tipo, 'tipo_linea')) {
            wp_insert_term($tipo, 'tipo_linea');
        }
    }
    // Términos para Estado del Proyecto
    $estados_proyecto = array(
        'En Estudio',
        'En Marcha',
        'Actual',
        'Cancelado',
        'Completado',
    );
    foreach ($estados_proyecto as $estado) {
        if (!term_exists($estado, 'estado_proyecto')) {
            wp_insert_term($estado, 'estado_proyecto');
        }
    }
}
add_action('after_switch_theme', 'ferrocarril_create_default_terms');
/**
 * Personalizar mensajes de actualización para custom post types
 */
function ferrocarril_custom_post_type_messages($messages) {
    global $post, $post_ID;
    $messages['ferroblog_linea'] = array(
        0  => '',
        1  => 'Línea actualizada.',
        2  => 'Campo personalizado actualizado.',
        3  => 'Campo personalizado eliminado.',
        4  => 'Línea actualizada.',
        5  => isset($_GET['revision']) ? sprintf('Línea restaurada desde revisión del %s', wp_post_revision_title((int) $_GET['revision'], false)) : false,
        6  => 'Línea publicada.',
        7  => 'Línea guardada.',
        8  => 'Línea enviada.',
        9  => 'Línea programada.',
        10 => 'Borrador de línea actualizado.',
    );
    $messages['ferroblog_proyecto'] = array(
        0  => '',
        1  => 'Proyecto actualizado.',
        6  => 'Proyecto publicado.',
        7  => 'Proyecto guardado.',
        8  => 'Proyecto enviado.',
        9  => 'Proyecto programado.',
        10 => 'Borrador de proyecto actualizado.',
    );
    $messages['ferroblog_estacion'] = array(
        0  => '',
        1  => 'Estación actualizada.',
        6  => 'Estación publicada.',
        7  => 'Estación guardada.',
        8  => 'Estación enviada.',
        9  => 'Estación programada.',
        10 => 'Borrador de estación actualizado.',
    );
    return $messages;
}
add_filter('post_updated_messages', 'ferrocarril_custom_post_type_messages');
/**
 * Forzar recarga de permalinks al activar custom post types
 */
function ferrocarril_rewrite_flush() {
    ferrocarril_register_post_types();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'ferrocarril_rewrite_flush');
