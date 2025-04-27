# Nova UI Solar Theme - Versión 0.1.0

## Información de Versión

- **Versión:** 0.1.0
- **Fecha de lanzamiento:** 27 de abril de 2025
- **Estado:** Alpha
- **Compatible con WordPress:** 6.4+
- **Requiere PHP:** 7.4+

## Descripción

Esta es la primera versión del tema Nova UI Solar, que incluye la estructura base y el primer estilo visual "Soft Neo-Brutalism". Este lanzamiento establece las bases para un sistema modular de temas visuales para WordPress sin necesidad de compilación.

## Características Principales

- Estructura base del tema WordPress 
- Plantilla de dashboard interactiva
- Estilo visual Soft Neo-Brutalism completo
- Sistema de tema claro/oscuro
- Framework para múltiples estilos visuales
- Compatibilidad con plugins WordPress estándar

## Arquitectura

El tema sigue un enfoque **tradicional de WordPress** que:
- Utiliza PHP, HTML, CSS y JavaScript simple
- Implementa diferentes estilos visuales mediante archivos CSS independientes
- Mantiene la compatibilidad con plugins existentes
- Permite cambiar entre estilos visuales sin necesidad de compilación

## Cómo Utilizar Esta Versión

### Instalación
1. Descarga el ZIP de esta versión 
2. Accede a WordPress > Apariencia > Temas > Añadir nuevo > Subir tema
3. Selecciona el archivo ZIP descargado
4. Activa el tema

### Uso del Dashboard
1. Crea una nueva página
2. Selecciona la plantilla "Dashboard" 
3. Publica la página

### Cambiar entre Modo Claro/Oscuro
- Utiliza el botón de sol/luna en la barra superior

## Notas para Desarrolladores

Esta versión establece la base para el desarrollo futuro:

```
nova-ui-solar/
├── assets/                      # Recursos estáticos
│   ├── css/                     # Estilos CSS
│   │   ├── base.css             # Estilos base compartidos
│   │   └── themes/              # Estilos específicos por tema visual
│   │       └── soft-neo-brutalism.css    # Estilo Soft Neo-Brutalism
│   └── js/                      # JavaScript
├── inc/                         # Funciones PHP adicionales
├── page-templates/              # Plantillas de página especializadas
│   └── dashboard.php            # Plantilla para el dashboard principal
├── template-parts/              # Componentes reutilizables
└── *.php                        # Archivos base del tema
```

## Próximos Pasos

La versión 0.2.0 incluirá:
- Implementación del estilo Neo-Brutalism
- Mejoras en la plantilla de dashboard
- Opciones adicionales en el customizer

Para más detalles sobre los cambios, consulta el archivo [CHANGELOG.md](CHANGELOG.md).

---

Para contribuir o reportar problemas, por favor visita el [repositorio en GitHub](https://github.com/StrykerUX/Nova-UI-Solar-Theme).
