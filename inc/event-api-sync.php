<?php
/**
 * Sincronización de eventos desde APIs externas
 * 
 * @package Ferrocarril_Events
 */

if (!defined('ABSPATH')) {
    exit;
}

class Ferrocarril_Event_API_Sync {
    // ... tu código original aquí ...
    private function create_or_update_event($event_data) {
        // ... tu función restaurada aquí ...
    }
    // ... resto igual ...
}
// Inicializar la clase
function ferrocarril_init_api_sync() {
    return new Ferrocarril_Event_API_Sync();
}
add_action('plugins_loaded', 'ferrocarril_init_api_sync');
function ferrocarril_register_api_settings() {
    register_setting('ferrocarril_api_settings', 'ferrocarril_renfe_resource_id');
    register_setting('ferrocarril_api_settings', 'ferrocarril_adif_layer');
    register_setting('ferrocarril_api_settings', 'ferrocarril_datos_gob_urls');
}
add_action('admin_init', 'ferrocarril_register_api_settings');
