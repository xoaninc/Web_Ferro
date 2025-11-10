# Guía rápida de uso y FAQ

- Para crear noticias, líneas, estaciones, proyectos o eventos usa el panel estándar de WordPress.
- Personaliza el logo y menús desde Apariencia > Personalizar.
- Los eventos se actualizan automáticamente si configuras las APIs en admin (más en docs/API.md).

## Categorías y ciudades
- Añade ciudades y categorías desde Entradas > Categorías.
- Hay 20 ciudades principales, pero puedes crear las que quieras.

## Cómo añadir un evento manual
1. Entra en Eventos > Añadir nuevo
2. Pon título, descripción, fechas y elige tipo de evento y ciudad

## Actualización y sincronización
- Todo el calendario se sincroniza solo (no se requiere intervención manual salvo primer uso si quieres importar ya).
- Puedes desactivar la sync automática desde Herramientas > Eventos programados (plugin WP Crontrol necesario)

## Preguntas frecuentes

- ¿Se pueden añadir más APIs? Sí, solo añade el método en inc/event-api-sync.php
- ¿Cómo cambio agrupadores o menús? Basta con editar o mover en Apariencia > Menús o Entradas > Categorías
- ¿El tema sirve para Gutenberg y plugins? Sí, estándar WP

## Más ayuda
Lee README o consulta issues en el repo.