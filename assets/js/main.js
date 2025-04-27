/**
 * Archivo JavaScript principal para Nova UI Solar Theme
 * Contiene las funcionalidades básicas para el tema
 */

// Asegurarse de que jQuery esté cargado
(function($) {
    'use strict';
    
    // Ejecutar cuando el DOM esté listo
    $(document).ready(function() {
        
        // Inicializar componentes
        initSidebar();
        initThemeToggle();
        initStyleSwitcher();
        initDropdowns();
        initTooltips();
        initNotifications();
        
        // Detectar y aplicar preferencias guardadas
        applyUserPreferences();
    });
    
    /**
     * Inicializa la barra lateral y sus controles
     */
    function initSidebar() {
        // Toggle para colapsar/expandir la barra lateral
        $('#sidebar-toggle').on('click', function(e) {
            e.preventDefault();
            $('#sidebar').toggleClass('sidebar-collapsed');
            
            // Guardar preferencia
            const isCollapsed = $('#sidebar').hasClass('sidebar-collapsed');
            localStorage.setItem('nova_sidebar_collapsed', isCollapsed);
        });
        
        // Manejador para enlaces con submenús
        $('.nav-link.has-dropdown').on('click', function(e) {
            e.preventDefault();
            const $this = $(this);
            const $parent = $this.parent();
            
            // Alternar estado expandido
            $this.attr('aria-expanded', $this.attr('aria-expanded') === 'true' ? 'false' : 'true');
            
            // Mostrar/ocultar submenú
            $parent.find('.dropdown-menu').toggleClass('show');
            
            // Rotar indicador
            $this.find('.dropdown-indicator').toggleClass('rotate-180');
        });
        
        // En dispositivos móviles, cerrar sidebar al hacer clic en un enlace
        if ($(window).width() < 992) {
            $('.sidebar .nav-link:not(.has-dropdown)').on('click', function() {
                $('#sidebar').removeClass('open');
            });
            
            // Botón para abrir/cerrar sidebar en móviles
            $('.mobile-menu-toggle').on('click', function(e) {
                e.preventDefault();
                $('#sidebar').toggleClass('open');
            });
        }
    }
    
    /**
     * Inicializa el selector de tema claro/oscuro
     */
    function initThemeToggle() {
        $('#theme-toggle-btn').on('click', function() {
            const currentTheme = $('html').attr('data-theme') || 'light';
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            // Cambiar el atributo data-theme
            $('html').attr('data-theme', newTheme);
            
            // Actualizar icono del botón
            if (newTheme === 'dark') {
                $(this).html('<i class="ti ti-sun theme-light-icon"></i>');
            } else {
                $(this).html('<i class="ti ti-moon theme-dark-icon"></i>');
            }
            
            // Guardar preferencia
            localStorage.setItem('nova_theme_mode', newTheme);
            
            // Enviar evento AJAX para actualizar la preferencia en WordPress
            $.ajax({
                url: novaUIData.ajaxurl,
                type: 'POST',
                data: {
                    action: 'nova_update_theme_mode',
                    mode: newTheme,
                    nonce: novaUIData.nonce
                }
            });
        });
    }
    
    /**
     * Inicializa el selector de estilos visuales
     */
    function initStyleSwitcher() {
        // Toggle para mostrar/ocultar el selector de estilos
        $('.style-switcher-toggle').on('click', function() {
            $('.style-switcher').toggleClass('active');
        });
        
        // Cambiar estilo al hacer clic
        $('.style-list li').on('click', function() {
            const style = $(this).data('style');
            
            // Actualizar clase activa
            $('.style-list li').removeClass('active');
            $(this).addClass('active');
            
            // Cambiar el atributo data-style
            $('html').attr('data-style', style);
            
            // Guardar preferencia
            localStorage.setItem('nova_visual_style', style);
            
            // Enviar evento AJAX para actualizar la preferencia en WordPress
            $.ajax({
                url: novaUIData.ajaxurl,
                type: 'POST',
                data: {
                    action: 'nova_update_visual_style',
                    style: style,
                    nonce: novaUIData.nonce
                },
                success: function(response) {
                    if (response.success) {
                        // Recargar la página para aplicar el nuevo estilo
                        location.reload();
                    }
                }
            });
        });
    }
    
    /**
     * Inicializa los dropdowns de Bootstrap
     */
    function initDropdowns() {
        // Si Bootstrap JS está cargado, los dropdowns se inicializan automáticamente
        // Esta función es para inicialización manual si es necesario
        $('.dropdown-toggle').on('click', function(e) {
            e.preventDefault();
            $(this).parent().toggleClass('show');
            $(this).next('.dropdown-menu').toggleClass('show');
        });
        
        // Cerrar dropdowns al hacer clic fuera
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.dropdown').length) {
                $('.dropdown-menu.show').removeClass('show');
                $('.dropdown.show').removeClass('show');
            }
        });
    }
    
    /**
     * Inicializa los tooltips de Bootstrap
     */
    function initTooltips() {
        // Si Bootstrap JS está cargado, inicializa tooltips
        if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
            var tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltips.map(function(tooltip) {
                return new bootstrap.Tooltip(tooltip);
            });
        }
    }
    
    /**
     * Inicializa sistema de notificaciones
     */
    function initNotifications() {
        // Marcar todas las notificaciones como leídas
        $('.notification-clear').on('click', function(e) {
            e.preventDefault();
            $('.notification-count').text('0');
            $('.notification-item').removeClass('unread');
            
            // Aquí puedes agregar código para enviar solicitud AJAX para marcar notificaciones como leídas
        });
    }
    
    /**
     * Aplica las preferencias del usuario guardadas
     */
    function applyUserPreferences() {
        // Aplicar tema (claro/oscuro)
        const userTheme = localStorage.getItem('nova_theme_mode') || novaUIData.userTheme || 'light';
        $('html').attr('data-theme', userTheme);
        
        // Actualizar el icono del botón de tema
        if (userTheme === 'dark') {
            $('#theme-toggle-btn').html('<i class="ti ti-sun theme-light-icon"></i>');
        } else {
            $('#theme-toggle-btn').html('<i class="ti ti-moon theme-dark-icon"></i>');
        }
        
        // Aplicar estado de la barra lateral (expandida/colapsada)
        const sidebarCollapsed = localStorage.getItem('nova_sidebar_collapsed');
        if (sidebarCollapsed === 'true') {
            $('#sidebar').addClass('sidebar-collapsed');
        }
        
        // Aplicar estilo visual
        const visualStyle = localStorage.getItem('nova_visual_style') || novaUIData.visualStyle || 'soft-neo-brutalism';
        $('html').attr('data-style', visualStyle);
        $('.style-list li').removeClass('active');
        $(`.style-list li[data-style="${visualStyle}"]`).addClass('active');
    }
    
    /**
     * Función de utilidad para mostrar notificaciones toast
     * @param {string} message - Mensaje a mostrar
     * @param {string} type - Tipo de notificación (success, error, warning, info)
     * @param {number} duration - Duración en ms antes de desaparecer
     */
    function showToast(message, type = 'info', duration = 3000) {
        // Verificar si ya existe el contenedor de toast
        let toastContainer = $('.toast-container');
        if (toastContainer.length === 0) {
            toastContainer = $('<div class="toast-container"></div>');
            $('body').append(toastContainer);
        }
        
        // Crear el toast
        const toast = $(`
            <div class="toast toast-${type} slide-in-up">
                <div class="toast-header">
                    <i class="ti ti-info-circle me-2"></i>
                    <strong class="me-auto">${type.charAt(0).toUpperCase() + type.slice(1)}</strong>
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    ${message}
                </div>
            </div>
        `);
        
        // Agregar el toast al contenedor
        toastContainer.append(toast);
        
        // Cerrar el toast al hacer clic en el botón de cierre
        toast.find('.btn-close').on('click', function() {
            toast.remove();
        });
        
        // Remover el toast automáticamente después de la duración
        setTimeout(function() {
            toast.fadeOut(500, function() {
                $(this).remove();
            });
        }, duration);
    }
    
    // Exponer funciones para uso global
    window.NovaUI = {
        showToast: showToast
    };
    
})(jQuery);

/**
 * Código para inicializar gráficos si ApexCharts está disponible
 * Esto se ejecutará solo en páginas que requieran gráficos
 */
if (typeof ApexCharts !== 'undefined') {
    document.addEventListener('DOMContentLoaded', function() {
        // Ejemplo de un gráfico de líneas
        const salesChartElement = document.getElementById('sales-chart');
        if (salesChartElement) {
            const salesChart = new ApexCharts(salesChartElement, {
                series: [{
                    name: 'Ventas',
                    data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
                }],
                chart: {
                    height: 350,
                    type: 'line',
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#5E81FF'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                grid: {
                    borderColor: '#e0e0e0',
                    row: {
                        colors: ['#f8f9fa', 'transparent'],
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep'],
                }
            });
            salesChart.render();
        }
        
        // Ejemplo de un gráfico de barras
        const usersChartElement = document.getElementById('users-chart');
        if (usersChartElement) {
            const usersChart = new ApexCharts(usersChartElement, {
                series: [{
                    name: 'Usuarios',
                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#E953FF'],
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: false,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep'],
                }
            });
            usersChart.render();
        }
    });
}
