<?php
/**
 * Barra lateral mejorada para el dashboard según el diseño Soft Neo-Brutalism
 * Con integración mejorada para el sistema de menús de WordPress
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
                    <!-- Versión completa del logo (visible cuando la barra no está colapsada) -->
                    <div class="logo-full">
                        <?php the_custom_logo(); ?>
                    </div>
                    <!-- Versión solo ícono (visible cuando la barra está colapsada) -->
                    <div class="logo-icon-only">
                        <div class="logo-icon">
                            <i class="ti ti-gamepad-2"></i>
                        </div>
                    </div>
                <?php else : ?>
                    <!-- Versión completa del logo (visible cuando la barra no está colapsada) -->
                    <div class="logo-full">
                        <div class="logo-icon">
                            <i class="ti ti-gamepad-2"></i>
                        </div>
                        <span class="logo-text">
                            Nova<span style="color: var(--nova-primary);">UI</span>
                        </span>
                    </div>
                    <!-- Versión solo ícono (visible cuando la barra está colapsada) -->
                    <div class="logo-icon-only">
                        <div class="logo-icon">
                            <i class="ti ti-gamepad-2"></i>
                        </div>
                    </div>
                <?php endif; ?>
            </a>
            <!-- El botón de toggle se ha movido al topbar -->
        </div>

        <div class="sidebar-menu">
            <?php
            // Verificar si el menú está asignado a la ubicación 'sidebar'
            if (has_nav_menu('sidebar')) {
                // Usar el Walker personalizado para el menú
                wp_nav_menu(array(
                    'theme_location' => 'sidebar',
                    'menu_class'     => 'nav',
                    'container'      => false,
                    'depth'          => 2,
                    'walker'         => new Nova_UI_Sidebar_Menu_Walker(),
                ));
            } else {
                // Menú predeterminado estilizado según el Soft Neo-Brutalism
                ?>
                <ul class="nav">
                    <li class="nav-item active">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link soft-neo-nav-link active">
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
            <?php } ?>
            
            <?php
            // Mensaje para administradores cuando no hay un menú asignado
            if (is_user_logged_in() && current_user_can('edit_theme_options') && !has_nav_menu('sidebar')) {
                ?>
                <div class="sidebar-menu-notice">
                    <p><?php _e('No hay un menú asignado a la ubicación "Menú Lateral".', 'nova-ui-solar'); ?></p>
                    <a href="<?php echo esc_url(admin_url('nav-menus.php?action=locations')); ?>" class="sidebar-menu-notice-link">
                        <?php _e('Asignar un menú ahora', 'nova-ui-solar'); ?>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<!-- Inicializar tooltips para los elementos del menú cuando está colapsado -->
<script>
// Añadir atributos data-title al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    var isCollapsed = document.getElementById('sidebar').classList.contains('sidebar-collapsed');
    if (isCollapsed) {
        var navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(function(link) {
            var menuText = link.querySelector('.menu-text');
            if (menuText) {
                link.setAttribute('data-title', menuText.textContent.trim());
                link.classList.add('collapsed-nav-link');
            }
        });
    }
});
</script>
