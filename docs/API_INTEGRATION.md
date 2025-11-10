# 🔄 Integración de APIs de Transporte Ferroviario

## 📚 Índice

1. [Introducción](#introducción)
2. [APIs Integradas](#apis-integradas)
3. [Instalación y Configuración](#instalación-y-configuración)
4. [Uso del Sistema](#uso-del-sistema)
5. [Estructura de Datos](#estructura-de-datos)
6. [Troubleshooting](#troubleshooting)
7. [FAQs](#faqs)

---

## 📄 Introducción

El tema **Ferrocarril Esp** incluye un sistema completo de sincronización automática con las principales APIs de datos ferroviarios de España. Este sistema permite importar automáticamente eventos, incidencias, obras y avisos desde:

- **Renfe** (GTFS-RT y Data API)
- **ADIF** (WMS/WFS)
- **Datos.gob.es** (CSV/JSON/GeoJSON)

Los eventos se sincronizan automáticamente cada 6 horas y se pueden sincronizar manualmente desde el panel de administración.

---

## 🌐 APIs Integradas

### 1. 🚆 Renfe Cercanías (GTFS-RT)

**URL:** `https://gtfsrt.renfe.com/api/alerts`

**Formato:** JSON (GTFS Realtime)

**Datos que proporciona:**
- Alertas en tiempo real
- Incidencias en líneas
- Período activo de la incidencia
- Líneas afectadas
- Descripciones multiidioma

**Ejemplo de datos:**
```json
{
  "entity": [
    {
      "id": "alert_123",
      "alert": {
        "activePeriod": [{
          "start": 1699564800,
          "end": 1699651200
        }],
        "headerText": {
          "translation": [{
            "language": "es",
            "text": "Retraso en C-1"
          }]
        },
        "descriptionText": {
          "translation": [{
            "language": "es",
            "text": "Retraso de 10 minutos por incidencia técnica"
          }]
        },
        "informedEntity": [{
          "routeId": "C-1"
        }]
      }
    }
  ]
}
```

**Configuración requerida:** Ninguna (API pública)

---

### 2. 📊 Renfe Data API (CKAN Datastore)

**URL:** `https://data.renfe.com/api/3/action/datastore_search`

**Formato:** JSON (CKAN API)

**Datos que proporciona:**
- Datasets de incidencias históricas
- Eventos programados
- Mantenimientos planificados
- Obras en estaciones

**Ejemplo de uso:**
```
https://data.renfe.com/api/3/action/datastore_search?resource_id=RESOURCE_ID&limit=100
```

**Configuración requerida:**
- `resource_id`: ID del recurso CKAN (configurable en el admin)

**Cómo encontrar el Resource ID:**
1. Ve a [data.renfe.com](https://data.renfe.com)
2. Busca el dataset que te interese
3. Copia el `resource_id` de la URL
4. Pégalo en la configuración del admin de WordPress

---

### 3. 🛤️ ADIF (WMS/WFS)

**URL:** `https://ideadif.adif.es/services/wms`

**Formato:** GeoJSON (via WFS)

**Datos que proporciona:**
- Obras en infraestructuras
- Incidencias en vías
- Información georreferenciada
- Fechas de inicio y fin de obras

**Parámetros WFS:**
```
service=WFS
version=1.1.0
request=GetFeature
typename=LAYER_NAME
outputFormat=application/json
```

**Configuración requerida:**
- `typename`: Nombre de la capa WFS (configurable en el admin)

**Capas disponibles comunes:**
- `incidencias`
- `obras`
- `estaciones`
- `infraestructuras`

---

### 4. 📊 Datos.gob.es

**URL:** `https://datos.gob.es/apidata`

**Formato:** CSV, JSON, GeoJSON

**Datos que proporciona:**
- Datasets gubernamentales
- Información histórica
- Datos estadísticos
- Proyectos de infraestructura

**Configuración requerida:**
- Array de URLs de datasets a sincronizar

**Ejemplo de configuración:**
```php
update_option('ferrocarril_datos_gob_urls', array(
    'https://datos.gob.es/dataset/incidencias.csv',
    'https://datos.gob.es/dataset/obras.json'
));
```

---

## ⚙️ Instalación y Configuración

### Paso 1: Activar el Tema

1. Sube el tema a `/wp-content/themes/`
2. Activa el tema desde **Apariencia → Temas**
3. El sistema de sincronización se activará automáticamente

### Paso 2: Configurar las APIs

1. Ve a **Eventos → Sincronizar APIs** en el admin de WordPress
2. Configura los parámetros necesarios:

#### Renfe Resource ID (Opcional)

```
Campo: Renfe Resource ID (CKAN)
Valor: [ID del recurso de data.renfe.com]
Ejemplo: abc123def456
```

#### ADIF Layer Name (Opcional)

```
Campo: ADIF Layer Name
Valor: [Nombre de la capa WFS]
Por defecto: incidencias
Otras opciones: obras, estaciones, infraestructuras
```

#### Datos.gob.es URLs (Opcional)

Si quieres añadir datasets de datos.gob.es, agrega este código a tu `functions.php` o usa un plugin de código personalizado:

```php
add_action('init', function() {
    update_option('ferrocarril_datos_gob_urls', array(
        'https://datos.gob.es/dataset/tu-dataset.csv',
        'https://datos.gob.es/dataset/otro-dataset.json'
    ));
});
```

### Paso 3: Programar la Sincronización Automática

La sincronización automática se programa automáticamente al activar el tema. El sistema ejecutará:

- **Frecuencia:** Cada 6 horas
- **Hook WP Cron:** `ferrocarril_sync_events`
- **Ejecución manual:** Disponible en el panel de admin

### Paso 4: Primera Sincronización

1. Ve a **Eventos → Sincronizar APIs**
2. Haz clic en **🚀 Sincronizar Ahora**
3. Espera a que termine la sincronización
4. Revisa los resultados en la tabla de estado

---

## 📊 Uso del Sistema

### Panel de Administración

El panel de sincronización muestra:

- **Última sincronización:** Fecha y hora de la última ejecución
- **Eventos creados:** Número de eventos nuevos importados
- **Eventos actualizados:** Número de eventos existentes actualizados
- **Errores:** Número de errores durante la sincronización
- **Logs:** Últimos 50 mensajes del sistema

### Sincronización Manual

1. Ve a **Eventos → Sincronizar APIs**
2. Haz clic en **🚀 Sincronizar Ahora**
3. El sistema sincronizará todas las fuentes configuradas
4. Verás un mensaje de confirmación al terminar

### Sincronización Automática

El sistema ejecuta automáticamente cada 6 horas:

```php
// Hook registrado automáticamente
add_action('ferrocarril_sync_events', array($sync_class, 'sync_all_events'));
```

**Para cambiar la frecuencia:**

```php
// En tu functions.php o plugin personalizado
add_filter('cron_schedules', function($schedules) {
    $schedules['threehourly'] = array(
        'interval' => 10800, // 3 horas en segundos
        'display' => __('Cada 3 horas')
    );
    return $schedules;
});

// Cambiar el schedule del evento
wp_clear_scheduled_hook('ferrocarril_sync_events');
wp_schedule_event(time(), 'threehourly', 'ferrocarril_sync_events');
```

---

## 💾 Estructura de Datos

### Custom Post Type: `ferroblog_event`

Todos los eventos sincronizados se guardan como posts del tipo `ferroblog_event` con los siguientes metadatos:

#### Post Meta Fields

| Meta Key | Tipo | Descripción |
|----------|------|-------------|
| `_external_id` | string | ID único del evento en la API externa |
| `_event_start_date` | datetime | Fecha de inicio del evento (Y-m-d H:i:s) |
| `_event_end_date` | datetime | Fecha de fin del evento (Y-m-d H:i:s) |
| `_event_source` | string | Fuente del evento (Renfe, ADIF, etc.) |
| `_event_lines` | string | Líneas afectadas (separadas por comas) |
| `_event_raw_data` | json | Datos completos de la API en formato JSON |

#### Taxonomías

**event_type:**
- `incidencias`
- `obras`
- `mantenimiento`
- `eventos-especiales`
- `general`

### Mapeo de Tipos de Evento

El sistema mapea automáticamente los tipos de evento de las APIs a las taxonomías de WordPress:

```php
'incidencia' => 'incidencias',
'obra' => 'obras',
'evento' => 'eventos-especiales',
'mantenimiento' => 'mantenimiento',
'general' => 'general'
```

---

## 🔧 Troubleshooting

### Problema: No se sincronizan eventos

**Solución:**

1. Verifica que WP Cron esté funcionando:
```bash
wp cron event list
```

2. Ejecuta manualmente desde WP-CLI:
```bash
wp cron event run ferrocarril_sync_events
```

3. Revisa los logs en el panel de admin

### Problema: Errores de timeout

**Solución:**

Aumenta el timeout en tu `wp-config.php`:

```php
define('WP_HTTP_BLOCK_EXTERNAL', false);
define('WP_ACCESSIBLE_HOSTS', 'gtfsrt.renfe.com,data.renfe.com,ideadif.adif.es,datos.gob.es');
```

O modifica el timeout en el archivo `event-api-sync.php`:

```php
private $timeout = 60; // Aumentar a 60 segundos
```

### Problema: API de Renfe no responde

**Causas posibles:**
- API caída temporalmente
- Cambio en la URL de la API
- Problemas de conectividad

**Solución:**

1. Verifica la URL manualmente en el navegador
2. Revisa los logs del sistema
3. Espera y reintenta más tarde

### Problema: ADIF WMS no devuelve datos

**Causas posibles:**
- Nombre de capa incorrecto
- Servicio WFS no disponible

**Solución:**

1. Verifica las capas disponibles:
```
https://ideadif.adif.es/services/wms?service=WFS&request=GetCapabilities
```

2. Actualiza el nombre de la capa en la configuración

### Problema: Datos duplicados

**Solución:**

El sistema usa `_external_id` para evitar duplicados. Si aún así hay duplicados:

1. Limpia la base de datos:
```sql
DELETE FROM wp_postmeta WHERE meta_key = '_external_id' AND meta_value LIKE 'renfe_%';
```

2. Ejecuta una sincronización manual

---

## ❓ FAQs

### ¿Cuánto espacio ocupa la base de datos?

Depende del número de eventos sincronizados. Estimación:
- 100 eventos ≈ 500KB
- 1000 eventos ≈ 5MB
- 10000 eventos ≈ 50MB

### ¿Se pueden desactivar fuentes específicas?

Sí, simplemente no configures los parámetros de esa fuente. Por ejemplo, si no configuras `ferrocarril_renfe_resource_id`, Renfe Data API no se sincronizará.

### ¿Cómo eliminar eventos antiguos?

Puedes crear una tarea cron personalizada:

```php
add_action('init', function() {
    if (!wp_next_scheduled('ferrocarril_cleanup_old_events')) {
        wp_schedule_event(time(), 'daily', 'ferrocarril_cleanup_old_events');
    }
});

add_action('ferrocarril_cleanup_old_events', function() {
    $args = array(
        'post_type' => 'ferroblog_event',
        'posts_per_page' => -1,
        'date_query' => array(
            array(
                'before' => '90 days ago'
            )
        )
    );
    
    $old_events = get_posts($args);
    foreach ($old_events as $event) {
        wp_delete_post($event->ID, true);
    }
});
```

### ¿Se pueden sincronizar datos históricos?

Sí, pero depende de la API:
- **Renfe GTFS-RT:** Solo datos en tiempo real (no histórico)
- **Renfe Data API:** Puede tener histórico según el dataset
- **ADIF WMS:** Depende de la capa configurada
- **Datos.gob.es:** Generalmente incluye histórico

### ¿Cómo exportar los eventos?

Usa WP-CLI:

```bash
wp post list --post_type=ferroblog_event --format=csv > eventos.csv
```

O instala un plugin de exportación como WP All Export.

### ¿Se puede personalizar el formato de los eventos?

Sí, puedes usar hooks de WordPress:

```php
add_filter('ferrocarril_event_data', function($event_data, $source) {
    // Modificar $event_data según la fuente
    if ($source === 'Renfe Cercanías') {
        $event_data['title'] = '🚆 ' . $event_data['title'];
    }
    return $event_data;
}, 10, 2);
```

---

## 📝 Logs y Depuración

### Activar Debug Mode

En tu `wp-config.php`:

```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

Los logs se guardarán en `/wp-content/debug.log`

### Ver Logs en el Admin

Ve a **Eventos → Sincronizar APIs** y revisa la sección **📝 Últimos Logs**

### Logs Programados

Para ver los eventos cron programados:

```bash
wp cron event list
```

---

## 📞 Soporte

Si tienes problemas con la integración de APIs:

1. Revisa esta documentación
2. Verifica los logs del sistema
3. Abre un issue en GitHub: [xoaninc/P-gina-web-Ferrocarril](https://github.com/xoaninc/P-gina-web-Ferrocarril/issues)

---

## 📅 Changelog

### v1.0.0 (2025-11-09)
- ✅ Integración inicial con Renfe GTFS-RT
- ✅ Integración con Renfe Data API (CKAN)
- ✅ Integración con ADIF WMS/WFS
- ✅ Integración con Datos.gob.es
- ✅ Sistema de sincronización automática cada 6 horas
- ✅ Panel de administración con logs y estadísticas
- ✅ Mapeo automático de tipos de eventos
- ✅ Sistema de logs y depuración

---

**© 2025 Ferrocarril Esp - Tema WordPress por Xoan Macias**
