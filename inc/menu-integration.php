<?php
/**
 * Integración mejorada con el sistema de menús de WordPress
 * 
 * Este archivo contiene funciones para mejorar la integración
 * del panel lateral con el sistema nativo de menús de WordPress
 *
 * @package Nova_UI_Solar
 */

if (!defined('ABSPATH')) {
    exit; // Salida si se accede directamente
}

/**
 * Clase personalizada de Walker para el menú lateral
 * Extiende la clase Walker_Nav_Menu de WordPress para dar formato específico a los elementos del menú
 */
class Nova_UI_Sidebar_Menu_Walker extends Walker_Nav_Menu {
    /**
     * Inicio del elemento de nivel superior
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        // Clases predeterminadas del elemento
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        
        // Agregar clases personalizadas para este tema
        $classes[] = 'nav-item';
        
        // Detectar si tiene hijos
        $has_children = in_array('menu-item-has-children', $classes);
        
        // Detectar si está activo
        $is_active = in_array('current-menu-item', $classes) || in_array('current-menu-parent', $classes);
        
        // Clases finales del elemento
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        // ID del elemento
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        // Iniciar elemento de lista
        $output .= $indent . '<li' . $id . $class_names .'>';
        
        // Atributos del enlace
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '#';
        
        // Agregar clase para estilo específico
        $atts['class'] = 'nav-link soft-neo-nav-link';
        
        // Si tiene hijos, añadir clase específica
        if ($has_children) {
            $atts['class'] .= ' has-dropdown';
            $atts['aria-expanded'] = 'false';
        }
        
        // Si está activo, añadir clase específica
        if ($is_active) {
            $atts['class'] .= ' active';
        }
        
        // Filtrar atributos
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        
        // Construir atributos
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        // Obtener icono del menú (si existe)
        $icon_class = '';
        
        // Primero buscar en meta personalizado
        $item_icon = get_post_meta($item->ID, '_menu_item_icon', true);
        if (!empty($item_icon)) {
            $icon_class = $item_icon;
        } else {
            // Buscar en las clases
            foreach ($classes as $class) {
                if (strpos($class, 'ti-') === 0) {
                    $icon_class = $class;
                    break;
                }
            }
            
            // Si aún no hay icono, usar uno predeterminado según la etiqueta
            if (empty($icon_class)) {
                // Asociación inteligente de iconos según el título del menú
                $title = strtolower($item->title);
                if (strpos($title, 'dash') !== false) {
                    $icon_class = 'ti-home';
                } elseif (strpos($title, 'analy') !== false) {
                    $icon_class = 'ti-chart-bar';
                } elseif (strpos($title, 'chat') !== false) {
                    $icon_class = 'ti-message-circle';
                } elseif (strpos($title, 'link') !== false || strpos($title, 'enlace') !== false) {
                    $icon_class = 'ti-link';
                } elseif (strpos($title, 'doc') !== false) {
                    $icon_class = 'ti-file-text';
                } elseif (strpos($title, 'calendar') !== false || strpos($title, 'calendario') !== false) {
                    $icon_class = 'ti-calendar';
                } elseif (strpos($title, 'project') !== false || strpos($title, 'proyecto') !== false) {
                    $icon_class = 'ti-briefcase';
                } elseif (strpos($title, 'setting') !== false || strpos($title, 'config') !== false) {
                    $icon_class = 'ti-settings';
                } elseif (strpos($title, 'user') !== false || strpos($title, 'usuario') !== false) {
                    $icon_class = 'ti-user';
                } else {
                    $icon_class = 'ti-circle'; // Icono predeterminado
                }
            }
        }
        
        // Iniciar etiqueta de enlace
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        
        // Añadir icono
        $item_output .= '<span class="menu-icon"><i class="ti ' . esc_attr($icon_class) . '"></i></span>';
        
        // Añadir título
        $item_output .= '<span class="menu-text">';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</span>';
        
        // Añadir indicador de desplegable si tiene hijos
        if ($has_children) {
            $item_output .= '<i class="ti ti-chevron-down dropdown-indicator"></i>';
        }
        
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        // Aplicar filtros y añadir al output
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    /**
     * Iniciar el subnivel (submenú)
     */
    public function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }
    
    /**
     * Finalizar el subnivel
     */
    public function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
}

/**
 * Agregar página de ayuda para los menús del panel lateral
 */
function nova_ui_sidebar_menu_help() {
    // Solo mostrar en la página de menús
    $screen = get_current_screen();
    if (!$screen || $screen->id !== 'nav-menus') {
        return;
    }
    
    // Verificar si hay una ubicación de menú 'sidebar'
    $locations = get_registered_nav_menus();
    if (!isset($locations['sidebar'])) {
        return;
    }
    
    ?>
    <div class="notice notice-info is-dismissible">
        <h3><?php _e('Menú del Panel Lateral - Nova UI Solar', 'nova-ui-solar'); ?></h3>
        <p><?php _e('Para personalizar el menú del panel lateral:', 'nova-ui-solar'); ?></p>
        <ol>
            <li><?php _e('Crea un nuevo menú o edita uno existente', 'nova-ui-solar'); ?></li>
            <li><?php _e('Asígnalo a la ubicación "Menú Lateral"', 'nova-ui-solar'); ?></li>
            <li><?php _e('Para añadir iconos, usa las "Clases CSS" de un elemento del menú (p. ej. "ti-home")', 'nova-ui-solar'); ?></li>
            <li><?php _e('Los iconos se asignarán automáticamente si no se especifica una clase de icono', 'nova-ui-solar'); ?></li>
        </ol>
        <p><?php _e('Clases de iconos recomendadas:', 'nova-ui-solar'); ?> <code>ti-home</code>, <code>ti-chart-bar</code>, <code>ti-message-circle</code>, <code>ti-link</code>, <code>ti-file-text</code>, <code>ti-settings</code></p>
    </div>
    <?php
}
add_action('admin_notices', 'nova_ui_sidebar_menu_help');

/**
 * Agregar campos a la pantalla de opciones de Menús
 */
function nova_ui_add_menu_fields() {
    // Verificar que estamos en la página de menús
    $screen = get_current_screen();
    if (!$screen || $screen->id !== 'nav-menus') {
        return;
    }
    
    // Agregar CSS personalizado para mejorar la apariencia del campo de icono
    ?>
    <style type="text/css">
        .field-icon {
            margin: 5px 0;
            padding: 5px;
            background: #f9f9f9;
            border: 1px solid #e5e5e5;
            border-radius: 3px;
        }
        .field-icon label {
            display: block;
            margin-bottom: 5px;
        }
        .field-icon input {
            width: 100%;
            padding: 5px;
        }
        .field-icon .description {
            font-style: italic;
            color: #666;
            margin-top: 2px;
            display: block;
        }
    </style>
    <?php
}
add_action('admin_head-nav-menus.php', 'nova_ui_add_menu_fields');

/**
 * Añadir campos personalizados a los elementos del menú
 */
function nova_ui_sidebar_menu_fields($id, $item, $depth, $args) {
    $icon = get_post_meta($item->ID, '_menu_item_icon', true);
    ?>
    <p class="field-icon description description-wide">
        <label for="edit-menu-item-icon-<?php echo $item->ID; ?>">
            <?php _e('Icono (clase Tabler Icons)', 'nova-ui-solar'); ?><br>
            <input type="text" id="edit-menu-item-icon-<?php echo $item->ID; ?>" class="widefat" name="menu-item-icon[<?php echo $item->ID; ?>]" value="<?php echo esc_attr($icon); ?>">
            <span class="description"><?php _e('Ejemplo: ti-home, ti-chart-bar, ti-message-circle', 'nova-ui-solar'); ?></span>
        </label>
    </p>
    <?php
}
add_action('wp_nav_menu_item_custom_fields', 'nova_ui_sidebar_menu_fields', 10, 4);

/**
 * Guardar campos personalizados de elementos del menú
 */
function nova_ui_sidebar_menu_save($menu_id, $menu_item_db_id) {
    if (isset($_POST['menu-item-icon']) && isset($_POST['menu-item-icon'][$menu_item_db_id])) {
        $sanitized_data = sanitize_text_field($_POST['menu-item-icon'][$menu_item_db_id]);
        update_post_meta($menu_item_db_id, '_menu_item_icon', $sanitized_data);
    }
}
add_action('wp_update_nav_menu_item', 'nova_ui_sidebar_menu_save', 10, 2);

/**
 * Aplicar icono personalizado a las clases del elemento del menú
 */
function nova_ui_sidebar_menu_item_classes($classes, $item) {
    $icon = get_post_meta($item->ID, '_menu_item_icon', true);
    if (!empty($icon)) {
        $classes[] = esc_attr($icon);
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'nova_ui_sidebar_menu_item_classes', 10, 2);

/**
 * Asegurar que se muestren los campos personalizados en el panel de menús
 */
function nova_ui_enable_menu_item_custom_fields() {
    add_filter('wp_edit_nav_menu_walker', function() {
        return 'Walker_Nav_Menu_Edit';
    });
}
add_action('admin_init', 'nova_ui_enable_menu_item_custom_fields');

/**
 * Agregar información del menú al panel de administración
 */
function nova_ui_menu_admin_style() {
    echo '<style>
        .menu-item-icon-field {
            padding: 10px;
            background: #f8f8f8;
            border: 1px solid #ddd;
            margin: 10px 0;
            border-radius: 3px;
        }
        .menu-item-icon-field label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .menu-item-icon-field .description {
            display: block;
            margin-top: 3px;
            color: #666;
            font-style: italic;
        }
    </style>';
}
add_action('admin_head', 'nova_ui_menu_admin_style');
