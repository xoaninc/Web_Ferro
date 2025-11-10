# Plan de Reorganización Completa del Tema

## Objetivo
Limpiar y reorganizar el tema WordPress para que tenga una estructura profesional, limpia y fácil de mantener.

---

## Fase 1: Crear Nueva Estructura de Carpetas ✅

### Carpetas a crear:
```
/assets
    /css        - Todos los archivos CSS
    /js         - Todos los archivos JavaScript
    /images     - Imágenes del tema

/docs          - Toda la documentación

/templates     - Plantillas específicas (futuro)

/inc           - Ya existe, mantener
```

---

## Fase 2: Mover Archivos CSS y JS

### A mover a `/assets/css/`:
- `styles.css` → `assets/css/styles.css`
- `wp-style.css` → `assets/css/wp-style.css`

### A mover a `/assets/js/`:
- `script.js` → `assets/js/script.js`
- `config.js` → `assets/js/config.js`
- `wp-search.js` → `assets/js/wp-search.js`

### Mantener en raíz:
- `style.css` (OBLIGATORIO para WordPress)

---

## Fase 3: Reorganizar Documentación

### A mover a `/docs/`:
- `README-ESTRUCTURA-ACTUALIZADA.md` → `docs/ESTRUCTURA.md`
- `README-MEJORAS.md` → `docs/MEJORAS.md`
- `README-WORDPRESS.md` → `docs/WORDPRESS.md`
- `REVISION-CODIGO.md` → `docs/REVISION-CODIGO.md`
- `INSTRUCCIONES-AZURE.md` → `docs/AZURE.md`
- `INSTRUCCIONES-SCREENSHOT.md` → `docs/SCREENSHOT.md`
- `DOCUMENTACION-CODIGO.txt` → `docs/CODIGO.md` (convertir a MD)
- `diagrama-flujos.txt` → `docs/DIAGRAMA-FLUJOS.md` (convertir a MD)
- `estructura.txt` → ELIMINAR (obsoleto)
- `pasos-web` → ELIMINAR (obsoleto)
- `PROBLEMA-Y-SOLUCION.txt` → ELIMINAR (obsoleto)

### Mantener en raíz:
- `README.md` → Actualizar como README principal
- `README.txt` → ELIMINAR (duplicado)

---

## Fase 4: Eliminar Archivos Obsoletos

### Archivos HTML estáticos (no se usan en WordPress):
- `compra-billetes.html` → ELIMINAR
- `curiosidades.html` → ELIMINAR
- `test-calendar.html` → ELIMINAR

### Archivos del sistema:
- `.DS_Store` → ELIMINAR
- `BlogFerrocarriles.code-workspace-beta.code-workspace` → ELIMINAR

### Carpetas obsoletas/duplicadas:
- `/ferroblog` → ELIMINAR (versión antigua)
- `/ferroblog-final` → ELIMINAR (versión antigua)
- `ferroblog-tema-DEFINITIVO.zip` → ELIMINAR

### Carpetas HTML estáticas (contenido debe estar en WordPress):
- `/ciudades` → REVISAR contenido, luego ELIMINAR
- `/desarrollo-ciudades` → ELIMINAR (duplicado)
- `/estaciones` → REVISAR contenido
- `/estaciones-tren` → ELIMINAR (duplicado)
- `/informacion` → REVISAR contenido
- `/lineas` → REVISAR contenido
- `/noticias` → REVISAR contenido
- `/proyectos` → REVISAR contenido

---

## Fase 5: Actualizar Referencias en Código

### Archivos a actualizar:

1. **`functions.php`**
```php
// Cambiar:
wp_enqueue_style('ferrocarril-style', get_template_directory_uri() . '/styles.css');

// Por:
wp_enqueue_style('ferrocarril-style', get_template_directory_uri() . '/assets/css/styles.css');
```

2. **Todas las rutas de CSS y JS** en functions.php

---

## Fase 6: Consolidar y Mejorar Documentación

### README.md principal debe incluir:
1. Descripción del tema
2. Características principales
3. Instalación
4. Configuración
5. Estructura de archivos
6. Enlaces a documentación detallada en `/docs`

---

## Fase 7: Revisar Relaciones y Taxonomías

### Revisar en `functions.php` y `/inc/custom-taxonomies.php`:

1. **Categorías actuales:**
   - Históricas: Ancho Ibérico, Métrico, Internacional, Líneas Cerradas
   - Proyectos: Cancelados, Actuales, En Marcha, En Estudio
   - Noticias: Metro, Tranvía, AVE, Cercanías, etc.
   - Ciudades: Madrid, Barcelona, Valencia, Sevilla, Bilbao

2. **Taxonomía Ciudad:**
   - Ya implementada ✅
   - 20 ciudades españolas

3. **Posibles mejoras:**
   - Añadir taxonomía "Tipo de Tren" (AVE, Cercanías, Metro, etc.)
   - Añadir taxonomía "Estado" (Activo, Cerrado, En Construcción)

---

## Estructura Final Deseada

```
/
├── assets/
│   ├── css/
│   │   ├── styles.css
│   │   └── wp-style.css
│   ├── js/
│   │   ├── script.js
│   │   ├── config.js
│   │   └── wp-search.js
│   └── images/
│       └── logo-ferrocarril-esp.png
│
├── docs/
│   ├── ESTRUCTURA.md
│   ├── MEJORAS.md
│   ├── WORDPRESS.md
│   ├── CODIGO.md
│   ├── DIAGRAMA-FLUJOS.md
│   └── ...
│
├── inc/
│   ├── custom-post-types.php
│   ├── custom-taxonomies.php
│   └── custom-nav-walker.php
│
├── 404.php
├── archive.php
├── comments.php
├── footer.php
├── functions.php
├── header.php
├── index.php
├── README.md
├── search.php
├── sidebar.php
├── single.php
├── style.css
└── theme.json
```

---

## Orden de Ejecución

1. ✅ Crear carpeta `/assets` con subcarpetas
2. ✅ Crear carpeta `/docs`
3. ✅ Mover archivos CSS a `/assets/css/`
4. ✅ Mover archivos JS a `/assets/js/`
5. ✅ Mover imágenes a `/assets/images/`
6. ✅ Mover documentación a `/docs/`
7. ✅ Actualizar `functions.php` con nuevas rutas
8. ✅ Eliminar archivos obsoletos
9. ✅ Crear nuevo README.md principal
10. ✅ Revisar y documentar relaciones/taxonomías

---

## Notas Importantes

- ⚠️ **NO eliminar** carpetas con contenido HTML sin revisar primero
- ⚠️ **Hacer backup** antes de eliminar
- ✅ **Mantener** todos los archivos PHP de plantillas
- ✅ **Mantener** `style.css` en raíz (obligatorio WordPress)
- ✅ **Testear** después de cada fase

---

Fecha de creación: 9 de noviembre de 2025