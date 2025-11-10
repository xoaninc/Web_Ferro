# APIs integradas en Ferrocarril Esp

## Renfe Cercanías GTFS-RT
- URL: https://gtfsrt.renfe.com/api/alerts
- Importa alertas en tiempo real, avisos, líneas afectadas

## Renfe Data API
- URL base: https://data.renfe.com/api/3/action/datastore_search
- Requiere resource_id (configuración admin)
- Importa incidencias históricas, eventos, mantenimientos

## ADIF WMS/WFS
- URL base: https://ideadif.adif.es/services/wms (GeoJSON vía WFS)
- Capa configurable (incidencias, obras, estaciones, infraestructuras)

## Datos.gob.es
- URLs configurables (CSV, JSON, GeoJSON)
- Importa datasets oficiales de transporte/gobierno

## Configuración rápida
- Activa el tema, configura parámetros en Eventos → Sincronizar APIs
- Consulta logs de sincronización en el panel de administración
- Puedes añadir/quitar fuentes simplemente dejando el campo en blanco

## Problemas comunes
- Revisa logs en el panel de administración o debug.log
- WP-Cron debe estar funcionando
- Configurar timeouts o permisos si alguna API da error