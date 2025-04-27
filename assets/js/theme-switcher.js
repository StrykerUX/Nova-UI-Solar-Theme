/**
 * Script para el cambiador de estilos visuales
 * Maneja la lógica de cambio entre distintos estilos visuales del tema
 */

(function($) {
    'use strict';
    
    // Ejecutar cuando el DOM esté listo
    $(document).ready(function() {
        
        // Inicializar el cambiador de estilos
        initVisualStyles();
        
        // Añadir interactividad al cambiador de estilos
        $('.style-switcher-toggle').on('click', function() {
            $('.style-switcher').toggleClass('active');
        });
        
        // Cerrar el selector al hacer clic fuera
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.style-switcher').length && 
                !$(e.target).closest('.style-switcher-toggle').length) {
                $('.style-switcher').removeClass('active');
            }
        });
    });
    
    /**
     * Inicializa los estilos visuales y su lógica de cambio
     */
    function initVisualStyles() {
        // Estilos disponibles
        const styles = [
            {
                id: 'soft-neo-brutalism',
                name: 'Soft Neo-Brutalism',
                description: 'Estilo suave con bordes redondeados y sombras suaves',
                cssFile: 'soft-neo-brutalism.css',
                thumbnailUrl: '/assets/images/themes/soft-neo-brutalism-thumb.jpg'
            },
            {
                id: 'neo-brutalism',
                name: 'Neo-Brutalism',
                description: 'Estilo audaz con bordes marcados y contrastes fuertes',
                cssFile: 'neo-brutalism.css',
                thumbnailUrl: '/assets/images/themes/neo-brutalism-thumb.jpg'
            },
            {
                id: 'futurismo-minimalista',
                name: 'Futurismo Minimalista',
                description: 'Interfaz elegante y minimalista con toques tecnológicos',
                cssFile: 'futurismo-minimalista.css',
                thumbnailUrl: '/assets/images/themes/futurismo-minimalista-thumb.jpg'
            },
            {
                id: 'cyberpunk',
                name: 'Cyberpunk',
                description: 'Estética futurista con colores neón y efectos visuales llamativos',
                cssFile: 'cyberpunk.css',
                thumbnailUrl: '/assets/images/themes/cyberpunk-thumb.jpg'
            }
        ];
        
        // Cambiar estilo visual al hacer clic en un elemento
        $('.style-list li').on('click', function() {
            const styleId = $(this).data('style');
            changeVisualStyle(styleId);
        });
        
        // Obtener estilo visual actual (desde HTML o localStorage)
        const currentStyle = $('html').attr('data-style') || 
                             localStorage.getItem('nova_visual_style') || 
                             'soft-neo-brutalism';
        
        // Aplicar el estilo actual
        applyVisualStyle(currentStyle);
    }
    
    /**
     * Cambia el estilo visual actual
     * @param {string} styleId - El ID del estilo a aplicar
     */
    function changeVisualStyle(styleId) {
        // Validar que sea un estilo permitido
        if (!styleId || !['soft-neo-brutalism', 'neo-brutalism', 'futurismo-minimalista', 'cyberpunk'].includes(styleId)) {
            console.error('Estilo visual no válido:', styleId);
            return;
        }
        
        // Aplicar el estilo
        applyVisualStyle(styleId);
        
        // Guardar preferencia
        localStorage.setItem('nova_visual_style', styleId);
        
        // Enviar AJAX para guardar en WordPress
        if (typeof novaUIData !== 'undefined') {
            $.ajax({
                url: novaUIData.ajaxurl,
                type: 'POST',
                data: {
                    action: 'nova_update_visual_style',
                    style: styleId,
                    nonce: novaUIData.nonce
                },
                success: function(response) {
                    // Mostrar mensaje de éxito
                    if (response.success && window.NovaUI && window.NovaUI.showToast) {
                        window.NovaUI.showToast('Estilo visual actualizado', 'success');
                    }
                },
                error: function() {
                    console.error('Error al guardar preferencia de estilo visual');
                }
            });
        }
    }
    
    /**
     * Aplica un estilo visual específico
     * @param {string} styleId - El ID del estilo a aplicar
     */
    function applyVisualStyle(styleId) {
        // Actualizar atributo en HTML
        $('html').attr('data-style', styleId);
        
        // Actualizar clase activa en el selector
        $('.style-list li').removeClass('active');
        $(`.style-list li[data-style="${styleId}"]`).addClass('active');
        
        // Aplicar clases específicas para cada estilo
        applyStyleSpecificClasses(styleId);
    }
    
    /**
     * Aplica clases específicas dependiendo del estilo visual
     * @param {string} styleId - El ID del estilo a aplicar
     */
    function applyStyleSpecificClasses(styleId) {
        // Remover todas las clases de estilo
        const styleClasses = ['soft-neo-brutalism', 'neo-brutalism', 'futurismo-minimalista', 'cyberpunk'];
        $('body').removeClass(styleClasses.join(' '));
        
        // Añadir la clase del estilo actual
        $('body').addClass(styleId);
        
        // Aplicar modificaciones específicas según el estilo
        switch(styleId) {
            case 'soft-neo-brutalism':
                // Redondear bordes, añadir sombras suaves
                $('.btn, .card').css('border-radius', '8px');
                break;
                
            case 'neo-brutalism':
                // Bordes marcados, ángulos rectos
                $('.btn, .card').css('border-radius', '0');
                break;
                
            case 'futurismo-minimalista':
                // Bordes sutiles, estilos minimalistas
                $('.btn, .card').css('border-radius', '4px');
                break;
                
            case 'cyberpunk':
                // Estilos neón, ángulos más acentuados
                $('.btn, .card').css('border-radius', '2px');
                break;
        }
    }
    
})(jQuery);
