# Nova UI Solar Theme

Un tema WordPress modular con múltiples estilos visuales (Neo-Brutalist, Soft Neo-Brutalist, Futurismo Minimalista, Cyberpunk) para aplicaciones SaaS y paneles de administración.

## Estado actual del desarrollo

El tema está en fase inicial con la estructura básica implementada y el estilo Soft Neo-Brutalism funcional. Incluye:

- Archivos base del tema WordPress
- Plantilla de dashboard con elementos interactivos
- Sistema de cambio entre estilos visuales
- Selector de tema claro/oscuro
- Estilo Soft Neo-Brutalism completo

Próximos pasos: implementar los estilos restantes, mejorar la responsividad y añadir más plantillas específicas.

## Estructura del proyecto

```
nova-ui-solar/
├── assets/                      # Recursos estáticos
│   ├── css/                     # Estilos CSS
│   │   ├── base.css             # Estilos base compartidos
│   │   └── themes/              # Estilos específicos por tema visual
│   │       └── soft-neo-brutalism.css    # Estilo Soft Neo-Brutalism
│   ├── js/                      # JavaScript
│   │   ├── main.js              # Funcionalidad principal del tema
│   │   └── theme-switcher.js    # Script para cambiar estilos visuales
│   └── images/                  # Imágenes y recursos gráficos (pendiente)
├── inc/                         # Funciones PHP adicionales
│   ├── template-functions.php   # Funciones de plantilla
│   └── [otros archivos .php]    # Archivos auxiliares (pendientes)
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
└── README.md                    # Documentación
```

## Instalación

1. Descarga este repositorio como archivo ZIP
2. En WordPress, ve a Apariencia > Temas > Añadir nuevo > Subir tema
3. Sube el archivo ZIP descargado
4. Activa el tema

## Uso

### Dashboard
1. Crea una nueva página en WordPress
2. En el panel lateral, selecciona "Dashboard" como plantilla
3. Publica la página y visítala para ver el panel con el estilo Soft Neo-Brutalism

### Cambio de estilos visuales
- Cuando estés logueado como administrador, aparecerá un selector de estilos en la parte inferior derecha
- Selecciona entre los diferentes estilos disponibles (Soft Neo-Brutalism implementado actualmente)

### Modo claro/oscuro
- Utiliza el botón de sol/luna en la barra superior para cambiar entre modo claro y oscuro

## Personalización

El tema incluye opciones para personalizar:
- Estilo visual (Soft Neo-Brutalism, Neo-Brutalism, Futurismo Minimalista, Cyberpunk)
- Modo claro/oscuro
- Estado de la barra lateral (expandida/colapsada)

## Requisitos

- WordPress 5.6+
- PHP 7.4+

## Licencia

GPL v2 o posterior
