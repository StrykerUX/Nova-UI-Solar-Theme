<?php
/**
 * Nova UI Solar - Funciones y definiciones del tema
 *
 * @package Nova_UI_Solar
 * @since 0.1.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define constantes del tema
 */
define('NOVA_UI_VERSION', '0.1.0');
define('NOVA_UI_DIR', get_template_directory());
define('NOVA_UI_URI', get_template_directory_uri());
define('NOVA_UI_ASSETS_URI', NOVA_UI_URI . '/assets');

/**
 * Incluir archivos de funciones separados
 */
require_once NOVA_UI_DIR . '/inc/helpers.php';
require_once NOVA_UI_DIR . '/inc/template-functions.php';
require_once NOVA_UI_DIR . '/inc/template-tags.php';
require_once NOVA_UI_DIR . '/inc/customizer.php';
require_once NOVA_UI_DIR . '/inc/class-nova-ui-walker-nav-menu.php';

if (!function_exists('nova_ui_setup')) :
    /**
     * Configuración principal del tema
     */
    function nova_ui_setup() {
        // Agregar soporte para traducción
        load_theme_textdomain('nova-ui-solar', NOVA_UI_DIR . '/languages');

        // Añadir soporte para etiqueta de título generada automáticamente
        add_theme_support('title-tag');

        // Habilitar soporte para imágenes destacadas en posts
        add_theme_support('post-thumbnails');

        // Soporte para logo personalizado
        add_theme_support('custom-logo', array(
            'height'      => 60,
            'width'       => 200,
            'flex-height' => true,
            'flex-width'  => true,
        ));

        // Configurar tamaños de imágenes personalizados
        add_image_size('nova-ui-card', 800, 600, true);
        add_image_size('nova-ui-avatar', 100, 100, true);

        // Registrar ubicaciones de menús
        register_nav_menus(array(
            'primary'      => esc_html__('Menú Principal', 'nova-ui-solar'),
            'sidebar'      => esc_html__('Menú Lateral', 'nova-ui-solar'),
            'topbar-right' => esc_html__('Menú Superior Derecho', 'nova-ui-solar'),
            'footer'       => esc_html__('Menú de Pie de Página', 'nova-ui-solar'),
        ));

        // Soporte HTML5 para elementos de formulario, búsqueda, comentarios, etc.
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ));

        // Añadir soporte para alineación amplia y ancha
        add_theme_support('align-wide');

        // Añadir soporte para personalización selectiva de la vista previa
        add_theme_support('customize-selective-refresh-widgets');

        // Añadir soporte para bloque de estilos
        add_theme_support('wp-block-styles');

        // Añadir soporte para diferentes estilos visuales
        add_theme_support('nova-ui-neo-brutalism');
        add_theme_support('nova-ui-soft-neo-brutalism');
        add_theme_support('nova-ui-futurismo-minimalista');
        add_theme_support('nova-ui-cyberpunk');
    }
endif;
add_action('after_setup_theme', 'nova_ui_setup');

/**
 * Establecer el ancho del contenido en píxeles, basado en el diseño del tema.
 */
function nova_ui_content_width() {
    $GLOBALS['content_width'] = apply_filters('nova_ui_content_width', 1140);
}
add_action('after_setup_theme', 'nova_ui_content_width', 0);

/**
 * Registrar áreas de widgets.
 */
function nova_ui_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Barra lateral', 'nova-ui-solar'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Añade widgets aquí para que aparezcan en la barra lateral.', 'nova-ui-solar'),
        'before_widget' => '<div id="%1$s" class="widget card mb-3 %2$s">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<div class="card-header"><h5 class="card-title mb-0">',
        'after_title'   => '</h5></div><div class="card-body">',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Panel de control', 'nova-ui-solar'),
        'id'            => 'dashboard',
        'description'   => esc_html__('Añade widgets aquí para que aparezcan en el panel de control.', 'nova-ui-solar'),
        'before_widget' => '<div class="col-lg-6 col-xl-4"><div id="%1$s" class="card %2$s">',
        'after_widget'  => '</div></div></div>',
        'before_title'  => '<div class="card-header d-flex justify-content-between align-items-center"><h4 class="header-title">',
        'after_title'   => '</h4><div class="dropdown">
                            <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-refresh me-1"></i>' . esc_html__('Actualizar', 'nova-ui-solar') . '</a>
                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-settings me-1"></i>' . esc_html__('Configurar', 'nova-ui-solar') . '</a>
                            </div>
                        </div></div><div class="card-body">',
    ));
}
add_action('widgets_init', 'nova_ui_widgets_init');

/**
 * Registrar y cargar scripts y estilos del tema
 */
function nova_ui_scripts() {
    // Fuentes
    wp_enqueue_style('nova-ui-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Jost:wght@400;500;600;700&display=swap', array(), null);

    // Bootstrap (opcional - depende de si quieres usar Bootstrap o CSS propio)
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', array(), '5.3.0');
    wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.0', true);
    
    // Iconos
    wp_enqueue_style('tabler-icons', 'https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css', array(), '2.44.0');
    
    // Obtener el estilo visual activo
    $active_style = get_theme_mod('nova_ui_visual_style', 'soft-neo-brutalism');
    
    // Cargar estilos base
    wp_enqueue_style('nova-ui-base', NOVA_UI_ASSETS_URI . '/css/base.css', array(), NOVA_UI_VERSION);
    
    // Cargar estilo visual específico
    wp_enqueue_style('nova-ui-' . $active_style, NOVA_UI_ASSETS_URI . '/css/themes/' . $active_style . '.css', array('nova-ui-base'), NOVA_UI_VERSION);
    // Después de cargar el estilo visual específico
    wp_enqueue_style('nova-ui-soft-neo-brutalism-sidebar', NOVA_UI_ASSETS_URI . '/css/themes/soft-neo-brutalism-sidebar.css', array('nova-ui-' . $active_style), NOVA_UI_VERSION);
    // JavaScript principal
    wp_enqueue_script('nova-ui-main', NOVA_UI_ASSETS_URI . '/js/main.js', array('jquery'), NOVA_UI_VERSION, true);
    
    // Script para cambio de tema claro/oscuro
    wp_enqueue_script('nova-ui-theme-switcher', NOVA_UI_ASSETS_URI . '/js/theme-switcher.js', array('jquery'), NOVA_UI_VERSION, true);
    // Después de cargar el script para cambio de tema claro/oscuro
    wp_enqueue_script('nova-ui-sidebar-enhanced', NOVA_UI_ASSETS_URI . '/js/sidebar-enhanced.js', array('jquery'), NOVA_UI_VERSION, true);
    // Pasar datos al JavaScript
    wp_localize_script('nova-ui-main', 'novaUIData', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('nova-ui-nonce'),
        'homeUrl' => esc_url(home_url('/')),
        'themeUri' => NOVA_UI_URI,
        'assetsUri' => NOVA_UI_ASSETS_URI,
        'isRtl' => is_rtl(),
        'userTheme' => get_theme_mod('nova_ui_theme_mode', 'light'),
        'visualStyle' => $active_style,
        'userLoggedIn' => is_user_logged_in(),
    ));

    // Comentarios
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'nova_ui_scripts');

/**
 * Agregar atributos al HTML para controlar el modo del tema (claro/oscuro)
 */
function nova_ui_add_html_attributes($output) {
    $theme_mode = get_theme_mod('nova_ui_theme_mode', 'light');
    $sidebar_mode = get_theme_mod('nova_ui_sidebar_mode', 'default');
    $visual_style = get_theme_mod('nova_ui_visual_style', 'soft-neo-brutalism');
    
    return str_replace('<html', '<html data-theme="' . esc_attr($theme_mode) . '" data-sidebar="' . esc_attr($sidebar_mode) . '" data-style="' . esc_attr($visual_style) . '"', $output);
}
add_filter('language_attributes', 'nova_ui_add_html_attributes');

/**
 * Función para determinar si se está usando un layout oscuro
 */
function nova_ui_is_dark_mode() {
    return get_theme_mod('nova_ui_theme_mode', 'light') === 'dark';
}

/**
 * Agregado de clase al elemento li del menú para indicar si tiene submenú
 */
function nova_ui_add_menu_parent_class($items) {
    $parents = array();
    
    // Recorrer todos los elementos del menú para encontrar elementos con hijos
    foreach ($items as $item) {
        if ($item->menu_item_parent && $item->menu_item_parent > 0) {
            $parents[] = $item->menu_item_parent;
        }
    }
    
    // Agregar clase 'has-children' a elementos del menú que son padres
    foreach ($items as $item) {
        if (in_array($item->ID, $parents)) {
            $item->classes[] = 'has-children';
        }
    }
    
    return $items;
}
add_filter('wp_nav_menu_objects', 'nova_ui_add_menu_parent_class');

/**
 * Añadir clases a los elementos <li> del menú
 */
function nova_ui_add_menu_li_class($classes, $item, $args, $depth) {
    if ($args->theme_location == 'sidebar') {
        $classes[] = 'side-nav-item';
    }
    
    return $classes;
}
add_filter('nav_menu_css_class', 'nova_ui_add_menu_li_class', 10, 4);

/**
 * Añadir clases a los enlaces <a> del menú
 */
function nova_ui_add_menu_link_class($atts, $item, $args, $depth) {
    if ($args->theme_location == 'sidebar') {
        $atts['class'] = isset($atts['class']) ? $atts['class'] . ' side-nav-link' : 'side-nav-link';
    } elseif ($args->theme_location == 'footer') {
        $atts['class'] = isset($atts['class']) ? $atts['class'] . ' list-inline-item' : 'list-inline-item';
    }
    
    return $atts;
}
add_filter('nav_menu_link_attributes', 'nova_ui_add_menu_link_class', 10, 4);

/**
 * Añadir icono a los elementos del menú lateral
 */
function nova_ui_add_menu_icon($title, $item, $args, $depth) {
    // Solo procesar para el menú lateral y primer nivel
    if ($args->theme_location !== 'sidebar' || $depth > 0) {
        return $title;
    }
    
    // Buscar clases que comiencen con 'ti-' (Tabler Icons)
    $icon_class = '';
    foreach ($item->classes as $class) {
        if (strpos($class, 'ti-') === 0) {
            $icon_class = $class;
            break;
        }
    }
    
    // Si no hay una clase de icono específica, usar un icono genérico
    if (empty($icon_class)) {
        $icon_class = 'ti-circle';
    }
    
    // Estructura del icono y texto del menú
    $menu_icon = '<span class="menu-icon"><i class="ti ' . esc_attr($icon_class) . '"></i></span>';
    $menu_text = '<span class="menu-text">' . $title . '</span>';
    
    // Si el elemento tiene hijos, agregar flecha
    $menu_arrow = '';
    if (in_array('has-children', $item->classes)) {
        $menu_arrow = '<span class="menu-arrow"></span>';
    }
    
    return $menu_icon . $menu_text . $menu_arrow;
}
add_filter('nav_menu_item_title', 'nova_ui_add_menu_icon', 10, 4);

/**
 * Registrar una página de opciones del tema en el panel de administración
 */
function nova_ui_add_admin_menu() {
    add_theme_page(
        esc_html__('Opciones de Nova UI', 'nova-ui-solar'),
        esc_html__('Nova UI', 'nova-ui-solar'),
        'manage_options',
        'nova-ui-options',
        'nova_ui_options_page'
    );
}
add_action('admin_menu', 'nova_ui_add_admin_menu');

/**
 * Renderizar página de opciones del tema
 */
function nova_ui_options_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('nova_ui_options');
            do_settings_sections('nova-ui-options');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

/**
 * Registrar configuraciones
 */
function nova_ui_register_settings() {
    register_setting('nova_ui_options', 'nova_ui_default_style');
    
    add_settings_section(
        'nova_ui_style_section',
        esc_html__('Configuración de estilo visual', 'nova-ui-solar'),
        'nova_ui_style_section_callback',
        'nova-ui-options'
    );
    
    add_settings_field(
        'nova_ui_default_style',
        esc_html__('Estilo visual predeterminado', 'nova-ui-solar'),
        'nova_ui_default_style_callback',
        'nova-ui-options',
        'nova_ui_style_section'
    );
}
add_action('admin_init', 'nova_ui_register_settings');

/**
 * Callback para la sección de estilos
 */
function nova_ui_style_section_callback() {
    echo '<p>' . esc_html__('Selecciona el estilo visual predeterminado para tu panel de administración.', 'nova-ui-solar') . '</p>';
}

/**
 * Callback para el campo de selección de estilo
 */
function nova_ui_default_style_callback() {
    $styles = array(
        'soft-neo-brutalism' => esc_html__('Soft Neo-Brutalism', 'nova-ui-solar'),
        'neo-brutalism' => esc_html__('Neo-Brutalism', 'nova-ui-solar'),
        'futurismo-minimalista' => esc_html__('Futurismo Minimalista', 'nova-ui-solar'),
        'cyberpunk' => esc_html__('Cyberpunk', 'nova-ui-solar')
    );
    
    $current = get_option('nova_ui_default_style', 'soft-neo-brutalism');
    
    echo '<select name="nova_ui_default_style">';
    foreach ($styles as $value => $label) {
        printf(
            '<option value="%s" %s>%s</option>',
            esc_attr($value),
            selected($current, $value, false),
            esc_html($label)
        );
    }
    echo '</select>';
}

/**
 * Registrar plantillas de página
 */
function nova_ui_register_page_templates($templates) {
    $templates['page-templates/dashboard.php'] = esc_html__('Dashboard', 'nova-ui-solar');
    $templates['page-templates/profile.php'] = esc_html__('Perfil', 'nova-ui-solar');
    $templates['page-templates/settings.php'] = esc_html__('Configuración', 'nova-ui-solar');
    $templates['page-templates/full-width.php'] = esc_html__('Ancho Completo', 'nova-ui-solar');
    
    return $templates;
}
add_filter('theme_page_templates', 'nova_ui_register_page_templates');
