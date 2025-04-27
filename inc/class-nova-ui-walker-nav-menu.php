<?php
/**
 * Clase personalizada para menús de navegación
 *
 * @package Nova_UI_Solar
 * @since 0.1.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Clase Walker personalizada para menús de navegación
 */
class Nova_UI_Walker_Nav_Menu extends Walker_Nav_Menu {
    /**
     * Iniciar el elemento de nivel superior antes de la lista
     *
     * @param string   $output Usado para añadir contenido adicional.
     * @param int      $depth  Nivel de profundidad del elemento.
     * @param stdClass $args   Objeto de argumentos.
     */
    public function start_lvl(&$output, $depth = 0, $args = null) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat($t, $depth);

        // Clases predeterminadas.
        $classes = array('sub-menu');
        
        // Añadir clases personalizadas según el estilo visual
        $active_style = nova_ui_get_active_style();
        $classes[] = 'sub-menu--' . $active_style;
        
        /**
         * Filtrar la lista de clases CSS para los submenús.
         *
         * @param string[] $classes Array de clases CSS.
         * @param stdClass $args    Objeto de argumentos.
         * @param int      $depth   Profundidad del elemento de menú.
         */
        $class_names = join(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= "{$n}{$indent}<ul$class_names>{$n}";
    }

    /**
     * Iniciar el elemento de menú
     *
     * @param string   $output Usado para añadir contenido adicional.
     * @param WP_Post  $item   Objeto del elemento de menú.
     * @param int      $depth  Nivel de profundidad del elemento.
     * @param stdClass $args   Objeto de argumentos.
     * @param int      $id     ID actual del elemento de menú.
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ($depth) ? str_repeat($t, $depth) : '';

        $classes   = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Añadir clases personalizadas según el estilo visual y localización del menú
        $active_style = nova_ui_get_active_style();
        $classes[] = 'menu-item--' . $active_style;
        
        if (isset($args->theme_location)) {
            // Agregar clases según localización del menú
            if ($args->theme_location === 'sidebar') {
                $classes[] = 'side-nav-item';
                if ($depth === 0) {
                    $classes[] = 'side-nav-item--parent';
                } else {
                    $classes[] = 'side-nav-item--child';
                }
            } elseif ($args->theme_location === 'primary') {
                $classes[] = 'nav-item';
                if ($depth > 0) {
                    $classes[] = 'dropdown-item';
                }
            }
        }
        
        // Verificar si es el elemento activo
        if (in_array('current-menu-item', $classes) || in_array('current-menu-parent', $classes)) {
            $classes[] = 'active';
        }
        
        // Verificar si el elemento tiene hijos para menús desplegables
        $has_children = in_array('menu-item-has-children', $classes);
        
        /**
         * Filtrar las clases CSS para elementos de menú.
         *
         * @param string[] $classes Array de clases CSS.
         * @param WP_Post  $item    Objeto del elemento de menú.
         * @param stdClass $args    Objeto de argumentos.
         * @param int      $depth   Profundidad del elemento de menú.
         */
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        /**
         * Filtrar los ID de elementos de menú.
         *
         * @param string   $menu_id ID del elemento de menú.
         * @param WP_Post  $item    Objeto del elemento de menú.
         * @param stdClass $args    Objeto de argumentos.
         * @param int      $depth   Profundidad del elemento de menú.
         */
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        // Atributos del elemento
        $atts           = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        if ('_blank' === $item->target && empty($item->xfn)) {
            $atts['rel'] = 'noopener noreferrer';
        } else {
            $atts['rel'] = $item->xfn;
        }
        $atts['href']         = !empty($item->url) ? $item->url : '';
        $atts['aria-current'] = $item->current ? 'page' : '';
        
        // Añadir clases a los enlaces según ubicación del menú
        if (isset($args->theme_location)) {
            if ($args->theme_location === 'sidebar') {
                $atts['class'] = 'side-nav-link';
                
                // Agregar clase para enlaces con submenú
                if ($has_children) {
                    $atts['class'] .= ' side-nav-link--has-dropdown';
                    if ($depth === 0) {
                        $atts['data-bs-toggle'] = 'collapse';
                        $atts['data-bs-target'] = '#collapse-menu-' . $item->ID;
                        $atts['aria-expanded'] = 'false';
                        $atts['aria-controls'] = 'collapse-menu-' . $item->ID;
                    }
                }
                
                // Si es elemento activo
                if (in_array('active', $classes)) {
                    $atts['class'] .= ' active';
                }
            } elseif ($args->theme_location === 'primary') {
                $atts['class'] = 'nav-link';
                
                // Agregar clase para enlaces con submenú
                if ($has_children && $depth === 0) {
                    $atts['class'] .= ' dropdown-toggle';
                    $atts['data-bs-toggle'] = 'dropdown';
                    $atts['aria-expanded'] = 'false';
                } elseif ($depth > 0) {
                    $atts['class'] = 'dropdown-item';
                }
                
                // Si es elemento activo
                if (in_array('active', $classes)) {
                    $atts['class'] .= ' active';
                }
            } elseif ($args->theme_location === 'footer') {
                $atts['class'] = 'footer-link';
            }
        }

        /**
         * Filtrar los atributos HTML para el elemento de menú.
         *
         * @param array    $atts   Atributos HTML.
         * @param WP_Post  $item   Objeto del elemento de menú.
         * @param stdClass $args   Objeto de argumentos.
         * @param int      $depth  Profundidad del elemento de menú.
         */
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value       = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        /** Este filtro está documentado en wp-includes/post-template.php */
        $title = apply_filters('the_title', $item->title, $item->ID);

        /**
         * Filtrar el título del elemento de menú.
         *
         * @param string   $title Título del elemento de menú.
         * @param WP_Post  $item  Objeto del elemento de menú.
         * @param stdClass $args  Objeto de argumentos.
         * @param int      $depth Profundidad del elemento de menú.
         */
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        // Preparar HTML del elemento de menú
        $item_output  = $args->before;
        $item_output .= '<a' . $attributes . '>';
        
        // Añadir ícono si existe una clase que comienza con 'ti-'
        $icon_class = '';
        foreach ($classes as $class) {
            if (strpos($class, 'ti-') === 0) {
                $icon_class = $class;
                break;
            }
        }
        
        // Para menús laterales, agregar estructura con icono
        if (isset($args->theme_location) && $args->theme_location === 'sidebar') {
            if (!empty($icon_class)) {
                $item_output .= '<span class="menu-icon"><i class="ti ' . esc_attr($icon_class) . '"></i></span>';
            } else {
                // Icono predeterminado si no hay específico
                $item_output .= '<span class="menu-icon"><i class="ti ti-circle"></i></span>';
            }
            
            $item_output .= '<span class="menu-text">' . $args->link_before . $title . $args->link_after . '</span>';
            
            // Añadir flecha para submenús
            if ($has_children) {
                $item_output .= '<span class="menu-arrow"></span>';
            }
        } elseif (isset($args->theme_location) && $args->theme_location === 'primary' && !empty($icon_class)) {
            // Para menú principal, agregar icono si existe
            $item_output .= '<i class="ti ' . esc_attr($icon_class) . ' me-1"></i>';
            $item_output .= $args->link_before . $title . $args->link_after;
        } else {
            // Menú estándar sin iconos
            $item_output .= $args->link_before . $title . $args->link_after;
        }
        
        $item_output .= '</a>';
        $item_output .= $args->after;

        /**
         * Filtrar la salida HTML para un elemento de menú.
         *
         * @param string   $item_output Salida HTML para el elemento de menú.
         * @param WP_Post  $item        Objeto del elemento de menú.
         * @param int      $depth       Profundidad del elemento de menú.
         * @param stdClass $args        Objeto de argumentos.
         */
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        
        // Para el menú lateral, iniciar contenedor colapsable para submenús
        if (isset($args->theme_location) && $args->theme_location === 'sidebar' && $has_children && $depth === 0) {
            $output .= '<div id="collapse-menu-' . $item->ID . '" class="collapse side-nav-collapse">';
        }
    }
    
    /**
     * Finalizar el elemento de menú
     *
     * @param string   $output Usado para añadir contenido adicional.
     * @param WP_Post  $item   Objeto del elemento de menú.
     * @param int      $depth  Nivel de profundidad del elemento.
     * @param stdClass $args   Objeto de argumentos.
     */
    public function end_el(&$output, $item, $depth = 0, $args = null) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        
        // Verificar si el elemento tiene hijos para cerrar el contenedor colapsable
        $has_children = in_array('menu-item-has-children', (array) $item->classes);
        
        if (isset($args->theme_location) && $args->theme_location === 'sidebar' && $has_children && $depth === 0) {
            $output .= '</div>';
        }
        
        $output .= "</li>{$n}";
    }
    
    /**
     * Finalizar el elemento de nivel superior después de la lista
     *
     * @param string   $output Usado para añadir contenido adicional.
     * @param int      $depth  Nivel de profundidad del elemento.
     * @param stdClass $args   Objeto de argumentos.
     */
    public function end_lvl(&$output, $depth = 0, $args = null) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat($t, $depth);
        $output .= "$indent</ul>{$n}";
    }
}
