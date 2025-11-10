# 📸 Instrucciones para crear screenshot.png

## ¿Qué es screenshot.png?

El archivo `screenshot.png` es una imagen que se muestra en el administrador de WordPress cuando seleccionas un tema. Es **obligatorio** si quieres publicar el tema en el repositorio de WordPress.

## Especificaciones

- **Tamaño**: 1200x900 píxeles (4:3)
- **Formato**: PNG
- **Ubicación**: Raíz del tema (mismo nivel que style.css)
- **Nombre**: `screenshot.png` (exactamente así, en minúsculas)

## Cómo crearlo

### Opción 1: Captura de pantalla del sitio

1. Abre tu sitio web en el navegador
2. Asegúrate de que se vea bien (página de inicio)
3. Usa una herramienta de captura de pantalla o extensión del navegador
4. Recorta la imagen a 1200x900 píxeles
5. Guarda como `screenshot.png` en la raíz del tema

### Opción 2: Herramientas de diseño

Puedes usar:
- **Photoshop** o **GIMP** (gratis)
- **Canva** (online)
- **Figma** (online)
- Cualquier editor de imágenes

Crea un diseño que represente tu tema:
- Incluye el logo
- Muestra la estructura principal
- Usa los colores del tema (#1A2F0F y #f59e42)

### Opción 3: Generador automático

Puedes usar herramientas online como:
- WordPress Theme Screenshot Generator
- O simplemente hacer una captura de pantalla de tu sitio

## Verificación

Después de crear el archivo:

1. Colócalo en la raíz del tema (junto a style.css)
2. Ve a WordPress Admin → Apariencia → Temas
3. Deberías ver la captura de pantalla del tema

## Nota importante

**NO incluyo el archivo screenshot.png en el código** porque:
- Es una imagen que debe ser específica de tu sitio
- Puede contener información personal
- Es mejor que lo crees tú con una captura real de tu sitio

## Ejemplo de estructura

```
tema-ferrocarril-esp/
├── style.css
├── functions.php
├── index.php
├── screenshot.png  ← AQUÍ (1200x900px)
├── theme.json
└── ...
```

