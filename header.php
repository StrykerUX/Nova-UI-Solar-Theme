<?php
/**
 * La cabecera para nuestro tema
 *
 * Muestra toda la sección <head> y comienza el <body>
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nova_UI_Solar
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Saltar al contenido', 'nova-ui-solar'); ?></a>

	<?php
	// Verificar si estamos en una página con plantilla de dashboard
	$is_dashboard = is_page_template('page-templates/dashboard.php') || 
					is_page_template('page-templates/profile.php') || 
					is_page_template('page-templates/settings.php');

	if ($is_dashboard) :
		// Incluir sidebar y topbar para plantillas de dashboard
		get_template_part('template-parts/dashboard/sidebar');
		?>
		<div class="main-content">
			<?php get_template_part('template-parts/dashboard/topbar'); ?>
			<div class="content-page">
	<?php else : ?>
		<!-- Cabecera estándar para el resto de páginas -->
		<header id="masthead" class="site-header">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-3">
						<div class="site-branding">
							<?php
							the_custom_logo();
							if (is_front_page() && is_home()) :
								?>
								<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
								<?php
							else :
								?>
								<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
								<?php
							endif;
							$nova_ui_description = get_bloginfo('description', 'display');
							if ($nova_ui_description || is_customize_preview()) :
								?>
								<p class="site-description"><?php echo $nova_ui_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
							<?php endif; ?>
						</div><!-- .site-branding -->
					</div>
					
					<div class="col-lg-9">
						<nav id="site-navigation" class="main-navigation">
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
								<i class="ti ti-menu-2"></i>
								<span><?php esc_html_e('Menú', 'nova-ui-solar'); ?></span>
							</button>
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'menu_id'        => 'primary-menu',
								)
							);
							?>
							
							<!-- Botón para cambiar entre tema claro/oscuro -->
							<div class="theme-switcher">
								<button id="theme-toggle" class="theme-toggle-btn" title="<?php esc_attr_e('Cambiar tema claro/oscuro', 'nova-ui-solar'); ?>">
									<i class="ti ti-sun theme-light-icon"></i>
									<i class="ti ti-moon theme-dark-icon"></i>
								</button>
							</div>
						</nav><!-- #site-navigation -->
					</div>
				</div>
			</div>
		</header><!-- #masthead -->
	<?php endif; ?>
