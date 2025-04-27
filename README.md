# Nova UI Solar Theme

Un tema WordPress modular con React integrado para aplicaciones SaaS, que permite seleccionar entre diferentes estilos visuales para paneles de administración.

![Nova UI Solar Theme](https://via.placeholder.com/1200x600?text=Nova+UI+Solar+Theme)

## Descripción

Nova UI Solar Theme es un tema WordPress innovador que integra React para crear interfaces de usuario modernas y altamente personalizables. A diferencia de las soluciones headless, este tema mantiene la estructura tradicional de WordPress mientras aprovecha el poder de React para componentes específicos.

El tema incluye múltiples estilos visuales prediseñados que pueden ser seleccionados por el usuario:

- **Neo-Brutalist**: Diseño audaz con bordes marcados y contrastes fuertes
- **Soft Neo-Brutalist**: Una versión más suave del Neo-Brutalismo con sombras sutiles
- **Futurismo Minimalista**: Interfaz elegante y minimalista con toques tecnológicos
- **Cyberpunk**: Estética futurista con colores neón y efectos visuales llamativos

## Características principales

- **Sistema modular**: Arquitectura de componentes que facilita la extensibilidad
- **React integrado**: Componentes React para interfaces dinámicas sin perder compatibilidad con WordPress
- **Múltiples estilos visuales**: Cambia entre diferentes diseños con un solo clic
- **Sistema de variables CSS**: Personalización avanzada mediante variables globales
- **Biblioteca de componentes UI**: Botones, tarjetas, formularios y más con diseño consistente
- **Modo claro/oscuro**: Soporte nativo para cambiar entre temas
- **Diseño responsivo**: Optimizado para móviles, tablets y escritorio
- **Compatible con plugins**: Funciona con WooCommerce y otros plugins populares
- **Personalización sencilla**: Panel de administración intuitivo para configurar el tema

## Tecnologías utilizadas

- WordPress (PHP)
- React
- Webpack
- Babel
- SASS/CSS
- Lucide Icons
- Bootstrap (opcional)

## Estructura del proyecto

```
nova-ui-solar/
├── assets/                      # Recursos estáticos compilados
│   ├── css/                     # Estilos compilados
│   ├── js/                      # JavaScript compilado
│   └── images/                  # Imágenes 
├── build/                       # Configuración de compilación
│   ├── webpack.config.js        # Configuración de webpack
│   └── babel.config.js          # Configuración de babel
├── inc/                         # Funciones y clases PHP
│   ├── customizer/              # Personalizador de WordPress
│   ├── template-functions.php   # Funciones de plantilla
│   └── theme-options.php        # Opciones del tema
├── react-src/                   # Código fuente de React
│   ├── components/              # Componentes reutilizables
│   ├── context/                 # Context API de React
│   ├── styles/                  # SASS y CSS
│   └── dashboards/              # Implementaciones de los diferentes estilos
├── template-parts/              # Partes reutilizables de la plantilla
│   ├── content/                 # Plantillas de contenido
│   └── dashboard/               # Componentes del dashboard
├── page-templates/              # Plantillas de página
├── functions.php                # Funcionalidad principal
├── index.php                    # Plantilla principal
├── style.css                    # Información del tema
└── README.md                    # Documentación
```

## Requisitos

- WordPress 6.0+
- PHP 8.0+
- MySQL 5.7+ o MariaDB 10.2+
- Node.js 16+ (para desarrollo)

## Instalación

### Para uso:

1. Descarga la última versión del tema
2. Sube el archivo zip a través del panel de administración de WordPress (Apariencia > Temas > Añadir nuevo > Subir tema)
3. Activa el tema
4. Configura las opciones del tema a través del personalizador de WordPress

### Para desarrollo:

1. Clona este repositorio en tu carpeta `/wp-content/themes/`
2. Navega a la carpeta del tema
3. Ejecuta `npm install` para instalar las dependencias
4. Ejecuta `npm run dev` para iniciar el entorno de desarrollo
5. Ejecuta `npm run build` para compilar los archivos para producción

## Personalización

Nova UI Solar Theme ofrece múltiples niveles de personalización:

1. **Selección de estilo visual**: Elige entre los estilos prediseñados
2. **Personalización por tema**: Cada estilo tiene sus propias variables para personalizar colores, espaciados, tipografía, etc.
3. **Personalización avanzada**: Desarrolladores pueden extender los componentes existentes o crear nuevos

## Documentación

La documentación completa estará disponible próximamente en la [wiki del proyecto](https://github.com/StrykerUX/Nova-UI-Solar-Theme/wiki).

## Estado del desarrollo

Este proyecto se encuentra actualmente en desarrollo activo. Consulta la sección de [issues](https://github.com/StrykerUX/Nova-UI-Solar-Theme/issues) para ver en qué estamos trabajando.

## Licencia

Este tema está licenciado bajo [GPL v2 o posterior](https://www.gnu.org/licenses/gpl-2.0.html).

## Créditos

Desarrollado por StrykerUX
