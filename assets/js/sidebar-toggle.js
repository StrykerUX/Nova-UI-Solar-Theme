/**
 * Script específico para manejar el comportamiento del sidebar collapse
 * Este archivo se centra exclusivamente en la funcionalidad del botón de colapso
 */

(function($) {
    'use strict';

    // Ejecutar cuando el DOM esté listo
    $(document).ready(function() {
        initSidebarToggle();
    });

    /**
     * Inicializa el botón de colapso del sidebar con funcionalidad mejorada
     */
    function initSidebarToggle() {
        var $sidebar = $('#sidebar');
        var $mainContent = $('.main-content');
        var $toggleButton = $('#sidebar-toggle');
        
        // Configurar atributos data-title al cargar
        setupTooltips();

        // Manejar clic en el botón de colapso
        $toggleButton.on('click', function(e) {
            e.preventDefault();
            
            // Alternar clase en el sidebar
            $sidebar.toggleClass('sidebar-collapsed');
            
            // Determinar si está colapsado después de la alternancia
            var isCollapsed = $sidebar.hasClass('sidebar-collapsed');
            
            // Actualizar tooltips según el estado
            setupTooltips();
            
            // Forzar un reflow para asegurar que los cambios CSS se apliquen
            // Esto soluciona problemas de renderizado en algunos navegadores
            $sidebar[0].offsetHeight;
            
            // Guardar en localStorage para persistencia
            localStorage.setItem('nova_sidebar_collapsed', isCollapsed);
            
            // Enviar AJAX para guardar la preferencia en WordPress
            $.ajax({
                url: novaUIData.ajaxurl,
                type: 'POST',
                data: {
                    action: 'nova_save_sidebar_state',
                    is_collapsed: isCollapsed,
                    nonce: novaUIData.nonce
                },
                success: function(response) {
                    console.log('Sidebar state saved successfully');
                }
            });
        });

        /**
         * Configura los tooltips para los elementos del menú
         */
        function setupTooltips() {
            var isCollapsed = $sidebar.hasClass('sidebar-collapsed');
            
            // Añadir atributos data-title a los enlaces
            $('.nav-link').each(function() {
                var $link = $(this);
                var $menuText = $link.find('.menu-text');
                
                if ($menuText.length) {
                    // Obtener el texto del enlace
                    var menuText = $menuText.text().trim();
                    
                    // Asignar el atributo data-title para mostrar en tooltips
                    if (menuText) {
                        $link.attr('data-title', menuText);
                    }
                    
                    // Añadir/quitar clase para modo colapsado
                    if (isCollapsed) {
                        $link.addClass('collapsed-nav-link');
                    } else {
                        $link.removeClass('collapsed-nav-link');
                    }
                }
            });
        }

        // Verificar el estado inicial del sidebar al cargar la página
        if (localStorage.getItem('nova_sidebar_collapsed') === 'true') {
            if (!$sidebar.hasClass('sidebar-collapsed')) {
                $sidebar.addClass('sidebar-collapsed');
                setupTooltips();
            }
        }
    }

})(jQuery);
