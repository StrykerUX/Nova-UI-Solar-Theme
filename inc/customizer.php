<?php
/**
 * Funciones para el personalizador de temas de WordPress
 *
 * @package Nova_UI_Solar
 * @since 0.1.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Añadir opciones del tema al personalizador de WordPress
 *
 * @param WP_Customize_Manager $wp_customize Objeto del personalizador de temas
 */
function nova_ui_customize_register($wp_customize) {
    // Sección para configuración general del tema
    $wp_customize->add_section(
        'nova_ui_general_section',
        array(
            'title'      => esc_html__('Nova UI - Configuración general', 'nova-ui-solar'),
            'priority'   => 30,
        )
    );
    
    // Configuración para modo del tema (claro/oscuro)
    $wp_customize->add_setting(
        'nova_ui_theme_mode',
        array(
            'default'           => 'light',
            'sanitize_callback' => 'nova_ui_sanitize_select',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'nova_ui_theme_mode',
        array(
            'label'       => esc_html__('Modo del tema', 'nova-ui-solar'),
            'description' => esc_html__('Selecciona el modo de visualización predeterminado.', 'nova-ui-solar'),
            'section'     => 'nova_ui_general_section',
            'type'        => 'radio',
            'choices'     => array(
                'light' => esc_html__('Claro', 'nova-ui-solar'),
                'dark'  => esc_html__('Oscuro', 'nova-ui-solar'),
                'auto'  => esc_html__('Auto (según preferencia del usuario)', 'nova-ui-solar'),
            ),
        )
    );
    
    // Configuración para estilo visual
    $wp_customize->add_setting(
        'nova_ui_visual_style',
        array(
            'default'           => 'soft-neo-brutalism',
            'sanitize_callback' => 'nova_ui_sanitize_select',
            'transport'         => 'refresh', // Necesita recarga completa para cambiar el estilo
        )
    );
    
    $wp_customize->add_control(
        'nova_ui_visual_style',
        array(
            'label'       => esc_html__('Estilo visual', 'nova-ui-solar'),
            'description' => esc_html__('Selecciona el estilo visual para el tema.', 'nova-ui-solar'),
            'section'     => 'nova_ui_general_section',
            'type'        => 'select',
            'choices'     => array(
                'soft-neo-brutalism'    => esc_html__('Soft Neo-Brutalism', 'nova-ui-solar'),
                'neo-brutalism'         => esc_html__('Neo-Brutalism', 'nova-ui-solar'),
                'futurismo-minimalista' => esc_html__('Futurismo Minimalista', 'nova-ui-solar'),
                'cyberpunk'             => esc_html__('Cyberpunk', 'nova-ui-solar'),
            ),
        )
    );
    
    // Configuración para el modo del sidebar
    $wp_customize->add_setting(
        'nova_ui_sidebar_mode',
        array(
            'default'           => 'expanded',
            'sanitize_callback' => 'nova_ui_sanitize_select',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'nova_ui_sidebar_mode',
        array(
            'label'       => esc_html__('Modo del sidebar', 'nova-ui-solar'),
            'description' => esc_html__('Comportamiento predeterminado del sidebar.', 'nova-ui-solar'),
            'section'     => 'nova_ui_general_section',
            'type'        => 'select',
            'choices'     => array(
                'expanded'   => esc_html__('Expandido', 'nova-ui-solar'),
                'collapsed'  => esc_html__('Colapsado', 'nova-ui-solar'),
                'hidden'     => esc_html__('Oculto', 'nova-ui-solar'),
            ),
        )
    );
    
    // Sección para personalizar colores
    $wp_customize->add_section(
        'nova_ui_colors_section',
        array(
            'title'      => esc_html__('Nova UI - Colores', 'nova-ui-solar'),
            'priority'   => 31,
        )
    );
    
    // Color primario
    $wp_customize->add_setting(
        'nova_ui_primary_color',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'nova_ui_primary_color',
            array(
                'label'       => esc_html__('Color primario', 'nova-ui-solar'),
                'description' => esc_html__('Personaliza el color primario. Deja en blanco para usar el predeterminado del estilo.', 'nova-ui-solar'),
                'section'     => 'nova_ui_colors_section',
            )
        )
    );
    
    // Color secundario
    $wp_customize->add_setting(
        'nova_ui_secondary_color',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'nova_ui_secondary_color',
            array(
                'label'       => esc_html__('Color secundario', 'nova-ui-solar'),
                'description' => esc_html__('Personaliza el color secundario. Deja en blanco para usar el predeterminado del estilo.', 'nova-ui-solar'),
                'section'     => 'nova_ui_colors_section',
            )
        )
    );
    
    // Color de acento
    $wp_customize->add_setting(
        'nova_ui_accent_color',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'nova_ui_accent_color',
            array(
                'label'       => esc_html__('Color de acento', 'nova-ui-solar'),
                'description' => esc_html__('Personaliza el color de acento. Deja en blanco para usar el predeterminado del estilo.', 'nova-ui-solar'),
                'section'     => 'nova_ui_colors_section',
            )
        )
    );
    
    // Sección para configuración de layout
    $wp_customize->add_section(
        'nova_ui_layout_section',
        array(
            'title'      => esc_html__('Nova UI - Layout', 'nova-ui-solar'),
            'priority'   => 32,
        )
    );
    
    // Ancho del contenedor
    $wp_customize->add_setting(
        'nova_ui_container_width',
        array(
            'default'           => 'lg',
            'sanitize_callback' => 'nova_ui_sanitize_select',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'nova_ui_container_width',
        array(
            'label'       => esc_html__('Ancho del contenedor', 'nova-ui-solar'),
            'description' => esc_html__('Selecciona el ancho máximo del contenedor.', 'nova-ui-solar'),
            'section'     => 'nova_ui_layout_section',
            'type'        => 'select',
            'choices'     => array(
                'sm'     => esc_html__('Pequeño (540px)', 'nova-ui-solar'),
                'md'     => esc_html__('Mediano (720px)', 'nova-ui-solar'),
                'lg'     => esc_html__('Grande (960px)', 'nova-ui-solar'),
                'xl'     => esc_html__('Extra grande (1140px)', 'nova-ui-solar'),
                'xxl'    => esc_html__('2XL (1320px)', 'nova-ui-solar'),
                'fluid'  => esc_html__('Fluido (100%)', 'nova-ui-solar'),
            ),
        )
    );
    
    // Radio de bordes
    $wp_customize->add_setting(
        'nova_ui_border_radius',
        array(
            'default'           => 'default',
            'sanitize_callback' => 'nova_ui_sanitize_select',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'nova_ui_border_radius',
        array(
            'label'       => esc_html__('Radio de bordes', 'nova-ui-solar'),
            'description' => esc_html__('Personaliza el radio de bordes para elementos UI.', 'nova-ui-solar'),
            'section'     => 'nova_ui_layout_section',
            'type'        => 'select',
            'choices'     => array(
                'default' => esc_html__('Por defecto (según estilo)', 'nova-ui-solar'),
                'sharp'   => esc_html__('Esquinas afiladas (0px)', 'nova-ui-solar'),
                'subtle'  => esc_html__('Sutil (4px)', 'nova-ui-solar'),
                'rounded' => esc_html__('Redondeado (8px)', 'nova-ui-solar'),
                'circle'  => esc_html__('Muy redondeado (16px)', 'nova-ui-solar'),
            ),
        )
    );
    
    // Densidad de UI
    $wp_customize->add_setting(
        'nova_ui_density',
        array(
            'default'           => 'comfortable',
            'sanitize_callback' => 'nova_ui_sanitize_select',
            'transport'         => 'refresh',
        )
    );
    
    $wp_customize->add_control(
        'nova_ui_density',
        array(
            'label'       => esc_html__('Densidad de UI', 'nova-ui-solar'),
            'description' => esc_html__('Controla el espaciado en la interfaz.', 'nova-ui-solar'),
            'section'     => 'nova_ui_layout_section',
            'type'        => 'radio',
            'choices'     => array(
                'compact'     => esc_html__('Compacta', 'nova-ui-solar'),
                'comfortable' => esc_html__('Comfortable', 'nova-ui-solar'),
                'spacious'    => esc_html__('Espaciosa', 'nova-ui-solar'),
            ),
        )
    );
    
    // Sección para tipografía
    $wp_customize->add_section(
        'nova_ui_typography_section',
        array(
            'title'      => esc_html__('Nova UI - Tipografía', 'nova-ui-solar'),
            'priority'   => 33,
        )
    );
    
    // Familia de fuente
    $wp_customize->add_setting(
        'nova_ui_font_family',
        array(
            'default'           => 'default',
            'sanitize_callback' => 'nova_ui_sanitize_select',
            'transport'         => 'refresh',
        )
    );
    
    $wp_customize->add_control(
        'nova_ui_font_family',
        array(
            'label'       => esc_html__('Familia de fuente', 'nova-ui-solar'),
            'description' => esc_html__('Selecciona la familia de fuente principal.', 'nova-ui-solar'),
            'section'     => 'nova_ui_typography_section',
            'type'        => 'select',
            'choices'     => array(
                'default'     => esc_html__('Por defecto (según estilo)', 'nova-ui-solar'),
                'inter'       => esc_html__('Inter', 'nova-ui-solar'),
                'jost'        => esc_html__('Jost', 'nova-ui-solar'),
                'roboto'      => esc_html__('Roboto', 'nova-ui-solar'),
                'open-sans'   => esc_html__('Open Sans', 'nova-ui-solar'),
                'montserrat'  => esc_html__('Montserrat', 'nova-ui-solar'),
                'system'      => esc_html__('Fuente del sistema', 'nova-ui-solar'),
            ),
        )
    );
    
    // Tamaño de fuente base
    $wp_customize->add_setting(
        'nova_ui_base_font_size',
        array(
            'default'           => 'default',
            'sanitize_callback' => 'nova_ui_sanitize_select',
            'transport'         => 'refresh',
        )
    );
    
    $wp_customize->add_control(
        'nova_ui_base_font_size',
        array(
            'label'       => esc_html__('Tamaño de fuente base', 'nova-ui-solar'),
            'description' => esc_html__('Ajusta el tamaño base de la fuente.', 'nova-ui-solar'),
            'section'     => 'nova_ui_typography_section',
            'type'        => 'select',
            'choices'     => array(
                'default' => esc_html__('Por defecto (16px)', 'nova-ui-solar'),
                'small'   => esc_html__('Pequeño (14px)', 'nova-ui-solar'),
                'medium'  => esc_html__('Mediano (16px)', 'nova-ui-solar'),
                'large'   => esc_html__('Grande (18px)', 'nova-ui-solar'),
                'xlarge'  => esc_html__('Extra grande (20px)', 'nova-ui-solar'),
            ),
        )
    );
}
add_action('customize_register', 'nova_ui_customize_register');

/**
 * Función de sanitización para selecciones
 *
 * @param string $input Valor de entrada
 * @param WP_Customize_Setting $setting Objeto de configuración
 * @return string Valor sanitizado
 */
function nova_ui_sanitize_select($input, $setting) {
    // Obtener la lista de opciones posibles
    $choices = $setting->manager->get_control($setting->id)->choices;
    
    // Devolver el valor de entrada si es válido, o el valor predeterminado
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

/**
 * Genera estilos CSS personalizados basados en las opciones del personalizador
 */
function nova_ui_customizer_css() {
    $primary_color = get_theme_mod('nova_ui_primary_color', '');
    $secondary_color = get_theme_mod('nova_ui_secondary_color', '');
    $accent_color = get_theme_mod('nova_ui_accent_color', '');
    $border_radius = get_theme_mod('nova_ui_border_radius', 'default');
    $density = get_theme_mod('nova_ui_density', 'comfortable');
    
    // Preparar el CSS personalizado
    $css = '';
    
    // Sólo añadir estilos si se han configurado valores personalizados
    if (!empty($primary_color) || !empty($secondary_color) || !empty($accent_color) || $border_radius !== 'default' || $density !== 'comfortable') {
        $css .= ':root {';
        
        // Colores personalizados
        if (!empty($primary_color)) {
            $css .= '--nova-primary-color: ' . $primary_color . ';';
        }
        
        if (!empty($secondary_color)) {
            $css .= '--nova-secondary-color: ' . $secondary_color . ';';
        }
        
        if (!empty($accent_color)) {
            $css .= '--nova-accent-color: ' . $accent_color . ';';
        }
        
        // Radio de bordes
        if ($border_radius !== 'default') {
            switch ($border_radius) {
                case 'sharp':
                    $css .= '--nova-border-radius: 0;';
                    break;
                case 'subtle':
                    $css .= '--nova-border-radius: 4px;';
                    break;
                case 'rounded':
                    $css .= '--nova-border-radius: 8px;';
                    break;
                case 'circle':
                    $css .= '--nova-border-radius: 16px;';
                    break;
            }
        }
        
        // Densidad de UI (espaciado)
        if ($density !== 'comfortable') {
            switch ($density) {
                case 'compact':
                    $css .= '--nova-spacing-unit: 0.75rem;';
                    break;
                case 'spacious':
                    $css .= '--nova-spacing-unit: 1.25rem;';
                    break;
            }
        }
        
        $css .= '}';
    }
    
    // Imprimir el CSS si hay estilos personalizados
    if (!empty($css)) {
        echo '<style type="text/css">' . $css . '</style>';
    }
}
add_action('wp_head', 'nova_ui_customizer_css');

/**
 * Personalizar la vista previa en vivo para el personalizador
 */
function nova_ui_customize_preview_js() {
    wp_enqueue_script('nova-ui-customizer', NOVA_UI_ASSETS_URI . '/js/customizer.js', array('jquery', 'customize-preview'), NOVA_UI_VERSION, true);
}
add_action('customize_preview_init', 'nova_ui_customize_preview_js');
