<?php
/**
 * Custom Post Type: Eventos Ferroviarios
 * 
 * Gestiona eventos ferroviarios reales desde APIs externas
 * Categorías: Apertura de Línea, Inicio de Obras, Fin de Obras, 
 * Evento Especial, Mantenimiento, Cambio de Horarios
 * 
 * @package Ferrocarril_Esp
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registrar Custom Post Type: Eventos
 */
function ferrocarril_register_events() {
    
    $event_labels = array(
        'name' => 'Eventos Ferroviarios',
        'singular_name' => 'Evento',
        'menu_name' => 'Eventos',
        'name_admin_bar' => 'Evento',
        'add_new' => 'Añadir Evento',
        'add_new_item' => 'Añadir Nuevo Evento',
        'new_item' => 'Nuevo Evento',
        'edit_item' => 'Editar Evento',
        'view_item' => 'Ver Evento',
        'all_items' => 'Todos los Eventos',
        'search_items' => 'Buscar Eventos',
        'not_found' => 'No se encontraron eventos',
        'not_found_in_trash' => 'No hay eventos en la papelera',
    );
    
    $event_args = array(
        'labels' => $event_labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'eventos'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 8,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest' => true,
    );
    
    register_post_type('ferroblog_event', $event_args);
    
    // Taxonomía: Tipo de Evento
    $tipo_evento_labels = array(
        'name' => 'Tipos de Evento',
        'singular_name' => 'Tipo de Evento',
        'search_items' => 'Buscar Tipos',
        'all_items' => 'Todos los Tipos',
        'edit_item' => 'Editar Tipo',
        'update_item' => 'Actualizar Tipo',
        'add_new_item' => 'Añadir Nuevo Tipo',
        'new_item_name' => 'Nombre del Nuevo Tipo',
        'menu_name' => 'Tipos de Evento',
    );
    
    $tipo_evento_args = array(
        'labels' => $tipo_evento_labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'tipo-evento'),
        'show_in_rest' => true,
    );
    
    register_taxonomy('tipo_evento', array('ferroblog_event'), $tipo_evento_args);
}
add_action('init', 'ferrocarril_register_events');

/**
 * Crear términos de taxonomía para tipos de eventos
 * (excepto "Aniversario" que se gestiona manualmente)
 */
function ferrocarril_create_event_terms() {
    $tipos_evento = array(
        'Apertura de Línea' => '#4CAF50',  // Verde
        'Inicio de Obras' => '#FF9800',     // Naranja
        'Fin de Obras' => '#2196F3',        // Azul
        'Evento Especial' => '#9C27B0',     // Morado
        'Mantenimiento' => '#F44336',       // Rojo
        'Cambio de Horarios' => '#FFC107',  // Amarillo
    );
    
    foreach ($tipos_evento as $tipo => $color) {
        if (!term_exists($tipo, 'tipo_evento')) {
            $term = wp_insert_term($tipo, 'tipo_evento');
            if (!is_wp_error($term)) {
                update_term_meta($term['term_id'], 'event_color', $color);
            }
        }
    }
}
add_action('after_switch_theme', 'ferrocarril_create_event_terms');

/**
 * Añadir campos personalizados a los eventos
 */
function ferrocarril_event_meta_boxes() {
    add_meta_box(
        'ferrocarril_event_details',
        'Detalles del Evento',
        'ferrocarril_event_details_callback',
        'ferroblog_event',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ferrocarril_event_meta_boxes');

function ferrocarril_event_details_callback($post) {
    wp_nonce_field('ferrocarril_save_event_details', 'ferrocarril_event_nonce');
    
    $event_date = get_post_meta($post->ID, '_event_date', true);
    $event_source = get_post_meta($post->ID, '_event_source', true);
    $event_source_id = get_post_meta($post->ID, '_event_source_id', true);
    $event_location = get_post_meta($post->ID, '_event_location', true);
    
    ?>
    <p>
        <label for="event_date"><strong>Fecha del Evento:</strong></label><br>
        <input type="date" id="event_date" name="event_date" value="<?php echo esc_attr($event_date); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="event_location"><strong>Ubicación:</strong></label><br>
        <input type="text" id="event_location" name="event_location" value="<?php echo esc_attr($event_location); ?>" placeholder="Madrid, Barcelona, etc." style="width: 100%;">
    </p>
    <p>
        <label for="event_source"><strong>Fuente:</strong></label><br>
        <select id="event_source" name="event_source" style="width: 100%;">
            <option value="manual" <?php selected($event_source, 'manual'); ?>>Manual</option>
            <option value="renfe" <?php selected($event_source, 'renfe'); ?>>Renfe API</option>
            <option value="adif" <?php selected($event_source, 'adif'); ?>>ADIF</option>
            <option value="datos_gob" <?php selected($event_source, 'datos_gob'); ?>>Datos.gob.es</option>
        </select>
    </p>
    <p>
        <label for="event_source_id"><strong>ID Fuente Externa:</strong></label><br>
        <input type="text" id="event_source_id" name="event_source_id" value="<?php echo esc_attr($event_source_id); ?>" readonly style="width: 100%; background: #f1f1f1;">
        <small>Generado automáticamente por el sistema de sincronización</small>
    </p>
    <?php
}

function ferrocarril_save_event_details($post_id) {
    if (!isset($_POST['ferrocarril_event_nonce']) || !wp_verify_nonce($_POST['ferrocarril_event_nonce'], 'ferrocarril_save_event_details')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['event_date'])) {
        update_post_meta($post_id, '_event_date', sanitize_text_field($_POST['event_date']));
    }
    
    if (isset($_POST['event_location'])) {
        update_post_meta($post_id, '_event_location', sanitize_text_field($_POST['event_location']));
    }
    
    if (isset($_POST['event_source'])) {
        update_post_meta($post_id, '_event_source', sanitize_text_field($_POST['event_source']));
    }
    
    if (isset($_POST['event_source_id'])) {
        update_post_meta($post_id, '_event_source_id', sanitize_text_field($_POST['event_source_id']));
    }
}
add_action('save_post_ferroblog_event', 'ferrocarril_save_event_details');
?>