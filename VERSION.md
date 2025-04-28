# Nova UI Solar Theme - Versión 0.1.2

## Información de Versión

- **Versión:** 0.1.2
- **Fecha de lanzamiento:** 28 de abril de 2025
- **Estado:** Alpha
- **Compatible con WordPress:** 6.4+
- **Requiere PHP:** 7.4+

## Descripción

Esta es una actualización de corrección de errores que soluciona problemas específicos con la funcionalidad del botón de colapso de la barra lateral. Mejora la estabilidad general del tema y optimiza el rendimiento al reorganizar el código JavaScript, separando las funcionalidades en archivos independientes.

## Cambios Desde v0.1.1

### Corregido
- Solucionado el problema de funcionalidad duplicada en el sidebar toggle
- Separado el script de sidebar-toggle a un archivo independiente para evitar conflictos
- Actualizado el sistema de carga de scripts en functions.php para optimizar el rendimiento
- Implementada una solución para el colapso correcto de la barra lateral en diferentes estilos visuales

### Mejorado
- Reorganización del código JavaScript para mayor mantenibilidad
- Mejora en la prioridad de carga de scripts críticos
- Optimización del rendimiento general del sidebar toggle

## Archivos JavaScript Reorganizados

Los scripts JavaScript han sido reorganizados de la siguiente manera:

1. **sidebar-toggle.js**: Nuevo archivo específico para la funcionalidad de colapso de la barra lateral
2. **main.js**: Mantiene funcionalidades generales sin el código duplicado de sidebar toggle
3. **theme-switcher.js**: Sin cambios, mantiene la funcionalidad de cambio de estilos visuales

### Cambios en la Carga de Scripts

Se ha modificado el archivo `functions.php` para:
- Cargar scripts críticos con máxima prioridad
- Evitar conflictos entre archivos JavaScript
- Optimizar el orden de carga para mejor rendimiento

## Instrucciones de Actualización

Si vienes de la versión 0.1.1:

1. Actualiza todos los archivos del tema
2. Asegúrate de vaciar cualquier caché de WordPress y del navegador para asegurar que los nuevos scripts se carguen correctamente

## Características Principales

El tema mantiene todas las características y mejoras de las versiones anteriores:

- Estructura base del tema WordPress 
- Plantilla de dashboard interactiva
- Estilo visual Soft Neo-Brutalism completo
- Sistema de tema claro/oscuro
- Framework para múltiples estilos visuales
- Integración con menús nativos de WordPress
- Soporte para iconos en elementos del menú
- Compatibilidad con plugins WordPress estándar

## Solución de Problemas

Si experimenta problemas con la barra lateral después de actualizar:

1. Verifica que estás utilizando la última versión de todos los archivos
2. Prueba a forzar la recarga del navegador con Ctrl+F5 o Cmd+Shift+R
3. Desactiva los plugins de caché si estás utilizando alguno
4. Prueba el tema en el modo seguro de WordPress para descartar conflictos con plugins

## Próximos Pasos

La versión 0.2.0 incluirá:
- Implementación del estilo Neo-Brutalism
- Mejoras en la plantilla de dashboard
- Opciones adicionales en el customizer

Para más detalles sobre los cambios, consulta el archivo [CHANGELOG.md](CHANGELOG.md).

---

Para contribuir o reportar problemas, por favor visita el [repositorio en GitHub](https://github.com/StrykerUX/Nova-UI-Solar-Theme).
