# Nova UI Solar Theme - Versión 0.1.1

## Información de Versión

- **Versión:** 0.1.1
- **Fecha de lanzamiento:** 27 de abril de 2025
- **Estado:** Alpha
- **Compatible con WordPress:** 6.4+
- **Requiere PHP:** 7.4+

## Descripción

Esta es una actualización menor que mejora la integración del menú lateral con WordPress. Corrige problemas en la visualización y funcionalidad de la barra lateral para proporcionar una mejor experiencia de usuario y facilitar la personalización de menús a través del sistema nativo de WordPress.

## Cambios Desde v0.1.0

### Corregido
- Mejorada la integración de menús en la barra lateral con el sistema nativo de WordPress
- Corregidos errores de estilo CSS en el sidebar para mejor visualización
- Implementada correcta funcionalidad de menús colapsables en la barra lateral

### Mejorado
- Actualización de la plantilla sidebar.php para mostrar menús dinámicos de WordPress
- Mejoras visuales en la presentación de elementos del menú lateral
- Documentación adicional para la configuración del menú lateral

## Funcionalidad de Menú Lateral

La barra lateral ahora puede configurarse de dos formas:

1. **Menú por defecto**: Si no se asigna un menú a la ubicación "sidebar" en WordPress, se mostrará un menú predeterminado con iconos y estructura acorde al estilo visual activo.

2. **Menú personalizado**: Al crear y asignar un menú a la ubicación "sidebar" en WordPress (Apariencia > Menús), este se mostrará con el estilo correspondiente al tema visual seleccionado.

### Integración con WordPress

- La clase `Nova_UI_Sidebar_Menu_Walker` se utiliza para generar la estructura HTML adecuada para los menús
- Se soportan hasta 2 niveles de profundidad (menús y submenús)
- Los administradores verán un mensaje y enlace para configurar el menú si no hay ninguno asignado

## Instrucciones de Actualización

Si vienes de la versión 0.1.0:

1. Actualiza todos los archivos del tema
2. Verifica la configuración de menús en WordPress (Apariencia > Menús)
3. Asigna un menú a la ubicación "sidebar" para personalizar la barra lateral

## Características Principales

El tema mantiene todas las características de la versión 0.1.0:

- Estructura base del tema WordPress 
- Plantilla de dashboard interactiva
- Estilo visual Soft Neo-Brutalism completo
- Sistema de tema claro/oscuro
- Framework para múltiples estilos visuales
- Compatibilidad con plugins WordPress estándar

## Próximos Pasos

La versión 0.2.0 incluirá:
- Implementación del estilo Neo-Brutalism
- Mejoras en la plantilla de dashboard
- Opciones adicionales en el customizer

Para más detalles sobre los cambios, consulta el archivo [CHANGELOG.md](CHANGELOG.md).

---

Para contribuir o reportar problemas, por favor visita el [repositorio en GitHub](https://github.com/StrykerUX/Nova-UI-Solar-Theme).
