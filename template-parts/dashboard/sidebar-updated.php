<?php
/**
 * Barra lateral mejorada para el dashboard según el diseño Soft Neo-Brutalism
 *
 * @package Nova_UI_Solar
 */

// Obtener el estilo visual activo
$active_style = get_theme_mod('nova_ui_visual_style', 'soft-neo-brutalism');

// Obtener el modo de la barra lateral
$sidebar_mode = get_theme_mod('nova_ui_sidebar_mode', 'default');
$collapsed_class = ($sidebar_mode === 'collapsed') ? 'sidebar-collapsed' : '';
?>

<div id="sidebar" class="sidebar <?php echo esc_attr($active_style); ?> <?php echo esc_attr($collapsed_class); ?>">
    <div class="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <div class="logo-icon">
                        <i class="ti ti-gamepad-2"></i>
                    </div>
                    <span class="logo-text">
                        Nova<span style="color: var(--nova-primary);">UI</span>
                    </span>
                <?php endif; ?>
            </a>
            <button id="sidebar-toggle" class="sidebar-toggle" aria-label="<?php esc_attr_e('Alternar barra lateral', 'nova-ui-solar'); ?>">
                <i class="ti ti-menu-2"></i>
            </button>
        </div>

        <div class="sidebar-menu">
            <?php if (has_nav_menu('sidebar')) : ?>
                <?php 
                wp_nav_menu(array(
                    'theme_location' => 'sidebar',
                    'menu_class'     => 'nav',
                    'container'      => false,
                    'depth'          => 2,
                    'walker'         => new Nova_UI_Walker_Nav_Menu(),
                ));
                ?>
            <?php else : ?>
                <!-- Menú predeterminado estilizado según el Soft Neo-Brutalism -->
                <ul class="nav">
                    <li class="nav-item active">
                        <a href="#" class="nav-link soft-neo-nav-link active">
                            <span class="menu-icon"><i class="ti ti-home"></i></span>
                            <span class="menu-text"><?php esc_html_e('Dashboard', 'nova-ui-solar'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link soft-neo-nav-link">
                            <span class="menu-icon"><i class="ti ti-chart-bar"></i></span>
                            <span class="menu-text"><?php esc_html_e('Análisis', 'nova-ui-solar'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link soft-neo-nav-link">
                            <span class="menu-icon"><i class="ti ti-message-circle"></i></span>
                            <span class="menu-text"><?php esc_html_e('Chat IA', 'nova-ui-solar'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link soft-neo-nav-link">
                            <span class="menu-icon"><i class="ti ti-link"></i></span>
                            <span class="menu-text"><?php esc_html_e('Enlaces Rápidos', 'nova-ui-solar'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link soft-neo-nav-link">
                            <span class="menu-icon"><i class="ti ti-file-text"></i></span>
                            <span class="menu-text"><?php esc_html_e('Documentos', 'nova-ui-solar'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link soft-neo-nav-link">
                            <span class="menu-icon"><i class="ti ti-calendar"></i></span>
                            <span class="menu-text"><?php esc_html_e('Calendario', 'nova-ui-solar'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link soft-neo-nav-link">
                            <span class="menu-icon"><i class="ti ti-briefcase"></i></span>
                            <span class="menu-text"><?php esc_html_e('Proyectos', 'nova-ui-solar'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link soft-neo-nav-link has-dropdown">
                            <span class="menu-icon"><i class="ti ti-settings"></i></span>
                            <span class="menu-text"><?php esc_html_e('Configuración', 'nova-ui-solar'); ?></span>
                            <i class="ti ti-chevron-down dropdown-indicator"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="soft-neo-dropdown-item"><?php esc_html_e('Perfil', 'nova-ui-solar'); ?></a></li>
                            <li><a href="#" class="soft-neo-dropdown-item"><?php esc_html_e('Preferencias', 'nova-ui-solar'); ?></a></li>
                            <li><a href="#" class="soft-neo-dropdown-item"><?php esc_html_e('Seguridad', 'nova-ui-solar'); ?></a></li>
                        </ul>
                    </li>
                </ul>
            <?php endif; ?>
        </div>

        <div class="sidebar-footer">
            <?php if ($active_style === 'soft-neo-brutalism') : ?>
                <!-- Estilo mejorado para Soft Neo-Brutalism -->
                <div class="system-status">
                    <div class="status-card">
                        <div class="status-icon">
                            <i class="ti ti-help-circle"></i>
                        </div>
                        <div class="status-info">
                            <p class="status-title"><?php esc_html_e('¿Necesitas ayuda?', 'nova-ui-solar'); ?></p>
                            <p class="status-text"><?php esc_html_e('Revisa la documentación', 'nova-ui-solar'); ?></p>
                        </div>
                    </div>
                </div>
            <?php elseif ($active_style === 'neo-brutalism') : ?>
                <!-- Estilo para Neo-Brutalism -->
                <div class="system-status neo">
                    <div class="status-card">
                        <div class="status-icon">
                            <i class="ti ti-shield-check"></i>
                        </div>
                        <div class="status-info">
                            <h5><?php esc_html_e('ESTADO SEGURO', 'nova-ui-solar'); ?></h5>
                            <p><?php esc_html_e('SISTEMAS FUNCIONANDO', 'nova-ui-solar'); ?></p>
                        </div>
                    </div>
                </div>
            <?php elseif ($active_style === 'futurismo-minimalista') : ?>
                <!-- Estilo para Futurismo Minimalista -->
                <div class="system-status minimal">
                    <div class="status-icon">
                        <i class="ti ti-shield"></i>
                    </div>
                    <div class="status-info">
                        <p><?php esc_html_e('Estado del Sistema: Normal', 'nova-ui-solar'); ?></p>
                    </div>
                </div>
            <?php elseif ($active_style === 'cyberpunk') : ?>
                <!-- Estilo para Cyberpunk -->
                <div class="system-status cyber">
                    <div class="status-grid">
                        <div class="status-indicator active"></div>
                        <div class="status-indicator active"></div>
                        <div class="status-indicator"></div>
                    </div>
                    <div class="status-info">
                        <h5><?php esc_html_e('ENLACE SEGURO', 'nova-ui-solar'); ?></h5>
                        <p><?php esc_html_e('RED ESTABLE', 'nova-ui-solar'); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
