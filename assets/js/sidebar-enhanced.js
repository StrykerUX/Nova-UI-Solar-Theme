/**
 * JavaScript mejorado para la funcionalidad del sidebar
 * Especialmente diseñado para el tema Soft Neo-Brutalism
 */

(function($) {
    'use strict';
    
    // Ejecutar cuando el DOM esté listo
    $(document).ready(function() {
        initEnhancedSidebar();
    });
    
    /**
     * Inicializa la barra lateral mejorada
     */
    function initEnhancedSidebar() {
        // Toggle para colapsar/expandir la barra lateral con animación suave
        $('#sidebar-toggle').on('click', function(e) {
            e.preventDefault();
            $('#sidebar').toggleClass('sidebar-collapsed');
            
            // Añadir efecto visual suave al cambiar
            if ($('#sidebar').hasClass('sidebar-collapsed')) {
                $('.menu-text, .logo-text').css('opacity', '0');
                setTimeout(function() {
                    $('.menu-icon').css('margin-right', '0');
                }, 100);
            } else {
                setTimeout(function() {
                    $('.menu-text, .logo-text').css('opacity', '1');
                    $('.menu-icon').css('margin-right', '12px');
                }, 100);
            }
            
            // Guardar preferencia
            const isCollapsed = $('#sidebar').hasClass('sidebar-collapsed');
            localStorage.setItem('nova_sidebar_collapsed', isCollapsed);
        });
        
        // Manejador para enlaces con submenús
        $('.soft-neo-nav-link.has-dropdown').on('click', function(e) {
            e.preventDefault();
            const $this = $(this);
            
            // Alternar estado expandido
            const expanded = $this.attr('aria-expanded') === 'true';
            $this.attr('aria-expanded', !expanded);
            
            // Mostrar/ocultar submenú con animación
            const $dropdown = $this.next('.dropdown-menu');
            if (expanded) {
                $dropdown.css('max-height', '0');
                $dropdown.removeClass('show');
                $this.find('.dropdown-indicator').css('transform', 'rotate(0deg)');
            } else {
                $dropdown.addClass('show');
                const height = $dropdown.prop('scrollHeight');
                $dropdown.css('max-height', height + 'px');
                $this.find('.dropdown-indicator').css('transform', 'rotate(180deg)');
            }
        });
        
        // Efecto hover mejorado para enlaces
        $('.soft-neo-nav-link').hover(
            function() {
                if (!$(this).hasClass('active')) {
                    $(this).css('transform', 'translateY(-2px)');
                }
            },
            function() {
                if (!$(this).hasClass('active')) {
                    $(this).css('transform', 'translateY(0)');
                }
            }
        );
        
        // Establecer clase active al hacer clic en un enlace
        $('.soft-neo-nav-link:not(.has-dropdown)').on('click', function(e) {
            $('.soft-neo-nav-link').removeClass('active');
            $(this).addClass('active');
        });
        
        // Añadir animación secuencial de entrada para elementos del menú
        $('.nav-item').each(function(index) {
            $(this).css('--item-index', index);
        });
        
        // En dispositivos móviles, cerrar sidebar al hacer clic en un enlace
        if ($(window).width() < 992) {
            $('.sidebar .soft-neo-nav-link:not(.has-dropdown)').on('click', function() {
                $('#sidebar').removeClass('open');
            });
            
            // Botón para abrir/cerrar sidebar en móviles
            $('.mobile-menu-toggle').on('click', function(e) {
                e.preventDefault();
                $('#sidebar').toggleClass('open');
                
                // Añadir overlay al abrir el sidebar en móviles
                if ($('#sidebar').hasClass('open')) {
                    if ($('#sidebar-overlay').length === 0) {
                        $('body').append('<div id="sidebar-overlay"></div>');
                        $('#sidebar-overlay').on('click', function() {
                            $('#sidebar').removeClass('open');
                            $(this).remove();
                        });
                    }
                } else {
                    $('#sidebar-overlay').remove();
                }
            });
        }
        
        // Aplicar estado guardado (expandido/colapsado)
        applyUserSidebarPreferences();
    }
    
    /**
     * Aplica las preferencias guardadas para el sidebar
     */
    function applyUserSidebarPreferences() {
        // Aplicar estado de la barra lateral (expandida/colapsada)
        const sidebarCollapsed = localStorage.getItem('nova_sidebar_collapsed');
        if (sidebarCollapsed === 'true') {
            $('#sidebar').addClass('sidebar-collapsed');
            $('.menu-text, .logo-text').css('opacity', '0');
            $('.menu-icon').css('margin-right', '0');
        }
        
        // Establecer clase active en el enlace actual basado en la URL
        const currentPath = window.location.pathname;
        $('.soft-neo-nav-link').each(function() {
            const linkPath = $(this).attr('href');
            if (linkPath && currentPath.indexOf(linkPath) > -1) {
                $('.soft-neo-nav-link').removeClass('active');
                $(this).addClass('active');
            }
        });
    }
    
})(jQuery);
