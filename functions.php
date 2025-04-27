<?php
/**
 * Nova UI Solar functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Nova_UI_Solar
 */

if (!defined('_S_VERSION')) {
    // Reemplazar el número de versión de cada lanzamiento.
    define('_S_VERSION', '1.0.2');
}

/**
 * Configurar las características del tema predeterminadas de Nova UI Solar.
 */
function nova_ui_solar_setup() {
    /*
     * Permitir que WordPress maneje el título del documento.
     */
    add_theme_support('title-tag');

    /*
     * Habilitar soporte para Post Thumbnails en entradas y páginas.
     */
    add_theme_support('post-thumbnails');

    /*
     * Registrar menús de navegación
     */
    register_nav_menus(
        array(
            'primary' => esc_html__('Primario', 'nova-ui-solar'),
            'sidebar' => esc_html__('Menú Lateral', 'nova-ui-solar'),
            'footer' => esc_html__('Pie de Página', 'nova-ui-solar'),
        )
    );

    /*
     * Cambiar el tamaño del contenido central para que coincida con los estándares de pantalla modernos.
     */
    global $content_width;
    if (!isset($content_width)) {
        $content_width = 1200;
    }

    /*
     * Habilitar soporte para logo personalizado.
     */
    add_theme_support(
        'custom-logo',
        array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        )
    );

    /*
     * Añadir soporte para formatos de entrada.
     */
    add_theme_support(
        'post-formats',
        array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
        )
    );

    // Añadir soporte para bloques completas
    add_theme_support('align-wide');

    // Soporte para colores personalizados en el editor
    add_theme_support('editor-color-palette', array(
        array(
            'name' => __('Primario', 'nova-ui-solar'),
            'slug' => 'primary',
            'color' => '#4a6cf7',
        ),
        array(
            'name' => __('Secundario', 'nova-ui-solar'),
            'slug' => 'secondary',
            'color' => '#8956f5',
        ),
        array(
            'name' => __('Éxito', 'nova-ui-solar'),
            'slug' => 'success',
            'color' => '#10b981',
        ),
        array(
            'name' => __('Peligro', 'nova-ui-solar'),
            'slug' => 'danger',
            'color' => '#ef4444',
        ),
    ));
}
add_action('after_setup_theme', 'nova_ui_solar_setup');

/**
 * Cargar scripts y estilos.
 */
function nova_ui_solar_scripts() {
    // Registrar Bootstrap
    wp_register_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.3.0');
    wp_register_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), '5.3.0', true);

    // Registrar Tabler Icons
    wp_register_style('tabler-icons', get_template_directory_uri() . '/assets/css/tabler-icons.min.css', array(), '2.30.0');

    // Registrar ApexCharts para gráficos
    wp_register_script('apexcharts', get_template_directory_uri() . '/assets/js/apexcharts.min.js', array(), '3.40.0', true);

    // Cargar estilos base
    wp_enqueue_style('nova-ui-solar-base', get_template_directory_uri() . '/assets/css/base.css', array('bootstrap', 'tabler-icons'), _S_VERSION);
    
    // Cargar correcciones del sidebar
    wp_enqueue_style('nova-ui-sidebar-fix', get_template_directory_uri() . '/assets/css/sidebar-fix.css', array('nova-ui-solar-base'), _S_VERSION);
    
    // Cargar estilo visual activo
    $active_style = get_theme_mod('nova_ui_visual_style', 'soft-neo-brutalism');
    wp_enqueue_style('nova-ui-solar-style', get_template_directory_uri() . '/assets/css/themes/' . $active_style . '.css', array('nova-ui-solar-base'), _S_VERSION);

    // Cargar scripts
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('nova-ui-solar-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'bootstrap'), _S_VERSION, true);

    // Cargar ApexCharts solo en páginas que lo necesiten
    if (is_page_template('page-templates/dashboard.php')) {
        wp_enqueue_script('apexcharts');
    }

    // Pasar datos al script principal
    wp_localize_script('nova-ui-solar-main', 'novaUIData', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('nova_ui_nonce'),
        'userTheme' => get_theme_mod('nova_ui_theme_mode', 'light'),
        'visualStyle' => $active_style,
    ));
}
add_action('wp_enqueue_scripts', 'nova_ui_solar_scripts');

/**
 * Clases personalizadas para el menú lateral usando Walker
 */
class Nova_UI_Sidebar_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'nav-item';

        if (in_array('current-menu-item', $classes)) {
            $classes[] = 'active';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));

        $output .= $indent . '<li class="' . esc_attr($class_names) . '">';

        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';

        // Agregar clases para enlaces de navegación
        $has_children = in_array('menu-item-has-children', $classes);
        $atts['class'] = 'nav-link soft-neo-nav-link' . ($has_children ? ' has-dropdown' : '') . (in_array('current-menu-item', $classes) ? ' active' : '');

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        // Determinar qué icono usar basado en el título del elemento
        $icon_class = 'ti-layout-dashboard'; // Icono predeterminado
        $title = strtolower($item->title);

        // Mapeo de palabras clave a iconos
        $icon_mapping = array(
            'dashboard' => 'ti-home',
            'inicio' => 'ti-home',
            'perfil' => 'ti-user',
            'usuario' => 'ti-user',
            'análisis' => 'ti-chart-bar',
            'analytics' => 'ti-chart-bar',
            'chat' => 'ti-message-circle',
            'mensajes' => 'ti-message-circle',
            'enlaces' => 'ti-link',
            'links' => 'ti-link',
            'documentos' => 'ti-file-text',
            'archivos' => 'ti-file-text',
            'calendario' => 'ti-calendar',
            'agenda' => 'ti-calendar',
            'proyectos' => 'ti-briefcase',
            'tareas' => 'ti-list',
            'configuración' => 'ti-settings',
            'ajustes' => 'ti-settings',
            'settings' => 'ti-settings',
        );

        // Buscar coincidencias de palabras clave
        foreach ($icon_mapping as $keyword => $icon) {
            if (strpos($title, $keyword) !== false) {
                $icon_class = $icon;
                break;
            }
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= '<span class="menu-icon"><i class="' . $icon_class . '"></i></span>';
        $item_output .= '<span class="menu-text">' . $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after . '</span>';

        // Agregar indicador para elementos con submenú
        if ($has_children) {
            $item_output .= '<i class="ti ti-chevron-down dropdown-indicator"></i>';
        }

        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Función para manejar la actualización del modo del tema vía AJAX
 */
function nova_update_theme_mode() {
    // Verificar nonce por seguridad
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'nova_ui_nonce')) {
        wp_send_json_error('Nonce no válido');
    }

    // Obtener el modo del tema
    $mode = isset($_POST['mode']) ? sanitize_text_field($_POST['mode']) : 'light';

    // Actualizar la opción del tema
    set_theme_mod('nova_ui_theme_mode', $mode);

    wp_send_json_success(array('mode' => $mode));
}
add_action('wp_ajax_nova_update_theme_mode', 'nova_update_theme_mode');
add_action('wp_ajax_nopriv_nova_update_theme_mode', 'nova_update_theme_mode');

/**
 * Función para manejar la actualización del estilo visual vía AJAX
 */
function nova_update_visual_style() {
    // Verificar nonce por seguridad
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'nova_ui_nonce')) {
        wp_send_json_error('Nonce no válido');
    }

    // Obtener el estilo visual
    $style = isset($_POST['style']) ? sanitize_text_field($_POST['style']) : 'soft-neo-brutalism';

    // Actualizar la opción del tema
    set_theme_mod('nova_ui_visual_style', $style);

    wp_send_json_success(array('style' => $style));
}
add_action('wp_ajax_nova_update_visual_style', 'nova_update_visual_style');
add_action('wp_ajax_nopriv_nova_update_visual_style', 'nova_update_visual_style');

/**
 * Registrar widget areas.
 */
function nova_ui_solar_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__('Barra lateral', 'nova-ui-solar'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Añadir widgets aquí.', 'nova-ui-solar'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'nova_ui_solar_widgets_init');

/**
 * Incluir archivos de plantillas de páginas personalizadas
 */
require get_template_directory() . '/inc/template-functions.php';
