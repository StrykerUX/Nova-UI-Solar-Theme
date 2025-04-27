<?php
/**
 * Barra superior para el dashboard
 *
 * @package Nova_UI_Solar
 */

// Obtener el estilo visual activo
$active_style = get_theme_mod('nova_ui_visual_style', 'soft-neo-brutalism');

// Obtener el modo del tema
$theme_mode = get_theme_mod('nova_ui_theme_mode', 'light');
?>

<div class="topbar <?php echo esc_attr($active_style); ?>">
    <div class="container-fluid">
        <div class="topbar-inner">
            <!-- Búsqueda -->
            <div class="search-wrapper">
                <div class="search-box">
                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="search-input-group">
                            <i class="ti ti-search search-icon"></i>
                            <input type="search" class="search-input" placeholder="<?php esc_attr_e('Buscar...', 'nova-ui-solar'); ?>" value="<?php echo get_search_query(); ?>" name="s">
                            <div class="search-shortcut">⌘K</div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Acciones de la derecha -->
            <div class="topbar-right">
                <?php if ($active_style === 'cyberpunk') : ?>
                <!-- Indicadores de sistema para estilo Cyberpunk -->
                <div class="system-indicators">
                    <div class="indicator">
                        <span class="indicator-dot net-indicator"></span>
                        <span class="indicator-label">NET</span>
                    </div>
                    <div class="indicator">
                        <span class="indicator-dot sec-indicator"></span>
                        <span class="indicator-label">SEC</span>
                    </div>
                    <div class="indicator-separator"></div>
                    <div class="indicator">
                        <span class="indicator-value">SYS: <strong>84%</strong></span>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Botón de ayuda (reubicado desde sidebar-footer) -->
                <div class="help-trigger">
                    <i class="ti ti-help-circle"></i>
                    <span><?php esc_html_e('¿Necesitas ayuda?', 'nova-ui-solar'); ?></span>
                </div>

                <!-- Notificaciones -->
                <div class="notification-dropdown dropdown">
                    <button class="notification-btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ti ti-bell"></i>
                        <span class="notification-count">3</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu">
                        <div class="notification-header">
                            <h6 class="notification-title"><?php esc_html_e('Notificaciones', 'nova-ui-solar'); ?></h6>
                            <a href="#" class="notification-clear"><?php esc_html_e('Marcar todas como leídas', 'nova-ui-solar'); ?></a>
                        </div>
                        <div class="notification-list">
                            <a href="#" class="notification-item">
                                <div class="notification-icon bg-primary">
                                    <i class="ti ti-message-circle"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="notification-text"><?php esc_html_e('Nuevo mensaje de Carlos Ruiz', 'nova-ui-solar'); ?></p>
                                    <p class="notification-time"><?php esc_html_e('hace 30 minutos', 'nova-ui-solar'); ?></p>
                                </div>
                            </a>
                            <a href="#" class="notification-item">
                                <div class="notification-icon bg-warning">
                                    <i class="ti ti-alert-triangle"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="notification-text"><?php esc_html_e('Tu suscripción expira pronto', 'nova-ui-solar'); ?></p>
                                    <p class="notification-time"><?php esc_html_e('hace 2 horas', 'nova-ui-solar'); ?></p>
                                </div>
                            </a>
                            <a href="#" class="notification-item">
                                <div class="notification-icon bg-success">
                                    <i class="ti ti-check"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="notification-text"><?php esc_html_e('Tarea completada exitosamente', 'nova-ui-solar'); ?></p>
                                    <p class="notification-time"><?php esc_html_e('hace 3 horas', 'nova-ui-solar'); ?></p>
                                </div>
                            </a>
                        </div>
                        <div class="notification-footer">
                            <a href="#" class="notification-view-all"><?php esc_html_e('Ver todas las notificaciones', 'nova-ui-solar'); ?></a>
                        </div>
                    </div>
                </div>

                <!-- Cambio de tema (Claro/Oscuro) -->
                <div class="theme-toggle">
                    <button id="theme-toggle-btn" class="theme-toggle-btn" aria-label="<?php esc_attr_e('Cambiar tema claro/oscuro', 'nova-ui-solar'); ?>">
                        <?php if ($theme_mode === 'dark') : ?>
                            <i class="ti ti-sun theme-light-icon"></i>
                        <?php else : ?>
                            <i class="ti ti-moon theme-dark-icon"></i>
                        <?php endif; ?>
                    </button>
                </div>

                <!-- Menú de usuario -->
                <div class="user-dropdown dropdown">
                    <button class="user-dropdown-toggle dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php 
                        // Si el usuario tiene avatar, mostrarlo
                        if (is_user_logged_in()) {
                            $current_user = wp_get_current_user();
                            $avatar = get_avatar($current_user->ID, 32);
                            if ($avatar) {
                                echo $avatar;
                            } else {
                                echo '<div class="user-avatar">' . esc_html(substr($current_user->display_name, 0, 1)) . '</div>';
                            }
                            echo '<span class="user-name d-none d-md-inline-block">' . esc_html($current_user->display_name) . '</span>';
                        } else {
                            echo '<div class="user-avatar">G</div>';
                            echo '<span class="user-name d-none d-md-inline-block">' . esc_html__('Invitado', 'nova-ui-solar') . '</span>';
                        }
                        ?>
                        <i class="ti ti-chevron-down dropdown-indicator"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end user-dropdown-menu">
                        <div class="dropdown-header">
                            <?php 
                            if (is_user_logged_in()) {
                                $current_user = wp_get_current_user();
                                echo '<h6 class="dropdown-title">' . esc_html($current_user->display_name) . '</h6>';
                                echo '<p class="dropdown-subtitle">' . esc_html($current_user->user_email) . '</p>';
                            } else {
                                echo '<h6 class="dropdown-title">' . esc_html__('Invitado', 'nova-ui-solar') . '</h6>';
                                echo '<p class="dropdown-subtitle">' . esc_html__('Inicia sesión para acceder a todas las funciones', 'nova-ui-solar') . '</p>';
                            }
                            ?>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo esc_url(home_url('/perfil/')); ?>" class="dropdown-item">
                            <i class="ti ti-user dropdown-item-icon"></i>
                            <?php esc_html_e('Mi perfil', 'nova-ui-solar'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/configuracion/')); ?>" class="dropdown-item">
                            <i class="ti ti-settings dropdown-item-icon"></i>
                            <?php esc_html_e('Configuración', 'nova-ui-solar'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/suscripcion/')); ?>" class="dropdown-item">
                            <i class="ti ti-crown dropdown-item-icon"></i>
                            <?php esc_html_e('Suscripción', 'nova-ui-solar'); ?>
                        </a>
                        <div class="dropdown-divider"></div>
                        <?php if (is_user_logged_in()) : ?>
                            <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="dropdown-item text-danger">
                                <i class="ti ti-logout dropdown-item-icon"></i>
                                <?php esc_html_e('Cerrar sesión', 'nova-ui-solar'); ?>
                            </a>
                        <?php else : ?>
                            <a href="<?php echo esc_url(wp_login_url(home_url())); ?>" class="dropdown-item">
                                <i class="ti ti-login dropdown-item-icon"></i>
                                <?php esc_html_e('Iniciar sesión', 'nova-ui-solar'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>