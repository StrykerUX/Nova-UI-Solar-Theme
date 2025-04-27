# Guía del Menú Lateral - Nova UI Solar Theme

Esta guía explica cómo configurar y personalizar el menú lateral (sidebar) del tema Nova UI Solar, que ha sido mejorado en la versión 0.1.1 para una mejor integración con el sistema nativo de menús de WordPress.

## Características del Menú Lateral

- **Integración nativa con WordPress**: Utiliza el sistema de menús de WordPress
- **Soporte para iconos**: Muestra iconos Tabler junto a los elementos del menú
- **Menú colapsable**: Se puede expandir/colapsar para adaptarse a diferentes tamaños de pantalla
- **Submenús soportados**: Permite hasta 2 niveles de profundidad (elementos principales y desplegables)
- **Menú por defecto**: Si no se asigna un menú específico, muestra una estructura predeterminada

## Configuración del Menú Lateral

### Opción 1: Usar el Menú Predeterminado

Si no realizas ninguna configuración, el tema mostrará un menú predeterminado con los siguientes elementos:

- Dashboard
- Análisis
- Chat IA
- Enlaces Rápidos
- Documentos
- Calendario
- Proyectos
- Configuración (con submenú)

### Opción 2: Crear un Menú Personalizado

Para personalizar el menú lateral:

1. Ir a **WordPress Admin > Apariencia > Menús**
2. Crear un nuevo menú o editar uno existente
3. Añadir las páginas, enlaces personalizados o categorías deseadas
4. En la sección "Ubicación del menú", marcar la casilla "Menú Lateral"
5. Guardar el menú

## Añadir Iconos a los Elementos del Menú

Para que cada elemento del menú muestre un icono Tabler, sigue estos pasos:

1. Editar el menú en WordPress Admin > Apariencia > Menús
2. Expandir el elemento de menú que deseas editar
3. En el campo "Clases CSS (opcional)", añadir una clase con formato:
   `ti-[nombre-del-icono]`

Por ejemplo:
- `ti-home` para icono de casa
- `ti-chart-bar` para icono de gráfico
- `ti-message-circle` para icono de chat

### Lista de Iconos Disponibles

El tema incluye soporte para [iconos Tabler](https://github.com/tabler/tabler-icons/tree/main/icons/outline). Puedes ver la lista completa de iconos disponibles en:
- [Iconos Outline](https://github.com/tabler/tabler-icons/tree/main/icons/outline)
- [Iconos Filled](https://github.com/tabler/tabler-icons/tree/main/icons/filled)

## Crear Menús Desplegables

Para crear un menú con submenús (desplegables):

1. Crear un elemento de menú principal
2. Crear los elementos secundarios que deseas incluir en el desplegable
3. En la sección de estructura del menú, arrastrar los elementos secundarios ligeramente a la derecha debajo del elemento principal
4. WordPress mostrará estos elementos con sangría, indicando que son elementos secundarios

## Personalización Avanzada

### Modificar la Plantilla del Menú

Si necesitas personalizar el HTML del menú lateral:

1. Ubicar el archivo `template-parts/dashboard/sidebar.php`
2. Crear una copia en tu tema hijo (recomendado) o editar directamente
3. Modificar según tus necesidades

### Personalizar el Walker de Menú

Para cambiar la estructura HTML generada:

1. Ubicar el archivo `inc/class-nova-ui-walker-nav-menu.php`
2. Crear una clase extendida en tu tema hijo o plugin personalizado
3. Registrar tu walker personalizado en `functions.php`

## Solución de Problemas

### El Menú no Muestra los Iconos

- Verifica que hayas añadido correctamente la clase CSS `ti-[nombre-del-icono]`
- Asegúrate de que el nombre del icono existe en la librería Tabler

### El Menú no Aparece en el Sidebar

- Verifica que el menú está asignado a la ubicación "Menú Lateral"
- Comprueba que el menú contenga elementos
- Asegúrate de que no hay errores PHP en la consola

### Los Submenús no Funcionan Correctamente

- Verifica que la estructura del menú en WordPress tenga la jerarquía correcta
- Comprueba que no excedes los 2 niveles de profundidad soportados

---

Para más información o soporte, consulta la [documentación completa](https://github.com/StrykerUX/Nova-UI-Solar-Theme) o reporta problemas en el repositorio de GitHub.
