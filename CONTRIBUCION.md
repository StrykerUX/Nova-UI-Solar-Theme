# Guía de Contribución - Nova UI Solar Theme

¡Gracias por tu interés en contribuir al tema Nova UI Solar! Esta guía te ayudará a entender el proceso para contribuir de manera efectiva al proyecto.

## Índice

1. [Código de Conducta](#código-de-conducta)
2. [¿Cómo puedo contribuir?](#cómo-puedo-contribuir)
   - [Reportando Bugs](#reportando-bugs)
   - [Sugiriendo Mejoras](#sugiriendo-mejoras)
   - [Enviando Pull Requests](#enviando-pull-requests)
3. [Estándares de Código](#estándares-de-código)
4. [Proceso de Desarrollo](#proceso-de-desarrollo)
5. [Estructura del Proyecto](#estructura-del-proyecto)
6. [Estrategia de Ramas](#estrategia-de-ramas)
7. [Versionado](#versionado)

## Código de Conducta

Este proyecto y todos los participantes están bajo un Código de Conducta que promueve un entorno abierto, respetuoso e inclusivo. Al participar, se espera que respetes este código.

## ¿Cómo puedo contribuir?

### Reportando Bugs

- **Usa la plantilla de issues para bugs**
- Verifica primero si el bug ya ha sido reportado
- Incluye pasos detallados para reproducir el problema
- Menciona la versión del tema, WordPress y PHP que estás utilizando
- Adjunta capturas de pantalla si es posible

### Sugiriendo Mejoras

- **Usa la plantilla de issues para sugerencias**
- Explica claramente la mejora y sus beneficios
- Si es posible, incluye mockups o ejemplos
- Considera cómo se integraría con la arquitectura existente

### Enviando Pull Requests

1. Haz fork del repositorio
2. Crea una rama para tu característica (`git checkout -b feature/nombre-caracteristica`)
3. Realiza tus cambios siguiendo los estándares del proyecto
4. Ejecuta pruebas si están disponibles
5. Envía un Pull Request detallado explicando los cambios

## Estándares de Código

Para mantener la consistencia en el código:

### PHP
- Sigue las [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/)
- Usa nombres descriptivos para funciones y variables
- Añade comentarios para bloques de código complejos
- Prefija todas las funciones, clases y constantes con `nova_ui_`

### CSS
- Usa variables CSS para valores reutilizables
- Organiza el CSS en secciones lógicas con comentarios
- Mantén selectores específicos y evita anidamiento excesivo
- Sigue la nomenclatura BEM para clases CSS

### JavaScript
- Usa ECMAScript 6+ donde sea posible
- Comenta el código apropiadamente
- Evita dependencias innecesarias
- Prefija todas las funciones y variables globales con `novaUI`

## Proceso de Desarrollo

1. **Planificación**: Las nuevas características se discuten primero como issues
2. **Desarrollo**: Se implementan en ramas separadas
3. **Revisión**: Code review a través de pull requests
4. **Testing**: Pruebas manuales en diferentes entornos WordPress
5. **Documentación**: Actualización de documentación relevante
6. **Merge**: Integración a la rama principal
7. **Release**: Según el calendario de versiones

## Estructura del Proyecto

Familiarízate con la [estructura del proyecto](README.md#estructura-del-proyecto) antes de contribuir.

## Estrategia de Ramas

- `main`: Rama principal, siempre estable
- `dev`: Rama de desarrollo, integración de características
- `feature/*`: Ramas para nuevas características
- `fix/*`: Ramas para corrección de bugs
- `release/*`: Ramas para preparación de releases
- `v*.*.*`: Ramas de versiones estables

## Versionado

Este proyecto sigue [Semantic Versioning](https://semver.org/):

- **MAJOR**: Cambios incompatibles con versiones anteriores
- **MINOR**: Nuevas funcionalidades compatibles con versiones anteriores
- **PATCH**: Correcciones de bugs compatibles con versiones anteriores

Los cambios deben documentarse siempre en el archivo CHANGELOG.md.

---

¡Gracias por contribuir al proyecto Nova UI Solar Theme!
