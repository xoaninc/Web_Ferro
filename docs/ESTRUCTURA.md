# Estructura del Tema y Modularización

## Secciones y Categorías

- Inicio
- Curiosidades (subsección de lista)
- FAQ
- Noticias (filtro ciudad, tecnología, accidentes, historia)
- Infografía (líneas: Ibérico, Métrico, Internacional, otros, cerradas)
  - Desarrollo de Ciudades (por ciudad)
  - Estaciones (provincia, ciudad, desmanteladas)
  - Proyectos (cancelados, en marcha, en estudio, históricos)
  - Mapas (históricos, interactivos, de tráfico)
  - Visualización de datos
- Compra de Billetes
- Eventos Ferroviarios (apertura, inicio, fin obras, especial, mantenimiento, cambio de horarios, aniversario, accidentes, proyectos retrasados, filtro avanzado)
- Visualización Avanzada (búsqueda avanzada, comparador de líneas, panel)

## Modularización recomendada

- event-api-sync.php: flujo principal de sincronización
- event-api-fetchers.php: peticiones, parseo, normalización
- event-api-admin.php: administración y panel
- event-api-utils.php: logs y utilidades
- event-api-mappers.php: lógica de mapeo

## Estructura básica de carpetas

- assets/
    - css/, js/, images/
- docs/ (documentación)
- inc/ (código PHP modular)
- theme files: style.css, functions.php, templates

## Taxonomías principales

- Ciudad (20 principales)
- Tipo de línea
- Tipo de proyecto
- Tipo de evento

## Reglas/resumen

- Mantener archivos pequeños y por funcionalidad
- Sólo añadir categorías nuevas si hay cambios reales
- Eliminar siempre info obsoleta de docs
