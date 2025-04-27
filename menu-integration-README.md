# Integración del Menú Lateral con WordPress - Nova UI Solar Theme

Esta documentación explica cómo integrar el panel lateral del tema Nova UI Solar con el sistema nativo de menús de WordPress, permitiéndote gestionar los elementos del menú directamente desde el panel de administración (Apariencia > Menús).

## Características principales

- ✅ Gestión completa del menú lateral desde el panel de administración de WordPress
- ✅ Campo personalizado para asignar iconos a los elementos del menú
- ✅ Asignación automática de iconos basada en el título del elemento (si no se especifica uno)
- ✅ Soporte completo para submenús (hasta 2 niveles)
- ✅ Indicadores visuales para elementos activos
- ✅ Mantiene el estilo visual del tema (Soft Neo-Brutalism, etc.)
- ✅ Instrucciones integradas para administradores en el panel de WordPress

## Archivos incluidos

1. **`inc/menu-integration.php`** - Contiene la clase walker personalizada y las funciones para integrar con el sistema de menús de WordPress
2. **`template-parts/dashboard/sidebar-updated.php`** - Plantilla actualizada del sidebar que utiliza el walker personalizado
3. **`assets/css/themes/soft-neo-brutalism-sidebar.css`** - Estilos CSS para el sidebar
4. **`assets/js/sidebar-enhanced.js`** - JavaScript mejorado para la funcionalidad del sidebar
5. **`inc/functions-update.php`** - Instrucciones para actualizar el archivo functions.php

## Pasos para la implementación

### 1. Incluir el archivo de integración de menús

Edita el archivo `functions.php` y añade la siguiente línea después de los otros archivos include:

```php
require_once NOVA_UI_DIR . '/inc/menu-integration.php';
```

### 2. Actualizar la función de carga de scripts y estilos

En la función `nova_ui_scripts()` de tu archivo `functions.php`, añade las siguientes líneas:

```php
// Después de cargar el estilo visual específico
wp_enqueue_style('nova-ui-soft-neo-brutalism-sidebar', NOVA_UI_ASSETS_URI . '/css/themes/soft-neo-brutalism-sidebar.css', array('nova-ui-' . $active_style), NOVA_UI_VERSION);

// Después de cargar el script para cambio de tema claro/oscuro
wp_enqueue_script('nova-ui-sidebar-enhanced', NOVA_UI_ASSETS_URI . '/js/sidebar-enhanced.js', array('jquery'), NOVA_UI_VERSION, true);
```

### 3. Reemplazar el archivo del sidebar

Renombra el archivo existente como respaldo:
```
mv template-parts/dashboard/sidebar.php template-parts/dashboard/sidebar-backup.php
```

Luego, renombra el archivo actualizado:
```
mv template-parts/dashboard/sidebar-updated.php template-parts/dashboard/sidebar.php
```

### 4. Eliminar o comentar la clase walker anterior (si existe)

Si ya tienes una clase `Nova_UI_Walker_Nav_Menu` definida en tu `functions.php` o en otro archivo, coméntala o elimínala para evitar conflictos.

## Uso del sistema de menús

### Crear y configurar un menú para el sidebar

1. Ve a **Apariencia > Menús** en el panel de administración de WordPress
2. Crea un nuevo menú o edita uno existente
3. Añade las páginas, categorías, enlaces personalizados u otros elementos que deseas mostrar
4. En la sección "Configuración del menú", marca la ubicación "Menú Lateral"
5. Haz clic en "Guardar menú"

### Asignar iconos a los elementos del menú

#### Método 1: Usando el campo personalizado
1. En la pantalla de edición del menú, verás un campo "Icono" para cada elemento
2. Introduce una clase de icono Tabler Icons (por ejemplo: `ti-home`, `ti-chart-bar`)
3. Guarda el menú

#### Método 2: Usando clases CSS
1. Haz clic en "Opciones de pantalla" en la esquina superior derecha
2. Activa la casilla "Clases CSS" si no está activada
3. Para cada elemento del menú, añade la clase de icono (por ejemplo: `ti-home`) en el campo "Clases CSS"
4. Guarda el menú

### Iconos disponibles

Puedes usar cualquiera de los iconos disponibles en la biblioteca Tabler Icons. Algunos ejemplos comunes:

- `ti-home` - Icono de inicio/dashboard
- `ti-chart-bar` - Icono de análisis/estadísticas
- `ti-message-circle` - Icono de chat/mensajes
- `ti-link` - Icono de enlaces
- `ti-file-text` - Icono de documentos
- `ti-calendar` - Icono de calendario
- `ti-briefcase` - Icono de proyectos
- `ti-settings` - Icono de configuración
- `ti-user` - Icono de usuario/perfil

Puedes encontrar más iconos en [los repositorios de Tabler Icons proporcionados](https://github.com/tabler/tabler-icons/tree/main/icons).

### Asignación automática de iconos

Si no especificas un icono, el sistema intentará asignar automáticamente uno basado en el título del elemento del menú. Por ejemplo:

- Si el título contiene "dash", usará el icono `ti-home`
- Si el título contiene "analytic" o "analy", usará el icono `ti-chart-bar`
- Si el título contiene "chat", usará el icono `ti-message-circle`
- Etc.

## Estructura del menú y submenús

El sistema soporta hasta 2 niveles de menú:

- **Primer nivel**: Elementos principales en la barra lateral
- **Segundo nivel**: Submenús desplegables

Para crear un submenú:
1. Añade un elemento principal al menú
2. Añade otro elemento y arrástralo ligeramente a la derecha debajo del elemento principal
3. WordPress lo interpretará como un elemento hijo (submenú)
4. El elemento principal mostrará automáticamente un indicador de desplegable

## Solución de problemas

### El menú no aparece en el sidebar
- Verifica que has asignado el menú a la ubicación "Menú Lateral" en Apariencia > Menús
- Comprueba que has incluido correctamente el archivo `menu-integration.php`
- Asegúrate de que estás utilizando el archivo `sidebar.php` actualizado

### Los iconos no se muestran correctamente
- Verifica que has especificado correctamente las clases de iconos (deben comenzar con `ti-`)
- Comprueba que la biblioteca Tabler Icons está cargada correctamente
- Asegúrate de que has añadido las clases en el campo correcto (Icono o Clases CSS)

### Los submenús no se despliegan
- Asegúrate de que has cargado el archivo JavaScript `sidebar-enhanced.js`
- Verifica que jQuery está cargado correctamente
- Comprueba que la estructura del menú es correcta (elementos padre e hijos)

## Personalización adicional

Puedes personalizar aún más la apariencia y comportamiento del menú lateral ajustando los siguientes archivos:

- **`inc/menu-integration.php`**: Modifica la clase `Nova_UI_Sidebar_Menu_Walker` para cambiar la estructura HTML
- **`assets/css/themes/soft-neo-brutalism-sidebar.css`**: Ajusta los estilos CSS
- **`assets/js/sidebar-enhanced.js`**: Personaliza el comportamiento JavaScript

## Compatibilidad con otros estilos visuales

La integración está diseñada para funcionar con todos los estilos visuales del tema Nova UI Solar (Soft Neo-Brutalism, Neo-Brutalism, Futurismo Minimalista y Cyberpunk). El archivo `sidebar.php` incluye condiciones para mostrar diferentes elementos según el estilo activo.
