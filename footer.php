<?php
/**
 * El pie de página para nuestro tema
 *
 * Contiene el código de cierre de #page y todo el contenido después
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nova_UI_Solar
 */

// Verificar si estamos en una página con plantilla de dashboard
$is_dashboard = is_page_template('page-templates/dashboard.php') || 
                is_page_template('page-templates/profile.php') || 
                is_page_template('page-templates/settings.php');

if ($is_dashboard) :
    // Cierre para plantillas de dashboard
    ?>
            </div> <!-- .content-page -->
            
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo date('Y'); ?> © <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-end footer-links d-none d-md-block">
                                <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Inicio', 'nova-ui-solar'); ?></a>
                                <a href="javascript: void(0);"><?php esc_html_e('Soporte', 'nova-ui-solar'); ?></a>
                                <a href="javascript: void(0);"><?php esc_html_e('Contacto', 'nova-ui-solar'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div> <!-- .main-content -->
<?php else : ?>
    <!-- Pie de página estándar para el resto de páginas -->
    <footer id="colophon" class="site-footer">
        <div class="footer-widgets">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-1'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-2'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-3'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="site-info">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="copyright">
                            <?php
                            printf(
                                /* translators: %s: Nombre del sitio. */
                                esc_html__('© %1$s %2$s. Todos los derechos reservados.', 'nova-ui-solar'),
                                date('Y'),
                                '<a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>'
                            );
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-menu text-md-end">
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'footer',
                                    'menu_id'        => 'footer-menu',
                                    'depth'          => 1,
                                    'container'      => false,
                                    'menu_class'     => 'list-inline mb-0',
                                )
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
<?php endif; ?>
</div><!-- #page -->

<!-- Selector de estilos visuales (solo visible para administradores) -->
<?php if (current_user_can('administrator')) : ?>
<div class="style-switcher">
    <div class="style-switcher-toggle">
        <i class="ti ti-palette"></i>
    </div>
    <div class="style-switcher-content">
        <h5><?php esc_html_e('Selector de estilos', 'nova-ui-solar'); ?></h5>
        <ul class="style-list">
            <li data-style="soft-neo-brutalism" class="<?php echo get_theme_mod('nova_ui_visual_style', 'soft-neo-brutalism') === 'soft-neo-brutalism' ? 'active' : ''; ?>">
                <?php esc_html_e('Soft Neo-Brutalism', 'nova-ui-solar'); ?>
            </li>
            <li data-style="neo-brutalism" class="<?php echo get_theme_mod('nova_ui_visual_style') === 'neo-brutalism' ? 'active' : ''; ?>">
                <?php esc_html_e('Neo-Brutalism', 'nova-ui-solar'); ?>
            </li>
            <li data-style="futurismo-minimalista" class="<?php echo get_theme_mod('nova_ui_visual_style') === 'futurismo-minimalista' ? 'active' : ''; ?>">
                <?php esc_html_e('Futurismo Minimalista', 'nova-ui-solar'); ?>
            </li>
            <li data-style="cyberpunk" class="<?php echo get_theme_mod('nova_ui_visual_style') === 'cyberpunk' ? 'active' : ''; ?>">
                <?php esc_html_e('Cyberpunk', 'nova-ui-solar'); ?>
            </li>
        </ul>
    </div>
</div>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
