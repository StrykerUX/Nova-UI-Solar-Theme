<?php
/**
 * Template Name: Dashboard
 *
 * Un template para mostrar un dashboard de estilo SaaS según el estilo visual seleccionado.
 *
 * @package Nova_UI_Solar
 */

get_header();

// Obtener el estilo visual activo
$active_style = get_theme_mod('nova_ui_visual_style', 'soft-neo-brutalism');
?>

<div class="dashboard-wrapper <?php echo esc_attr($active_style); ?>">
    <div class="container-fluid">
        <!-- Page Title y Actions -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <button class="btn btn-primary">
                            <i class="ti ti-plus me-1"></i>
                            <?php esc_html_e('Nuevo Reporte', 'nova-ui-solar'); ?>
                        </button>
                    </div>
                    <h1 class="page-title"><?php the_title(); ?></h1>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row">
            <div class="col-md-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1"><?php esc_html_e('Ingresos Totales', 'nova-ui-solar'); ?></p>
                                <h3 class="mt-0 mb-2">$124,592.40</h3>
                            </div>
                            <div class="stat-icon">
                                <i class="ti ti-currency-dollar"></i>
                            </div>
                        </div>
                        <div class="stat-trend">
                            <span class="text-success me-1">
                                <i class="ti ti-arrow-up-right"></i> 12.4%
                            </span>
                            <span class="text-muted"><?php esc_html_e('vs mes anterior', 'nova-ui-solar'); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1"><?php esc_html_e('Usuarios Activos', 'nova-ui-solar'); ?></p>
                                <h3 class="mt-0 mb-2">4,893</h3>
                            </div>
                            <div class="stat-icon">
                                <i class="ti ti-users"></i>
                            </div>
                        </div>
                        <div class="stat-trend">
                            <span class="text-success me-1">
                                <i class="ti ti-arrow-up-right"></i> 17.2%
                            </span>
                            <span class="text-muted"><?php esc_html_e('vs mes anterior', 'nova-ui-solar'); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1"><?php esc_html_e('Tasa de Conversión', 'nova-ui-solar'); ?></p>
                                <h3 class="mt-0 mb-2">3.42%</h3>
                            </div>
                            <div class="stat-icon">
                                <i class="ti ti-activity"></i>
                            </div>
                        </div>
                        <div class="stat-trend">
                            <span class="text-danger me-1">
                                <i class="ti ti-arrow-down-right"></i> 2.1%
                            </span>
                            <span class="text-muted"><?php esc_html_e('vs mes anterior', 'nova-ui-solar'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Widgets del Dashboard -->
        <div class="row">
            <!-- Chat AI Widget - 2/3 width -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            <i class="ti ti-message-circle me-1"></i>
                            <?php esc_html_e('Chat AI', 'nova-ui-solar'); ?>
                        </h4>
                        <span class="badge bg-primary"><?php esc_html_e('ACTIVO', 'nova-ui-solar'); ?></span>
                    </div>
                    <div class="card-body">
                        <div class="chat-container">
                            <!-- Mensaje AI -->
                            <div class="chat-message ai-message">
                                <div class="chat-avatar">AI</div>
                                <div class="chat-content">
                                    <p><?php esc_html_e('He analizado tus datos de ventas recientes e identificado tendencias clave. Tus ingresos han aumentado un 12,4% en comparación con el mes pasado. ¿Te gustaría un desglose detallado?', 'nova-ui-solar'); ?></p>
                                </div>
                            </div>
                            
                            <!-- Mensaje Usuario -->
                            <div class="chat-message user-message">
                                <div class="chat-content">
                                    <p><?php esc_html_e('Sí, muéstrame el desglose por categoría de producto y destaca los de mejor rendimiento.', 'nova-ui-solar'); ?></p>
                                </div>
                                <div class="chat-avatar">M</div>
                            </div>
                        </div>
                        
                        <div class="chat-input mt-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="<?php esc_attr_e('Escribe tu mensaje...', 'nova-ui-solar'); ?>">
                                <button class="btn btn-primary" type="button">
                                    <i class="ti ti-send me-1"></i> <?php esc_html_e('Enviar', 'nova-ui-solar'); ?>
                                </button>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <small class="text-muted">
                                    <span class="text-primary fw-bold">500</span> <?php esc_html_e('tokens restantes', 'nova-ui-solar'); ?>
                                </small>
                                <a href="#" class="text-primary small"><?php esc_html_e('Ver historial →', 'nova-ui-solar'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links Widget - 1/3 width -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            <i class="ti ti-link me-1"></i>
                            <?php esc_html_e('Enlaces Rápidos', 'nova-ui-solar'); ?>
                        </h4>
                        <button class="btn btn-sm btn-primary">+ <?php esc_html_e('Nuevo', 'nova-ui-solar'); ?></button>
                    </div>
                    <div class="card-body">
                        <div class="link-list">
                            <div class="link-item">
                                <div>
                                    <p class="mb-0 fw-medium"><?php esc_html_e('Portfolio de Productos', 'nova-ui-solar'); ?></p>
                                    <small class="text-muted"><?php esc_html_e('1243 vistas', 'nova-ui-solar'); ?></small>
                                </div>
                                <button class="btn btn-sm btn-light"><?php esc_html_e('Editar', 'nova-ui-solar'); ?></button>
                            </div>
                            
                            <div class="link-item">
                                <div>
                                    <p class="mb-0 fw-medium"><?php esc_html_e('Dashboard Empresarial', 'nova-ui-solar'); ?></p>
                                    <small class="text-muted"><?php esc_html_e('842 vistas', 'nova-ui-solar'); ?></small>
                                </div>
                                <button class="btn btn-sm btn-light"><?php esc_html_e('Editar', 'nova-ui-solar'); ?></button>
                            </div>
                            
                            <div class="link-item">
                                <div>
                                    <p class="mb-0 fw-medium"><?php esc_html_e('Recursos de Soporte', 'nova-ui-solar'); ?></p>
                                    <small class="text-muted"><?php esc_html_e('568 vistas', 'nova-ui-solar'); ?></small>
                                </div>
                                <button class="btn btn-sm btn-light"><?php esc_html_e('Editar', 'nova-ui-solar'); ?></button>
                            </div>
                        </div>
                        
                        <a href="#" class="btn btn-light w-100 mt-3">
                            <?php esc_html_e('Ver Todos los Enlaces', 'nova-ui-solar'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Segunda fila de widgets -->
        <div class="row">
            <!-- Tareas próximas -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            <i class="ti ti-clock me-1"></i>
                            <?php esc_html_e('Tareas Próximas', 'nova-ui-solar'); ?>
                        </h4>
                        <select class="form-select form-select-sm" style="width: auto;">
                            <option><?php esc_html_e('Hoy', 'nova-ui-solar'); ?></option>
                            <option><?php esc_html_e('Esta Semana', 'nova-ui-solar'); ?></option>
                            <option><?php esc_html_e('Este Mes', 'nova-ui-solar'); ?></option>
                        </select>
                    </div>
                    <div class="card-body">
                        <div class="task-list">
                            <div class="task-item">
                                <div class="d-flex align-items-start">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="task1">
                                    </div>
                                    <div class="ms-2">
                                        <label for="task1" class="mb-0 fw-medium"><?php esc_html_e('Actualizar interfaz de Enlaces Rápidos', 'nova-ui-solar'); ?></label>
                                        <p class="text-muted mb-0 small"><?php esc_html_e('10:00 AM', 'nova-ui-solar'); ?></p>
                                    </div>
                                </div>
                                <span class="badge bg-danger"><?php esc_html_e('Alta', 'nova-ui-solar'); ?></span>
                            </div>
                            
                            <div class="task-item">
                                <div class="d-flex align-items-start">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="task2">
                                    </div>
                                    <div class="ms-2">
                                        <label for="task2" class="mb-0 fw-medium"><?php esc_html_e('Revisar rendimiento del Chat AI', 'nova-ui-solar'); ?></label>
                                        <p class="text-muted mb-0 small"><?php esc_html_e('1:30 PM', 'nova-ui-solar'); ?></p>
                                    </div>
                                </div>
                                <span class="badge bg-warning"><?php esc_html_e('Media', 'nova-ui-solar'); ?></span>
                            </div>
                            
                            <div class="task-item">
                                <div class="d-flex align-items-start">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="task3">
                                    </div>
                                    <div class="ms-2">
                                        <label for="task3" class="mb-0 fw-medium"><?php esc_html_e('Reunión de equipo - Planificación sprint', 'nova-ui-solar'); ?></label>
                                        <p class="text-muted mb-0 small"><?php esc_html_e('3:00 PM', 'nova-ui-solar'); ?></p>
                                    </div>
                                </div>
                                <span class="badge bg-danger"><?php esc_html_e('Alta', 'nova-ui-solar'); ?></span>
                            </div>
                            
                            <div class="task-item">
                                <div class="d-flex align-items-start">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="task4">
                                    </div>
                                    <div class="ms-2">
                                        <label for="task4" class="mb-0 fw-medium"><?php esc_html_e('Preparar informe mensual', 'nova-ui-solar'); ?></label>
                                        <p class="text-muted mb-0 small"><?php esc_html_e('5:00 PM', 'nova-ui-solar'); ?></p>
                                    </div>
                                </div>
                                <span class="badge bg-success"><?php esc_html_e('Baja', 'nova-ui-solar'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estado de Membresía -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div class="plan-icon me-3">
                                <i class="ti ti-crown"></i>
                            </div>
                            <div>
                                <h4 class="card-title mb-0"><?php esc_html_e('Plan Profesional', 'nova-ui-solar'); ?></h4>
                                <p class="text-muted mb-0 small"><?php esc_html_e('Activo hasta 26 de Mayo, 2025', 'nova-ui-solar'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-medium"><?php esc_html_e('Tokens IA', 'nova-ui-solar'); ?></span>
                                <span class="fw-medium">500/2000</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 25%"></div>
                            </div>
                            <p class="text-muted mt-2 small"><?php esc_html_e('Los tokens se restablecen en 16 días', 'nova-ui-solar'); ?></p>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-6">
                                <div class="plan-info-card">
                                    <p class="text-muted small mb-1"><?php esc_html_e('Enlaces Rápidos', 'nova-ui-solar'); ?></p>
                                    <p class="display-6 mb-0">3<span class="text-muted small">/10</span></p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="plan-info-card">
                                    <p class="text-muted small mb-1"><?php esc_html_e('Usuarios', 'nova-ui-solar'); ?></p>
                                    <p class="display-6 mb-0">2<span class="text-muted small">/5</span></p>
                                </div>
                            </div>
                        </div>
                        
                        <button class="btn btn-primary w-100"><?php esc_html_e('Mejorar Plan', 'nova-ui-solar'); ?></button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>
