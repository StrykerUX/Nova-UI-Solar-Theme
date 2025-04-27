# Nova UI Solar Theme

[![Version](https://img.shields.io/badge/version-0.1.0-blue.svg)](VERSION.md)
[![WordPress](https://img.shields.io/badge/wordpress-6.4%2B-green.svg)](https://wordpress.org/)
[![PHP](https://img.shields.io/badge/php-7.4%2B-purple.svg)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-GPL--2.0%2B-orange.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

Un tema WordPress modular con múltiples estilos visuales (Neo-Brutalist, Soft Neo-Brutalist, Futurismo Minimalista, Cyberpunk) para aplicaciones SaaS y paneles de administración.

![Vista previa del tema](https://via.placeholder.com/800x400?text=Vista+Previa+Nova+UI+Solar)

## Características Principales

- **Múltiples Estilos Visuales**: Framework para implementar diferentes estilos visuales
- **Plantilla de Dashboard**: Panel interactivo con múltiples componentes y widgets
- **Cambio Dinámico de Estilos**: Sistema para alternar entre estilos sin recarga
- **Modo Claro/Oscuro**: Soporte para preferencias de temas por usuario
- **Sistema Modular**: Arquitectura que facilita extensión y personalización
- **Compatibilidad WordPress**: Funciona con plugins estándar de WordPress

## Estado Actual del Desarrollo (v0.1.0)

El tema está en **fase alpha** con la estructura básica implementada:

- ✅ Estructura base completa
- ✅ Estilo "Soft Neo-Brutalism" implementado
- ✅ Plantilla de dashboard funcional
- ✅ Sistema de cambio claro/oscuro
- ⬜ Estilos Neo-Brutalism, Futurismo Minimalista y Cyberpunk (pendientes)
- ⬜ Plantillas adicionales (pendientes)

Para más detalles sobre la versión actual, consulta el [CHANGELOG](CHANGELOG.md).

## Requisitos

- WordPress 6.4 o superior
- PHP 7.4 o superior
- Navegador moderno con soporte para CSS Variables

## Instalación

1. Descarga la [última versión](https://github.com/StrykerUX/Nova-UI-Solar-Theme/releases) como archivo ZIP
2. En WordPress, ve a **Apariencia > Temas > Añadir nuevo > Subir tema**
3. Sube el archivo ZIP descargado
4. Activa el tema

## Uso

### Dashboard
1. Crea una nueva página en WordPress
2. En el panel lateral, selecciona "Dashboard" como plantilla
3. Publica la página y visítala para ver el panel con el estilo Soft Neo-Brutalism

### Cambio de Estilos Visuales
- Cuando estés logueado como administrador, aparecerá un selector de estilos en la parte inferior derecha
- Selecciona entre los diferentes estilos disponibles (Solo Soft Neo-Brutalism implementado actualmente)

### Modo Claro/Oscuro
- Utiliza el botón de sol/luna en la barra superior para cambiar entre modo claro y oscuro

## Estructura del Proyecto

```
nova-ui-solar/
├── assets/                      # Recursos estáticos
│   ├── css/                     # Estilos CSS
│   │   ├── base.css             # Estilos base compartidos
│   │   └── themes/              # Estilos específicos por tema visual
│   │       └── soft-neo-brutalism.css    # Estilo actual implementado
│   └── js/                      # JavaScript
│       ├── main.js              # Funcionalidad principal
│       └── theme-switcher.js    # Cambio de estilos visuales
├── inc/                         # Funciones PHP adicionales
│   ├── customizer.php           # Personalización del tema
│   ├── helpers.php              # Funciones auxiliares
│   ├── template-tags.php        # Funciones para plantillas
│   └── class-nova-ui-walker-nav-menu.php # Personalización de menús
├── page-templates/              # Plantillas especializadas
│   └── dashboard.php            # Plantilla para dashboard
├── template-parts/              # Componentes reutilizables
│   └── dashboard/               # Partes de dashboard
│       ├── sidebar.php          # Barra lateral
│       └── topbar.php           # Barra superior
├── functions.php                # Funcionalidad principal
├── style.css                    # Información del tema
├── index.php                    # Plantilla principal
├── header.php                   # Cabecera del sitio
└── footer.php                   # Pie de página
```

## Personalización

El tema incluye opciones para personalizar:
- Estilo visual (Solo Soft Neo-Brutalism implementado actualmente)
- Modo claro/oscuro
- Estado de la barra lateral (expandida/colapsada)

## Próximos Pasos

- Implementar los estilos Neo-Brutalism, Futurismo Minimalista y Cyberpunk
- Añadir más plantillas (perfil, configuración, etc.)
- Mejorar widgets de dashboard
- Añadir opciones adicionales de personalización
- Implementar sistema de exportación/importación de configuraciones

## Contribución

Las contribuciones son bienvenidas. Por favor, sigue estos pasos:

1. Haz fork del repositorio
2. Crea una rama para tu característica (`git checkout -b feature/amazing-feature`)
3. Realiza tus cambios
4. Haz commit de tus cambios (`git commit -m 'Añadir una característica increíble'`)
5. Sube tu rama (`git push origin feature/amazing-feature`)
6. Abre un Pull Request

## Licencia

Distribuido bajo la licencia GPL v2 o posterior. Consulta el archivo `LICENSE` para más información.

## Contacto

StrykerUX - [GitHub](https://github.com/StrykerUX)

Enlace del proyecto: [https://github.com/StrykerUX/Nova-UI-Solar-Theme](https://github.com/StrykerUX/Nova-UI-Solar-Theme)
