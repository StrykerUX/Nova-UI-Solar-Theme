# Nova UI Solar Theme

[![Version](https://img.shields.io/badge/version-0.1.1-blue.svg)](VERSION.md)
[![WordPress](https://img.shields.io/badge/wordpress-6.4%2B-green.svg)](https://wordpress.org/)
[![PHP](https://img.shields.io/badge/php-7.4%2B-purple.svg)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-GPL--2.0%2B-orange.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

Un tema WordPress modular con múltiples estilos visuales (Neo-Brutalist, Soft Neo-Brutalist, Futurismo Minimalista, Cyberpunk) para aplicaciones SaaS y paneles de administración.

![Vista previa del tema](https://via.placeholder.com/800x400?text=Vista+Previa+Nova+UI+Solar)

## 🆕 Novedades en v0.1.1

- **Menú lateral mejorado**: Integración optimizada con el sistema de menús de WordPress
- **Soporte para iconos en menús**: Uso de [iconos Tabler](https://github.com/tabler/tabler-icons) en elementos de menú
- **Correcciones de estilos CSS**: Mejora visual en la presentación del sidebar
- **Nueva documentación**: Guía detallada para [configurar el menú lateral](MENU-LATERAL.md)

[Ver el registro completo de cambios](CHANGELOG.md)

## Estado actual del desarrollo

El tema está en fase alpha con la estructura básica implementada:

- ✅ Estructura base del tema WordPress completa
- ✅ Estilo visual "Soft Neo-Brutalism" implementado
- ✅ Plantilla de dashboard funcional
- ✅ Sistema de cambio claro/oscuro
- ✅ Menú lateral integrado con WordPress
- ⬜ Estilos Neo-Brutalism, Futurismo Minimalista y Cyberpunk (pendientes)

## Estructura del proyecto

```
nova-ui-solar/
├── assets/                      # Recursos estáticos
│   ├── css/                     # Estilos CSS
│   │   ├── base.css             # Estilos base compartidos
│   │   └── themes/              # Estilos específicos por tema visual
│   │       └── soft-neo-brutalism.css    # Estilo Soft Neo-Brutalism
│   └── js/                      # JavaScript
│       ├── main.js              # Funcionalidad principal del tema
│       └── theme-switcher.js    # Script para cambiar estilos visuales
├── inc/                         # Funciones PHP adicionales
│   ├── template-functions.php   # Funciones de plantilla
│   ├── class-nova-ui-walker-nav-menu.php # Personalización de menús
│   ├── customizer.php           # Opciones de personalización
│   └── helpers.php              # Funciones auxiliares
├── page-templates/              # Plantillas de página especializadas
│   └── dashboard.php            # Plantilla para el dashboard principal
├── template-parts/              # Componentes reutilizables
│   └── dashboard/               # Partes para plantillas de dashboard
│       ├── sidebar.php          # Barra lateral 
│       └── topbar.php           # Barra superior
├── functions.php                # Funcionalidad principal del tema
├── style.css                    # Información y metadatos del tema
├── index.php                    # Plantilla principal
├── header.php                   # Cabecera del sitio
├── footer.php                   # Pie de página del sitio
├── CHANGELOG.md                 # Registro de cambios
├── VERSION.md                   # Información detallada de versión
├── MENU-LATERAL.md              # Guía de uso del menú lateral
└── README.md                    # Documentación general
```

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

### Menú Lateral
1. En WordPress, ve a **Apariencia > Menús**
2. Crea un nuevo menú con los elementos deseados
3. En la sección "Ubicaciones del menú", asigna el menú a "Menú Lateral"
4. [Ver guía completa del menú lateral](MENU-LATERAL.md)

### Cambio de Estilos Visuales
- Cuando estés logueado como administrador, aparecerá un selector de estilos en la parte inferior derecha
- Selecciona entre los diferentes estilos disponibles (Solo Soft Neo-Brutalism implementado actualmente)

### Modo Claro/Oscuro
- Utiliza el botón de sol/luna en la barra superior para cambiar entre modo claro y oscuro

## Personalización

El tema incluye opciones para personalizar:
- Estilo visual (Soft Neo-Brutalism, Neo-Brutalism, Futurismo Minimalista, Cyberpunk)
- Modo claro/oscuro
- Estado de la barra lateral (expandida/colapsada)
- Menú lateral con iconos personalizados

## Requisitos

- WordPress 6.4+
- PHP 7.4+
- Navegador moderno con soporte para CSS Variables

## Licencia

Distribuido bajo la licencia GPL v2 o posterior. Consulta el archivo `LICENSE` para más información.

## Contribución y Soporte

Las contribuciones son bienvenidas. Para reportar problemas o solicitar funcionalidades, por favor [abre un issue](https://github.com/StrykerUX/Nova-UI-Solar-Theme/issues).

---

StrykerUX - [GitHub](https://github.com/StrykerUX)
