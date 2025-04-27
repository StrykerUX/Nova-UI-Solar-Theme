<?php
/**
 * El archivo de plantilla principal
 *
 * Este es el archivo de plantilla más genérico en un tema de WordPress
 * y uno de los dos archivos requeridos para un tema (el otro es style.css).
 * Se usa para mostrar una página cuando no hay iguales más específicas.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nova_UI_Solar
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php
                if (have_posts()) :
                    if (is_home() && !is_front_page()) :
                        ?>
                        <header>
                            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                        </header>
                        <?php
                    endif;

                    /* Iniciar el Loop */
                    while (have_posts()) :
                        the_post();

                        /*
                         * Incluir la parte de plantilla para el formato de contenido.
                         */
                        get_template_part('template-parts/content', get_post_type());

                    endwhile;

                    the_posts_navigation();

                else :

                    get_template_part('template-parts/content', 'none');

                endif;
                ?>
            </div>
            
            <div class="col-lg-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main><!-- #primary -->

<?php
get_footer();
