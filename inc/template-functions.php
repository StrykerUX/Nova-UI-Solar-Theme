<?php
/**
 * Funciones que mejoran el tema al engancharse en WordPress
 *
 * @package Nova_UI_Solar
 */

/**
 * Callback AJAX para actualizar el modo del tema (claro/oscuro)
 */
function nova_ui_update_theme_mode() {
    // Verificar nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'nova-ui-nonce')) {
        wp_send_json_error('Nonce inválido');
    }
    
    // Verificar datos
    if (!isset($_POST['mode']) || !in_array($_POST['mode'], ['light', 'dark'])) {
        wp_send_json_error('Modo inválido');
    }
    
    // Actualizar opción
    $mode = sanitize_text_field($_POST['mode']);
    set_theme_mod('nova_ui_theme_mode', $mode);
    
    wp_send_json_success();
}
add_action('wp_ajax_nova_update_theme_mode', 'nova_ui_update_theme_mode');
add_action('wp_ajax_nopriv_nova_update_theme_mode', 'nova_ui_update_theme_mode');

/**
 * Callback AJAX para actualizar el estilo visual
 */
function nova_ui_update_visual_style() {
    // Verificar nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'nova-ui-nonce')) {
        wp_send_json_error('Nonce inválido');
    }
    
    // Verificar datos
    $allowed_styles = ['soft-neo-brutalism', 'neo-brutalism', 'futurismo-minimalista', 'cyberpunk'];
    if (!isset($_POST['style']) || !in_array($_POST['style'], $allowed_styles)) {
        wp_send_json_error('Estilo visual inválido');
    }
    
    // Actualizar opción
    $style = sanitize_text_field($_POST['style']);
    set_theme_mod('nova_ui_visual_style', $style);
    
    wp_send_json_success();
}
add_action('wp_ajax_nova_update_visual_style', 'nova_ui_update_visual_style');
add_action('wp_ajax_nopriv_nova_update_visual_style', 'nova_ui_update_visual_style');

/**
 * Callback AJAX para actualizar el modo de la barra lateral (expandido/colapsado)
 */
function nova_ui_update_sidebar_mode() {
    // Verificar nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'nova-ui-nonce')) {
        wp_send_json_error('Nonce inválido');
    }
    
    // Verificar datos
    if (!isset($_POST['mode']) || !in_array($_POST['mode'], ['default', 'collapsed'])) {
        wp_send_json_error('Modo inválido');
    }
    
    // Actualizar opción
    $mode = sanitize_text_field($_POST['mode']);
    set_theme_mod('nova_ui_sidebar_mode', $mode);
    
    wp_send_json_success();
}
add_action('wp_ajax_nova_update_sidebar_mode', 'nova_ui_update_sidebar_mode');
add_action('wp_ajax_nopriv_nova_update_sidebar_mode', 'nova_ui_update_sidebar_mode');

/**
 * Verificar si estamos en una página con plantilla de dashboard
 */
function nova_ui_is_dashboard_template() {
    return is_page_template([
        'page-templates/dashboard.php',
        'page-templates/profile.php',
        'page-templates/settings.php'
    ]);
}

/**
 * Agregar clases al body según el estilo visual y tema
 */
function nova_ui_body_classes($classes) {
    // Añadir clase para el estilo visual activo
    $visual_style = get_theme_mod('nova_ui_visual_style', 'soft-neo-brutalism');
    $classes[] = $visual_style;
    
    // Añadir clase para indicar tema claro/oscuro
    $theme_mode = get_theme_mod('nova_ui_theme_mode', 'light');
    $classes[] = 'theme-' . $theme_mode;
    
    // Si es una página con plantilla de dashboard
    if (nova_ui_is_dashboard_template()) {
        $classes[] = 'dashboard-page';
        
        // Si la barra lateral está colapsada
        if (get_theme_mod('nova_ui_sidebar_mode', 'default') === 'collapsed') {
            $classes[] = 'sidebar-collapsed';
        }
    }
    
    return $classes;
}
add_filter('body_class', 'nova_ui_body_classes');

/**
 * Ajustar clases para elementos del menú
 */
function nova_ui_menu_item_classes($classes, $item, $args) {
    // Si es un submenú, añadir clase
    if (in_array('menu-item-has-children', $classes)) {
        $classes[] = 'has-dropdown';
    }
    
    return $classes;
}
add_filter('nav_menu_css_class', 'nova_ui_menu_item_classes', 10, 3);

/**
 * Función para verificar si un estilo visual está disponible
 */
function nova_ui_is_style_available($style) {
    $available_styles = [
        'soft-neo-brutalism',
        'neo-brutalism',
        'futurismo-minimalista',
        'cyberpunk'
    ];
    
    return in_array($style, $available_styles);
}

/**
 * Función para obtener información sobre un estilo visual
 */
function nova_ui_get_style_info($style) {
    $styles = [
        'soft-neo-brutalism' => [
            'name' => __('Soft Neo-Brutalism', 'nova-ui-solar'),
            'description' => __('Estilo suave con bordes redondeados y sombras suaves', 'nova-ui-solar'),
            'thumbnail' => get_template_directory_uri() . '/assets/images/themes/soft-neo-brutalism-thumb.jpg'
        ],
        'neo-brutalism' => [
            'name' => __('Neo-Brutalism', 'nova-ui-solar'),
            'description' => __('Estilo audaz con bordes marcados y contrastes fuertes', 'nova-ui-solar'),
            'thumbnail' => get_template_directory_uri() . '/assets/images/themes/neo-brutalism-thumb.jpg'
        ],
        'futurismo-minimalista' => [
            'name' => __('Futurismo Minimalista', 'nova-ui-solar'),
            'description' => __('Interfaz elegante y minimalista con toques tecnológicos', 'nova-ui-solar'),
            'thumbnail' => get_template_directory_uri() . '/assets/images/themes/futurismo-minimalista-thumb.jpg'
        ],
        'cyberpunk' => [
            'name' => __('Cyberpunk', 'nova-ui-solar'),
            'description' => __('Estética futurista con colores neón y efectos visuales llamativos', 'nova-ui-solar'),
            'thumbnail' => get_template_directory_uri() . '/assets/images/themes/cyberpunk-thumb.jpg'
        ]
    ];
    
    return isset($styles[$style]) ? $styles[$style] : false;
}

/**
 * Crear menú lateral predeterminado si no existe
 */
function nova_ui_create_default_menus() {
    $menu_name = 'Menú Lateral';
    $menu_exists = wp_get_nav_menu_object($menu_name);
    
    // Si el menú no existe, crearlo
    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);
        
        // Añadir elementos al menú
        $dashboard_item = wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Dashboard', 'nova-ui-solar'),
            'menu-item-url' => home_url('/dashboard/'),
            'menu-item-status' => 'publish',
            'menu-item-type' => 'custom',
            'menu-item-attr-title' => __('Dashboard', 'nova-ui-solar'),
            'menu-item-classes' => 'ti-home'
        ));
        
        $analytics_item = wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Análisis', 'nova-ui-solar'),
            'menu-item-url' => home_url('/analisis/'),
            'menu-item-status' => 'publish',
            'menu-item-type' => 'custom',
            'menu-item-attr-title' => __('Análisis', 'nova-ui-solar'),
            'menu-item-classes' => 'ti-chart-bar'
        ));
        
        $chat_item = wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Chat IA', 'nova-ui-solar'),
            'menu-item-url' => home_url('/chat-ia/'),
            'menu-item-status' => 'publish',
            'menu-item-type' => 'custom',
            'menu-item-attr-title' => __('Chat IA', 'nova-ui-solar'),
            'menu-item-classes' => 'ti-message-circle'
        ));
        
        $links_item = wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Enlaces Rápidos', 'nova-ui-solar'),
            'menu-item-url' => home_url('/enlaces-rapidos/'),
            'menu-item-status' => 'publish',
            'menu-item-type' => 'custom',
            'menu-item-attr-title' => __('Enlaces Rápidos', 'nova-ui-solar'),
            'menu-item-classes' => 'ti-link'
        ));
        
        $settings_item = wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Configuración', 'nova-ui-solar'),
            'menu-item-url' => home_url('/configuracion/'),
            'menu-item-status' => 'publish',
            'menu-item-type' => 'custom',
            'menu-item-attr-title' => __('Configuración', 'nova-ui-solar'),
            'menu-item-classes' => 'ti-settings'
        ));
        
        // Asignar el menú a la ubicación correspondiente
        $locations = get_theme_mod('nav_menu_locations');
        $locations['sidebar'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
}
add_action('after_setup_theme', 'nova_ui_create_default_menus');

/**
 * Crear páginas predeterminadas para el dashboard
 */
function nova_ui_create_default_pages() {
    // Comprobar si la página Dashboard ya existe
    $dashboard_page = get_page_by_path('dashboard');
    
    if (!$dashboard_page) {
        // Crear página Dashboard
        $dashboard_page_id = wp_insert_post(array(
            'post_title' => __('Dashboard', 'nova-ui-solar'),
            'post_content' => '',
            'post_status' => 'publish',
            'post_type' => 'page',
            'meta_input' => array(
                '_wp_page_template' => 'page-templates/dashboard.php'
            )
        ));
    }
    
    // Comprobar si la página Perfil ya existe
    $profile_page = get_page_by_path('perfil');
    
    if (!$profile_page) {
        // Crear página Perfil
        $profile_page_id = wp_insert_post(array(
            'post_title' => __('Perfil', 'nova-ui-solar'),
            'post_content' => '',
            'post_status' => 'publish',
            'post_type' => 'page',
            'meta_input' => array(
                '_wp_page_template' => 'page-templates/profile.php'
            )
        ));
    }
    
    // Comprobar si la página Configuración ya existe
    $settings_page = get_page_by_path('configuracion');
    
    if (!$settings_page) {
        // Crear página Configuración
        $settings_page_id = wp_insert_post(array(
            'post_title' => __('Configuración', 'nova-ui-solar'),
            'post_content' => '',
            'post_status' => 'publish',
            'post_type' => 'page',
            'meta_input' => array(
                '_wp_page_template' => 'page-templates/settings.php'
            )
        ));
    }
}
add_action('after_switch_theme', 'nova_ui_create_default_pages');
