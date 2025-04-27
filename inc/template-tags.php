<?php
/**
 * Funciones de plantilla personalizadas para el tema Nova UI Solar
 *
 * @package Nova_UI_Solar
 * @since 0.1.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Muestra la meta información de la entrada
 */
if (!function_exists('nova_ui_post_meta')) {
    function nova_ui_post_meta() {
        // Obtener categorías
        $categories_list = get_the_category_list(', ');
        
        // Fecha de publicación
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        echo '<div class="entry-meta">';
        
        // Autor
        echo '<span class="byline"><i class="ti ti-user"></i> ';
        echo '<span class="author vcard">';
        echo '<a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a>';
        echo '</span></span>';
        
        // Fecha
        echo '<span class="posted-on"><i class="ti ti-calendar"></i> ';
        echo '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>';
        echo '</span>';
        
        // Categorías
        if ($categories_list) {
            echo '<span class="cat-links"><i class="ti ti-tag"></i> ' . $categories_list . '</span>';
        }
        
        // Comentarios
        if (!post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link"><i class="ti ti-message-circle"></i> ';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: Nombre de la entrada. */
                        __('Deja un comentario<span class="screen-reader-text"> en %s</span>', 'nova-ui-solar'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                )
            );
            echo '</span>';
        }
        
        echo '</div>';
    }
}

/**
 * Muestra la meta información para entradas en formato card
 */
if (!function_exists('nova_ui_card_meta')) {
    function nova_ui_card_meta() {
        echo '<div class="card-meta d-flex align-items-center">';
        
        // Avatar del autor
        echo '<img src="' . esc_url(get_avatar_url(get_the_author_meta('ID'), ['size' => 30])) . '" alt="' . esc_attr(get_the_author()) . '" class="rounded-circle me-2">';
        
        // Nombre del autor
        echo '<span class="me-3">' . esc_html(get_the_author()) . '</span>';
        
        // Fecha
        echo '<span><i class="ti ti-calendar me-1"></i>' . esc_html(get_the_date()) . '</span>';
        
        echo '</div>';
    }
}

/**
 * Muestra el extracto con longitud personalizada
 *
 * @param int $length Longitud del extracto en palabras
 */
if (!function_exists('nova_ui_excerpt')) {
    function nova_ui_excerpt($length = 20) {
        $excerpt = wp_trim_words(get_the_excerpt(), $length);
        echo '<div class="entry-summary">' . $excerpt . '</div>';
    }
}

/**
 * Muestra la imagen destacada con tamaño personalizado
 *
 * @param string $size Tamaño de la imagen
 * @param string $class Clases adicionales para la imagen
 */
if (!function_exists('nova_ui_post_thumbnail')) {
    function nova_ui_post_thumbnail($size = 'post-thumbnail', $class = '') {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) {
            echo '<figure class="post-thumbnail ' . esc_attr($class) . '">';
                the_post_thumbnail($size, array(
                    'alt' => the_title_attribute(array('echo' => false)),
                    'class' => 'img-fluid',
                ));
            echo '</figure>';
        } else {
            echo '<figure class="post-thumbnail ' . esc_attr($class) . '">';
                echo '<a href="' . esc_url(get_permalink()) . '" aria-hidden="true" tabindex="-1">';
                    the_post_thumbnail($size, array(
                        'alt' => the_title_attribute(array('echo' => false)),
                        'class' => 'img-fluid',
                    ));
                echo '</a>';
            echo '</figure>';
        }
    }
}

/**
 * Muestra la navegación de entradas (anterior/siguiente)
 */
if (!function_exists('nova_ui_post_navigation')) {
    function nova_ui_post_navigation() {
        the_post_navigation(array(
            'prev_text' => '<span class="nav-subtitle"><i class="ti ti-arrow-left me-1"></i>' . esc_html__('Anterior', 'nova-ui-solar') . '</span><span class="nav-title">%title</span>',
            'next_text' => '<span class="nav-subtitle">' . esc_html__('Siguiente', 'nova-ui-solar') . '<i class="ti ti-arrow-right ms-1"></i></span><span class="nav-title">%title</span>',
            'class' => 'post-navigation-cards',
        ));
    }
}

/**
 * Muestra una card para entradas en bucles (archive, search, etc)
 */
if (!function_exists('nova_ui_post_card')) {
    function nova_ui_post_card() {
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('card mb-4 ' . nova_ui_style_classes('post-card')); ?>>
            <?php if (has_post_thumbnail()) : ?>
                <div class="card-img-top">
                    <?php nova_ui_post_thumbnail('nova-ui-card'); ?>
                </div>
            <?php endif; ?>
            
            <div class="card-body">
                <header class="entry-header">
                    <?php the_title('<h2 class="card-title entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                    <?php nova_ui_card_meta(); ?>
                </header>

                <div class="card-text mt-3">
                    <?php nova_ui_excerpt(); ?>
                </div>
            </div>
            
            <div class="card-footer">
                <a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-primary btn-sm"><?php echo esc_html__('Leer más', 'nova-ui-solar'); ?> <i class="ti ti-arrow-right ms-1"></i></a>
            </div>
        </article>
        <?php
    }
}

/**
 * Muestra el selector de modo claro/oscuro
 */
if (!function_exists('nova_ui_theme_mode_selector')) {
    function nova_ui_theme_mode_selector() {
        ?>
        <div class="theme-mode-selector">
            <button id="theme-mode-toggle" class="btn btn-link p-0" aria-label="<?php echo esc_attr__('Cambiar modo claro/oscuro', 'nova-ui-solar'); ?>">
                <i class="ti ti-sun sun-icon"></i>
                <i class="ti ti-moon moon-icon"></i>
            </button>
        </div>
        <?php
    }
}

/**
 * Muestra el selector de estilo visual
 */
if (!function_exists('nova_ui_style_selector')) {
    function nova_ui_style_selector() {
        $current_style = nova_ui_get_active_style();
        $styles = array(
            'soft-neo-brutalism' => esc_html__('Soft Neo-Brutalism', 'nova-ui-solar'),
            'neo-brutalism' => esc_html__('Neo-Brutalism', 'nova-ui-solar'),
            'futurismo-minimalista' => esc_html__('Futurismo Minimalista', 'nova-ui-solar'),
            'cyberpunk' => esc_html__('Cyberpunk', 'nova-ui-solar')
        );
        ?>
        <div class="style-selector dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="styleDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ti ti-palette me-1"></i>
                <?php echo esc_html($styles[$current_style]); ?>
            </button>
            <ul class="dropdown-menu" aria-labelledby="styleDropdown">
                <?php foreach ($styles as $style_key => $style_name) : ?>
                    <li>
                        <a class="dropdown-item <?php echo $style_key === $current_style ? 'active' : ''; ?>" 
                           href="#" 
                           data-style="<?php echo esc_attr($style_key); ?>">
                            <?php echo esc_html($style_name); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
    }
}

/**
 * Muestra información del usuario para la barra superior
 */
if (!function_exists('nova_ui_user_info')) {
    function nova_ui_user_info() {
        if (!is_user_logged_in()) {
            return;
        }
        
        $current_user = wp_get_current_user();
        ?>
        <div class="user-info dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?php echo esc_url(get_avatar_url($current_user->ID, ['size' => 32])); ?>" alt="<?php echo esc_attr($current_user->display_name); ?>" class="rounded-circle me-2">
                <div class="d-none d-sm-block">
                    <span class="fw-bold"><?php echo esc_html($current_user->display_name); ?></span>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="<?php echo esc_url(admin_url('profile.php')); ?>"><i class="ti ti-user me-2"></i><?php echo esc_html__('Perfil', 'nova-ui-solar'); ?></a></li>
                <li><a class="dropdown-item" href="<?php echo esc_url(admin_url()); ?>"><i class="ti ti-settings me-2"></i><?php echo esc_html__('Panel de control', 'nova-ui-solar'); ?></a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="<?php echo esc_url(wp_logout_url(home_url())); ?>"><i class="ti ti-logout me-2"></i><?php echo esc_html__('Cerrar sesión', 'nova-ui-solar'); ?></a></li>
            </ul>
        </div>
        <?php
    }
}

/**
 * Muestra el breadcrumb (migas de pan)
 */
if (!function_exists('nova_ui_breadcrumb')) {
    function nova_ui_breadcrumb() {
        if (is_front_page()) {
            return;
        }
        
        echo '<nav aria-label="' . esc_attr__('breadcrumb', 'nova-ui-solar') . '">';
        echo '<ol class="breadcrumb">';
        
        // Inicio
        echo '<li class="breadcrumb-item"><a href="' . esc_url(home_url('/')) . '"><i class="ti ti-home"></i></a></li>';
        
        if (is_category() || is_single()) {
            // Categoría
            if (is_single()) {
                $categories = get_the_category();
                if (!empty($categories)) {
                    echo '<li class="breadcrumb-item"><a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a></li>';
                }
            } else {
                echo '<li class="breadcrumb-item active" aria-current="page">' . single_cat_title('', false) . '</li>';
            }
            
            // Entrada individual
            if (is_single()) {
                echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
            }
        } elseif (is_page()) {
            // Jerarquía de páginas
            if ($post->post_parent) {
                $ancestors = get_post_ancestors($post->ID);
                $ancestors = array_reverse($ancestors);
                
                foreach ($ancestors as $ancestor) {
                    echo '<li class="breadcrumb-item"><a href="' . esc_url(get_permalink($ancestor)) . '">' . get_the_title($ancestor) . '</a></li>';
                }
            }
            
            echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
        } elseif (is_search()) {
            echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html__('Resultados de búsqueda', 'nova-ui-solar') . '</li>';
        } elseif (is_tag()) {
            echo '<li class="breadcrumb-item active" aria-current="page">' . single_tag_title('', false) . '</li>';
        } elseif (is_author()) {
            echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_author() . '</li>';
        } elseif (is_archive()) {
            echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_archive_title() . '</li>';
        } elseif (is_404()) {
            echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html__('Página no encontrada', 'nova-ui-solar') . '</li>';
        }
        
        echo '</ol>';
        echo '</nav>';
    }
}

/**
 * Muestra las etiquetas de una entrada
 */
if (!function_exists('nova_ui_entry_footer')) {
    function nova_ui_entry_footer() {
        // Ocultar categoría y etiqueta para páginas.
        if ('post' === get_post_type()) {
            /* translators: usado entre elementos de la lista, hay un espacio después de la coma */
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'lista de etiquetas', 'nova-ui-solar'));
            if ($tags_list) {
                echo '<div class="entry-footer">';
                echo '<span class="tags-links">';
                echo '<i class="ti ti-tags me-1"></i>';
                echo $tags_list;
                echo '</span>';
                echo '</div>';
            }
        }
        
        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Nombre de la entrada. */
                    __('Editar <span class="screen-reader-text">%s</span>', 'nova-ui-solar'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ),
            '<span class="edit-link"><i class="ti ti-pencil me-1"></i>',
            '</span>'
        );
    }
}
