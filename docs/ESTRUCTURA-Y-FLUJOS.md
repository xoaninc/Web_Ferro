# Estructura y Diagrama de Flujos actualizada (noviembre 2025)

---

## 1. Diagrama de Secciones y Categorías

Estructura completa del sitio según theme, incluyendo nuevas categorías y secciones sugeridas:

```
Inicio
│
├── Curiosidades
│     └── Subsección: Lista de curiosidades
├── FAQ
├── Noticias
│   └── Filtro: Ciudades (COMPARTIDA con Infografía)
│   └── Filtro: Categorías noticias (accidentes, tecnología, historia, eventos internacionales)
├── Infografía
│   ├── Líneas
│   │   ├── Ancho Ibérico
│   │   ├── Ancho Métrico
│   │   ├── Ancho Internacional
│   │   ├── Otros anchos
│   │   └── Líneas cerradas
│   ├── Desarrollo de Ciudades
│   │   └── Filtro: Ciudad (COMPARTIDO)
│   ├── Estaciones
            Mapa Interactivo de Provincias
│   ├── Proyectos
│   │   ├── Cancelados
│   │   ├── En marcha
│   │   ├── En estudio
│   └── Visualización de datos
├── Compra de Billetes
│
├── Eventos Ferroviarios
│   ├── Apertura de línea (API)
│   ├── Inicio de obras (API)
│   ├── Fin de obras (API)
│   ├── Evento especial (API)
│   ├── Mantenimiento (API)
│   ├── Cambio de horarios (API)
│   ├── Aniversario (MANUAL)
│   ├── Accidentes (nueva, si futuro API/CSV)
│   ├── Proyectos retrasados (nueva, si API)
│   └── Filtrado por ciudad, fecha, categoría
│
└── Visualización Avanzada
    ├── Búsqueda avanzada (futura)
    ├── Comparador de líneas (futura)
    └── Panel estadístico
```

---

## 2. Modularización de Código y Archivos Sugerida

Debido al tamaño y crecimiento del sistema, el código PHP debe dividirse en varios archivos para facilitar mantenimiento y edición:

**Archivos en `inc/`:**
- `event-api-sync.php`: Clase principal, ejecución de sincronización total y métodos de orquestación.
- `event-api-fetchers.php`: Métodos para peticiones HTTP y normalización (fetch_json, fetch_csv, normalize_datos_gob, etc), utilidades de parseo.
- `event-api-admin.php`: Todo lo relacionado con administración, render_admin_page, add_admin_menu, lógica de logs y forms.
- `event-api-utils.php`: Funciones de logging, sanitización y utilidades independientes reutilizables.
- `event-api-mappers.php`: Si el código lo requiere para mapear/convertir tipos externos (de API a taxonomía interna).

**Recomendación**: Mantener una sola clase por archivo. Si crecen mucho los métodos, dividir fetchers e integraciones por proveedor (ej: `event-renfe-fetcher.php`, `event-adif-fetcher.php`).

**Ejemplo mínimo de estructura modularizada:**

```
inc/
├── event-api-sync.php  -- solo orquestador y flujo principal
├── event-api-fetchers.php  -- solo métodos de consulta/preproceso datos
├── event-api-admin.php  -- solo administración y forms
├── event-api-utils.php  -- solo logs y helpers
├── event-api-mappers.php -- si hay lógica de mapeo extra
```

---

## 3. Nuevas Categorías y Secciones Añadidas

- Noticias: tecnología, historia, accidentes, eventos internacionales
- Proyectos: proyectos históricos (nueva)
- Estaciones: estaciones desmanteladas (nueva)
- Mapas: mapas históricos, interactivos, de tráfico (nueva)
- Eventos: accidentes, proyectos retrasados (sujeto a datos disponibles)
- Visualización avanzada: buscador avanzado, comparador, panel

**Nota:** No se elimina ninguna sección anterior, solo se agregan posibles agrupaciones y filtros futuros si los tipos de dato/estructura y la API/documentos lo permiten.

---

## 4. Observaciones y Mejores Prácticas

- Mantener archivos PHP grandes divididos por funcionalidad
- No eliminar ni sobrescribir las categorías/secciones ya existentes
- Si surge una nueva fuente/API o integración, crear un archivo nuevo en `inc/` y actualizar esta estructura
- No usar emojis en los documentos de información
- Actualizar la documentación cada vez que se agregue una categoría, sección, tipo de evento, función, o clase nueva
