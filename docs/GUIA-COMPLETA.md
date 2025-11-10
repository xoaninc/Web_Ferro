# 📚 Guía Completa del Tema Ferrocarril Esp

Este documento consolida todas las guías de uso, personalización y funcionamiento del tema WordPress Ferrocarril Esp.

---

## 📚 Índice

1. [Estructura General](#1-estructura-general)
2. [Personalización Básica](#2-personalización-básica)
3. [Custom Post Types](#3-custom-post-types)
4. [Sistema de Categorías y Ciudades](#4-sistema-de-categorías-y-ciudades)
5. [Integración de APIs](#5-integración-de-apis)
6. [Uso de Plantillas](#6-uso-de-plantillas)
7. [Calendario de Eventos](#7-calendario-de-eventos)
8. [Menús y Navegación](#8-menús-y-navegación)
9. [Widgets y Sidebars](#9-widgets-y-sidebars)
10. [SEO y Rendimiento](#10-seo-y-rendimiento)
11. [FAQ - Preguntas Frecuentes](#11-faq-preguntas-frecuentes)

---

## 1. Estructura General

La estructura de archivos del tema está detallada en [`ESTRUCTURA-Y-FLUJOS.md`](ESTRUCTURA-Y-FLUJOS.md).

### Jerarquía de Contenido

```
Inicio
├── Curiosidades
├── FAQ
├── Noticias (con filtro por ciudades)
├── Infografía
│   ├── Líneas (Ancho Ibérico, Métrico, Internacional, Cerradas)
│   ├── Desarrollo de Ciudades (con filtro por ciudades)
│   ├── Estaciones
│   └── Proyectos (Cancelados, En Marcha, En Estudio)
├── Eventos Ferroviarios (sincronizados desde APIs)
└── Compra de Billetes
```

### Archivos Principales

- **`functions.php`** - Funciones principales del tema
- **`inc/custom-post-types.php`** - Definición de CPTs (Líneas, Estaciones, Proyectos)
- **`inc/event-post-type.php`** - CPT de Eventos
- **`inc/event-api-sync.php`** - Sistema de sincronización de APIs
- **`inc/custom-taxonomies.php`** - Taxonomías personalizadas
- **`style.css`** - Metadatos del tema
- **`assets/`** - CSS, JS e imágenes

---

## 2. Personalización Básica

### Cambiar el Logo

1. Ve a **Apariencia → Personalizar**
2. Selecciona **Identidad del sitio**
3. Haz clic en **Seleccionar logo**
4. Sube tu logo (recomendado: 400x100px, formato PNG con fondo transparente)
5. Haz clic en **Publicar**

### Configurar Menús

1. Ve a **Apariencia → Menús**
2. Crea un nuevo menú o edita uno existente
3. Arrastra los elementos al menú (Páginas, Custom Links, Categorías, etc.)
4. Asigna el menú a una ubicación:
   - **Menú Principal** (navegación superior)
   - **Enlaces Rápidos Sidebar** (enlaces laterales)
   - **Menú Footer** (pie de página)
5. Guarda el menú

### Cambiar Colores

#### Desde el Customizer:

1. Ve a **Apariencia → Personalizar → Colores del Tema**
2. Selecciona el **Color Principal** (por defecto: `#f0dfd0`)
3. Haz clic en **Publicar**

#### Editando CSS:

Edita `/assets/css/styles.css` y busca estas variables:

```css
:root {
    --color-principal: #f0dfd0;
    --color-texto: #333;
    --color-enlace: #006400;
}
```

### Configurar Widgets

1. Ve a **Apariencia → Widgets**
2. Arrastra widgets al **Sidebar Principal**
3. Configura cada widget según tus necesidades
4. Guarda los cambios

---

## 3. Custom Post Types

El tema incluye 4 Custom Post Types:

### 1. Líneas (`ferroblog_linea`)

**Para crear una nueva línea:**

1. Ve a **Líneas → Añadir nueva**
2. Rellena:
   - **Título:** Nombre de la línea (ej: "Línea C-1 Madrid")
   - **Contenido:** Descripción detallada
   - **Imagen destacada:** Foto de la línea o tren
   - **Tipo de Ancho:** Ibérico, Métrico o Internacional
   - **Ciudad:** Selecciona una o varias ciudades
3. Publica

**Metadatos personalizados:**
- Longitud de la línea
- Año de apertura
- Operador
- Velocidad máxima

### 2. Estaciones (`ferroblog_estacion`)

**Para crear una nueva estación:**

1. Ve a **Estaciones → Añadir nueva**
2. Rellena:
   - **Título:** Nombre de la estación
   - **Contenido:** Descripción, historia, servicios
   - **Imagen destacada:** Foto de la estación
   - **Ciudad:** Selecciona la ciudad
3. Publica

**Metadatos personalizados:**
- Código de estación
- Año de construcción
- Número de andenes
- Accesibilidad (sí/no)

### 3. Proyectos (`ferroblog_proyecto`)

**Para crear un nuevo proyecto:**

1. Ve a **Proyectos → Añadir nuevo**
2. Rellena:
   - **Título:** Nombre del proyecto
   - **Contenido:** Descripción completa
   - **Imagen destacada:** Mapa o render del proyecto
   - **Tipo de Proyecto:** Cancelado, En Marcha o En Estudio
   - **Ciudad:** Selecciona ciudades afectadas
3. Publica

**Metadatos personalizados:**
- Presupuesto
- Fecha de inicio
- Fecha estimada de finalización
- Estado actual

### 4. Eventos (`ferroblog_event`)

**⚠️ Los eventos se sincronizan automáticamente desde las APIs.**

Para eventos manuales (como aniversarios):

1. Ve a **Eventos → Añadir nuevo**
2. Rellena:
   - **Título:** Nombre del evento
   - **Contenido:** Descripción
   - **Fecha de inicio y fin**
   - **Tipo de Evento:** Aniversario (u otro)
   - **Ciudad:** Selecciona ciudad relacionada
3. Publica

---

## 4. Sistema de Categorías y Ciudades

### Ciudades Compartidas

La taxonomía **Ciudad** es compartida entre:
- **Noticias** (posts normales)
- **Infografía** (custom posts)
- **Líneas**
- **Estaciones**
- **Proyectos**
- **Eventos**

### 20 Ciudades Principales

1. Madrid
2. Barcelona
3. Valencia
4. Sevilla
5. Bilbao
6. A Coruña
7. Zaragoza
8. Málaga
9. Oviedo
10. Murcia
11. Palma de Mallorca
12. Las Palmas de Gran Canaria
13. Alicante
14. Córdoba
15. Valladolid
16. Vigo
17. Gijón
18. Granada
19. Santander
20. Pamplona

### Cómo Añadir una Nueva Ciudad

1. Ve a **Entradas → Categorías**
2. En la sección "Añadir nueva categoría":
   - **Nombre:** Nombre de la ciudad (con mayúscula)
   - **Slug:** nombre-ciudad (en minúsculas, sin tildes)
   - **Categoría padre:** Selecciona "Ciudades" si existe
3. Haz clic en **Añadir nueva categoría**

### Filtros por Ciudad

Los filtros de ciudad funcionan automáticamente:
- En la página de archivo de una ciudad, se mostrarán todos los posts/CPTs relacionados
- El widget de ciudades en el sidebar permite filtrar fácilmente

---

## 5. Integración de APIs

El tema integra 4 APIs de transporte ferroviario españolas. Para la documentación completa, consulta [`API_INTEGRATION.md`](API_INTEGRATION.md).

### APIs Integradas

#### 1. Renfe Cercanías (GTFS-RT)

- **URL:** `https://gtfsrt.renfe.com/api/alerts`
- **Formato:** JSON (GTFS Realtime)
- **Datos:** Alertas en tiempo real, incidencias, líneas afectadas
- **Frecuencia de actualización:** 30 segundos
- **Configuración:** No requiere API key

#### 2. Renfe Data (CKAN)

- **URL:** `https://data.renfe.com/api/3/action/datastore_search`
- **Formato:** JSON (CKAN API)
- **Datos:** Datasets históricos, horarios, ubicación de vehículos
- **Configuración:** Requiere Resource ID (configurable en admin)

**Cómo obtener el Resource ID:**
1. Ve a [data.renfe.com](https://data.renfe.com)
2. Busca el dataset "Incidencias y avisos"
3. Copia el `resource_id` de la URL
4. Pégalo en **Eventos → Sincronizar APIs → Configuración**

#### 3. ADIF (WMS/WFS)

- **URL:** `https://ideadif.adif.es/services/wms`
- **Formato:** GeoJSON (via WFS)
- **Datos:** Obras en infraestructuras, incidencias georreferenciadas
- **Configuración:** Requiere layer name (por defecto: "incidencias")

**Capas disponibles:**
- `tramificacion_comun` - Red ferroviaria completa
- `estaciones` - Estaciones de ADIF
- `infraestructuras` - Infraestructuras ferroviarias

#### 4. Datos.gob.es

- **URL:** Variable según dataset
- **Formato:** CSV, JSON, GeoJSON
- **Datos:** Estadísticas de transporte, proyectos gubernamentales
- **Configuración:** Array de URLs (via código)

### Configuración de las APIs

1. Ve a **Eventos → Sincronizar APIs**
2. Configura los parámetros necesarios:
   - **Renfe Resource ID** (opcional)
   - **ADIF Layer Name** (opcional, por defecto: "incidencias")
3. Haz clic en **Guardar Configuración**
4. Haz clic en **🚀 Sincronizar Ahora** para hacer la primera sincronización

### Sincronización Automática

El sistema sincroniza automáticamente cada 6 horas mediante WP-Cron. No necesitas hacer nada.

**Para cambiar la frecuencia**, añade este código a tu `functions.php`:

```php
add_filter('cron_schedules', function($schedules) {
    $schedules['threehourly'] = array(
        'interval' => 10800, // 3 horas en segundos
        'display' => __('Cada 3 horas')
    );
    return $schedules;
});
```

---

## 6. Uso de Plantillas

### Plantilla de Noticia

**Archivo:** `noticias/plantilla-noticia.html`

**Pasos para crear una noticia:**

1. Ve a **Entradas → Añadir nueva**
2. Rellena:
   - **Título:** Título de la noticia
   - **Contenido:** Cuerpo de la noticia (usa el editor de bloques)
   - **Imagen destacada:** Foto principal
   - **Categorías:** Noticias + Ciudad (si aplica)
   - **Etiquetas:** Palabras clave
3. Publica o programa

### Plantilla de Infografía

**Archivo:** `informacion/plantilla-informacion.html`

**Pasos para crear una infografía:**

1. Ve a **Líneas**, **Estaciones** o **Proyectos** (según el tipo)
2. Añade nuevo
3. Rellena todos los campos
4. Añade información técnica en el contenido
5. Publica

### Templates Disponibles

- `single.php` - Post individual (noticia)
- `single-ferroblog_linea.php` - Línea individual
- `single-ferroblog_estacion.php` - Estación individual
- `single-ferroblog_proyecto.php` - Proyecto individual
- `single-ferroblog_event.php` - Evento individual
- `archive.php` - Archivo de posts
- `taxonomy-ciudad.php` - Archivo por ciudad

---

## 7. Calendario de Eventos

### Visualización

El calendario de eventos se muestra en el **sidebar** con:
- 🟢 Verde - Apertura de Línea
- 🟡 Amarillo - Inicio de Obras
- 🔵 Azul - Fin de Obras
- 🟣 Morado - Evento Especial
- 🔴 Rojo - Mantenimiento
- 🟠 Naranja - Cambio de Horarios
- ⚪ Blanco - Aniversario (manual)

### Tipos de Eventos

#### Automáticos (desde APIs):
1. **Apertura de Línea** - Nuevas líneas inauguradas
2. **Inicio de Obras** - Comienzo de obras o proyectos
3. **Fin de Obras** - Finalización de obras
4. **Evento Especial** - Eventos ferroviarios especiales
5. **Mantenimiento** - Mantenimientos programados
6. **Cambio de Horarios** - Cambios en horarios de servicio

#### Manuales:
7. **Aniversario** - Aniversarios históricos (se crean manualmente)

### Ver Todos los Eventos

1. Ve a **Eventos → Todos los eventos**
2. Filtra por:
   - Tipo de evento
   - Ciudad
   - Fecha
   - Fuente (Renfe, ADIF, etc.)

---

## 8. Menús y Navegación

### Menú Principal

El menú principal debe incluir:
- Inicio
- Noticias
- Infografía (con submenús: Líneas, Estaciones, Proyectos)
- Eventos
- Curiosidades
- FAQ
- Contacto

**Ejemplo de estructura:**

```
Inicio
Noticias
Infoografía
  └─ Líneas
  └─ Estaciones
  └─ Proyectos
Eventos
Curiosidades
FAQ
Contacto
```

### Menú Sidebar (Enlaces Rápidos)

Incluye enlaces a:
- Ciudades principales
- Categorías populares
- Eventos próximos

### Menú Footer

Incluye:
- Acerca de
- Política de privacidad
- Aviso legal
- Contacto
- Redes sociales

---

## 9. Widgets y Sidebars

### Widgets Recomendados

1. **Buscador** - Búsqueda AJAX de contenido
2. **Categorías** - Lista de categorías principales
3. **Ciudades** - Lista de 20 ciudades principales
4. **Calendario de Eventos** - Próximos eventos sincronizados
5. **Últimas Noticias** - Últimas 5 noticias publicadas
6. **Curiosidades Aleatorias** - 3 curiosidades al azar
7. **Enlaces Rápidos** - Menú personalizado de enlaces

### Cómo Añadir un Widget

1. Ve a **Apariencia → Widgets**
2. Arrastra el widget deseado al **Sidebar Principal**
3. Configura el widget
4. Guarda

---

## 10. SEO y Rendimiento

### Configuración SEO Básica

Se recomienda instalar **Yoast SEO** o **Rank Math**:

1. Instala el plugin desde **Plugins → Añadir nuevo**
2. Configura:
   - Títulos y metadescripciones
   - Sitemaps XML
   - Breadcrumbs
   - Schema.org

### Optimización de Imágenes

- Usa formatos WebP cuando sea posible
- Comprime imágenes antes de subirlas
- Tamaños recomendados:
  - Imagen destacada: 800x450px
  - Miniaturas: 300x200px
  - Logo: 400x100px

### Caché

Instala un plugin de caché como:
- **WP Super Cache**
- **W3 Total Cache**
- **LiteSpeed Cache** (si tu servidor usa LiteSpeed)

### CDN

Considera usar un CDN para:
- Imágenes
- CSS y JS
- Fuentes (ya usa Google Fonts CDN)

---

## 11. FAQ - Preguntas Frecuentes

### ¿Cómo agrego una nueva ciudad?

**Respuesta:** Ve a **Entradas → Categorías**, crea una nueva categoría con el nombre de la ciudad (con mayúscula) y slug en minúsculas.

### ¿Cómo funciona el filtro por ciudades?

**Respuesta:** El filtro de ciudades afecta a Noticias, Líneas, Estaciones, Proyectos y Eventos. Al hacer clic en una ciudad, se mostrarán todos los contenidos relacionados con esa ciudad.

### ¿Cómo cambio el agrupamiento de proyectos?

**Respuesta:** Los proyectos se organizan automáticamente por su taxonomía "Tipo de Proyecto". Para cambiar un proyecto de categoría, edítalo y cambia el tipo.

### ¿Puedo desactivar la sincronización automática de eventos?

**Respuesta:** Sí. Ve a **Herramientas → Eventos programados** (requiere plugin WP Crontrol) y desactiva el evento `ferrocarril_sync_events`.

### ¿Cómo elimino eventos antiguos?

**Respuesta:** Puedes eliminarlos manualmente desde **Eventos → Todos los eventos**, o implementar un script de limpieza automática (ver [`API_INTEGRATION.md`](API_INTEGRATION.md#faqs)).

### ¿Se pueden añadir más APIs?

**Respuesta:** Sí. Edita `inc/event-api-sync.php` y añade un nuevo método de sincronización siguiendo el patrón existente.

### ¿Cómo personalizo los colores de los eventos?

**Respuesta:** Edita `/assets/css/styles.css` y busca las clases `.event-type-*`. Cambia los colores según tu preferencia.

### ¿El tema es compatible con Gutenberg?

**Respuesta:** Sí, el tema es totalmente compatible con el editor de bloques de WordPress (Gutenberg).

### ¿Puedo usar el tema con WooCommerce?

**Respuesta:** Sí, aunque no incluye estilos específicos para WooCommerce. Deberás añadir CSS personalizado.

### ¿Cómo actualizo el tema sin perder cambios?

**Respuesta:** Usa un **Child Theme**. Crea una carpeta en `/wp-content/themes/` llamada `ferrocarril-esp-child` con:

```php
// style.css
/*
Theme Name: Ferrocarril Esp Child
Template: ferrocarril-esp
*/

// functions.php
<?php
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
});
```

### ¿Dónde encuentro más ayuda?

**Respuesta:** 
- **Documentación:** Lee todos los archivos en `/docs/`
- **GitHub Issues:** [https://github.com/xoaninc/P-gina-web-Ferrocarril/issues](https://github.com/xoaninc/P-gina-web-Ferrocarril/issues)
- **WordPress Codex:** [https://codex.wordpress.org/](https://codex.wordpress.org/)
- **Foros de WordPress:** [https://es.wordpress.org/support/](https://es.wordpress.org/support/)

---

## 👨‍💻 Soporte y Contacto

Para soporte técnico o preguntas sobre el tema:

- **GitHub:** [xoaninc/P-gina-web-Ferrocarril](https://github.com/xoaninc/P-gina-web-Ferrocarril)
- **Email:** xoanin05@gmail.com

---

**© 2025 Ferrocarril Esp - Tema WordPress por Xoan Macias**

Última actualización: Noviembre 2025
