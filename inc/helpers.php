<?php
/**
 * Funciones auxiliares para el tema Nova UI Solar
 *
 * @package Nova_UI_Solar
 * @since 0.1.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Obtiene el estilo visual activo
 *
 * @return string Nombre del estilo visual actual
 */
function nova_ui_get_active_style() {
    return get_theme_mod('nova_ui_visual_style', 'soft-neo-brutalism');
}

/**
 * Verifica si un estilo visual está activo
 *
 * @param string $style Nombre del estilo a verificar
 * @return bool True si el estilo está activo
 */
function nova_ui_is_style_active($style) {
    return nova_ui_get_active_style() === $style;
}

/**
 * Obtiene la URL del directorio de assets para el estilo activo
 *
 * @return string URL del directorio de assets
 */
function nova_ui_get_style_assets_url() {
    return NOVA_UI_ASSETS_URI . '/css/themes/' . nova_ui_get_active_style();
}

/**
 * Genera clases CSS basadas en el estilo visual activo
 *
 * @param string $base_class Clase CSS base
 * @return string Clases CSS con modificadores de estilo
 */
function nova_ui_style_classes($base_class) {
    $style = nova_ui_get_active_style();
    return $base_class . ' ' . $base_class . '--' . $style;
}

/**
 * Determina si se debe mostrar el sidebar en la página actual
 *
 * @return bool True si se debe mostrar el sidebar
 */
function nova_ui_show_sidebar() {
    // No mostrar en plantillas de ancho completo o dashboard
    if (is_page_template('page-templates/full-width.php') || 
        is_page_template('page-templates/dashboard.php')) {
        return false;
    }
    
    // No mostrar en páginas de inicio o error 404
    if (is_front_page() || is_404()) {
        return false;
    }
    
    return true;
}

/**
 * Determina si se debe mostrar el sidebar lateral de navegación
 *
 * @return bool True si se debe mostrar el sidebar lateral
 */
function nova_ui_show_side_nav() {
    // Mostrar en dashboard y otras plantillas específicas
    if (is_page_template('page-templates/dashboard.php') || 
        is_page_template('page-templates/profile.php') || 
        is_page_template('page-templates/settings.php')) {
        return true;
    }
    
    return false;
}

/**
 * Genera un título de página apropiado
 *
 * @return string Título de la página
 */
function nova_ui_get_page_title() {
    if (is_home()) {
        return esc_html__('Blog', 'nova-ui-solar');
    } elseif (is_archive()) {
        return get_the_archive_title();
    } elseif (is_search()) {
        return sprintf(
            esc_html__('Resultados de búsqueda para: %s', 'nova-ui-solar'),
            '<span>' . get_search_query() . '</span>'
        );
    } elseif (is_404()) {
        return esc_html__('Página no encontrada', 'nova-ui-solar');
    } else {
        return get_the_title();
    }
}

/**
 * Obtiene la URL del avatar del usuario actual o un avatar predeterminado
 *
 * @param int $size Tamaño del avatar en píxeles
 * @return string URL del avatar
 */
function nova_ui_get_user_avatar_url($size = 40) {
    $user_id = get_current_user_id();
    if ($user_id) {
        return get_avatar_url($user_id, ['size' => $size]);
    }
    
    // Avatar por defecto
    return NOVA_UI_ASSETS_URI . '/images/default-avatar.png';
}

/**
 * Obtiene el nombre del usuario actual o un texto predeterminado
 *
 * @return string Nombre del usuario
 */
function nova_ui_get_user_display_name() {
    $user_id = get_current_user_id();
    if ($user_id) {
        $user = get_userdata($user_id);
        return $user->display_name;
    }
    
    return esc_html__('Invitado', 'nova-ui-solar');
}

/**
 * Obtiene la URL del perfil del usuario actual
 *
 * @return string URL del perfil
 */
function nova_ui_get_user_profile_url() {
    if (is_user_logged_in()) {
        return admin_url('profile.php');
    }
    
    return wp_login_url();
}

/**
 * Genera un formulario de búsqueda personalizado
 *
 * @return string HTML del formulario de búsqueda
 */
function nova_ui_get_search_form() {
    $form = '<form role="search" method="get" class="search-form" action="' . esc_url(home_url('/')) . '">
        <div class="input-group">
            <input type="search" class="form-control search-field" placeholder="' . esc_attr__('Buscar...', 'nova-ui-solar') . '" value="' . get_search_query() . '" name="s" />
            <button type="submit" class="btn btn-primary">
                <i class="ti ti-search"></i>
                <span class="visually-hidden">' . esc_html__('Buscar', 'nova-ui-solar') . '</span>
            </button>
        </div>
    </form>';
    
    return $form;
}

/**
 * Genera un mensaje de notificación
 *
 * @param string $message Mensaje a mostrar
 * @param string $type Tipo de notificación (success, warning, danger, info)
 * @return string HTML de la notificación
 */
function nova_ui_notification($message, $type = 'info') {
    $icon = 'ti-info-circle';
    
    switch ($type) {
        case 'success':
            $icon = 'ti-check';
            break;
        case 'warning':
            $icon = 'ti-alert-triangle';
            break;
        case 'danger':
            $icon = 'ti-x';
            break;
    }
    
    return '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">
        <i class="ti ' . $icon . ' me-2"></i>
        ' . $message . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="' . esc_attr__('Cerrar', 'nova-ui-solar') . '"></button>
    </div>';
}

/**
 * Formatea fechas en formato relativo amigable
 *
 * @param string $timestamp Marca de tiempo a formatear
 * @return string Fecha formateada
 */
function nova_ui_format_date($timestamp) {
    // Obtener la diferencia de tiempo
    $diff = time() - $timestamp;
    
    if ($diff < 60) {
        return esc_html__('hace menos de un minuto', 'nova-ui-solar');
    }
    
    $diff = round($diff / 60);
    if ($diff < 60) {
        return sprintf(
            esc_html(_n('hace %s minuto', 'hace %s minutos', $diff, 'nova-ui-solar')),
            number_format_i18n($diff)
        );
    }
    
    $diff = round($diff / 60);
    if ($diff < 24) {
        return sprintf(
            esc_html(_n('hace %s hora', 'hace %s horas', $diff, 'nova-ui-solar')),
            number_format_i18n($diff)
        );
    }
    
    $diff = round($diff / 24);
    if ($diff < 7) {
        return sprintf(
            esc_html(_n('hace %s día', 'hace %s días', $diff, 'nova-ui-solar')),
            number_format_i18n($diff)
        );
    }
    
    if ($diff < 30) {
        $diff = round($diff / 7);
        return sprintf(
            esc_html(_n('hace %s semana', 'hace %s semanas', $diff, 'nova-ui-solar')),
            number_format_i18n($diff)
        );
    }
    
    // Para fechas más antiguas, usar formato estándar
    return date_i18n(get_option('date_format'), $timestamp);
}
