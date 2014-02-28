<?php
defined('MOODLE_INTERNAL') || die();

$string['order'] = 'Pedidos';
$string['pluginname'] = 'Pedidos';

// Capabilities strings
$string['nocap_view'] = 'No tienes el permiso "local/order:view", necesario para ejecutar esta operación.';
$string['nocap_manage'] = 'No tienes el permiso "local/order:manage", necesario para ejecutar esta operación.';

// Registry pages default strings
$string['rp_notfound'] = 'Página de registro no encontrada, por favor revisa tus enlaces';
$string['rp_theme_notfound'] = 'Tema "{$a}" no encontrado';
$string['rp_theme_noindex'] = 'El tema "{$a}" no tiene fichero "index.php"';
$string['rp_theme_bad_sesskey'] = 'La sesión ha finalizado o es inválida';

$string['order_promotional_discount'] = 'Desuento promocional';

// Navigation menu labels
$string['menu_admin_orders'] = 'Pedidos';
$string['menu_admin_manage_registry_pages'] = 'Páginas de registro';
$string['menu_admin_manage_orders'] = 'Administrar pedidos';

$string['menu_user_orders'] = 'Pedidos';
$string['menu_user_pending_orders'] = 'Pedidos pendientes';
$string['menu_user_validated_orders'] = 'Pedidos pagados';

// Order cost
$string['cost_free'] = 'Gratis';
$string['cost_us_dollar'] = '$USD %.2f';
$string['cost_ca_dollar'] = '$CAD %.2f';
$string['cost_euro'] = '%.2f €';

// Order paymode
$string['paymode_unknown'] = 'N/A';
$string['paymode_paypal'] = 'Paypal';
$string['paymode_banktransfer'] = 'Transferencia bancaria';
$string['paymode_creditcard'] = 'Tarjeta de crédito';
$string['paymode_westernunion'] = 'Western Union';

// Order status
$string['status_all'] = 'Todos';
$string['status_created'] = 'Creado';
$string['status_prepared'] = 'Preparado';
$string['status_pending'] = 'Pendiente';
$string['status_paid'] = 'Pagado';
$string['status_cancelled'] = 'Cancelado';

// Registry page status
$string['rp_status_all'] = 'Todas';
$string['rp_status_enabled'] = 'Habilitada';
$string['rp_status_disabled'] = 'Deshabilitada';

// Item types
$string['itemtype_cohort'] = 'Cohorte';
$string['itemtype_discount'] = 'Descuento';
$string['itemtype_paymode_surcharge'] = 'Recargo por forma de pago';
$string['itemtype_paymode_discount'] = 'Descuento por forma de pago';


// Admin Pages
$string['heading_admin_registry_pages'] = 'Paginas de registro';
$string['heading_admin_registry_page_edit'] = 'Editar página de registro';
$string['heading_admin_registry_page_add'] = 'Añadir nueva página de registro';
$string['heading_admin_registry_page_delete'] = 'Borrar esta página de registro';
$string['heading_admin_orders'] = 'Pedidos';
$string['title_admin_order_details'] = 'Detalles del pedido';
$string['heading_admin_order_details'] = 'Detalles del pedido';
$string['heading_admin_order_items'] = 'Items del pedido';
$string['title_admin_order_validate'] = 'Validar pedido';
$string['heading_admin_order_validate'] = 'Validar pedido';
$string['title_admin_order_cancel'] = 'Cancelar pedido';
$string['heading_admin_order_cancel'] = 'Cancelar pedido';
$string['noitems'] = 'No hay items en este pedido';
$string['search_uniqueid'] = 'UniqueID';
$string['search_email'] = 'Correo electrónico';
$string['search_status'] = 'Estado';
$string['search_theme'] = 'Tema';
$string['search_slug'] = 'Slug';
$string['search_cohort'] = 'Cohorte';
$string['btn_filter'] = 'Filtrar';
$string['link_admin_order_details'] = 'Detalles';
$string['link_admin_order_validate'] = 'Validar';
$string['link_admin_order_cancel'] = 'Cancelar';
$string['link_admin_rp_edit'] = 'Editar';
$string['link_admin_rp_enable'] = 'Habilitar';
$string['link_admin_rp_disable'] = 'Deshabilitar';
$string['link_admin_rp_delete'] = 'Borrar';
$string['link_admin_rp_add'] = 'Añadir nueva página de registro';
$string['link_return'] = 'Volver';
$string['legend_admin_registry_page_basic'] = 'Básicos';
$string['lbl_slug'] = 'Slug';
$string['lbl_cohort'] = 'Cohorte';
$string['lbl_theme'] = 'Tema';
$string['legend_admin_registry_page_edit_general'] = 'General';
$string['link_user_order_details'] = 'Detalles';
$string['link_user_order_cancel'] = 'Cancelar';


$string['col_uniqueid'] = 'UniqueID';
$string['col_fullname'] = 'Usuario';
$string['col_email'] = 'Correo electrónico';
$string['col_createdate'] = 'Fecha';
$string['col_finalcost'] = 'Importe';
$string['col_paymode'] = 'Modo de pago';
$string['col_actions'] = 'Acciones';
$string['col_promotional'] = 'Código promocional';
$string['col_status'] = 'Estado';
$string['col_itemtype'] = 'Tipo';
$string['col_itemname'] = 'Nombre';
$string['col_itemdescription'] = 'Descripción';
$string['col_itemcost'] = 'Coste';
$string['col_total'] = 'TOTAL';
$string['col_slug'] = 'Slug';
$string['col_theme'] = 'Tema';
$string['col_cohort'] = 'Cohorte';

// User pages
$string['title_user_pending_orders'] = 'Pedidos pendientes';
$string['heading_user_pending_orders'] = 'Pedidos pendientes';
$string['title_user_validated_orders'] = 'Pedidos pagados';
$string['heading_user_validated_orders'] = 'Pedidos pagados';
$string['title_user_order_details'] = 'Detalles del pedido';
$string['heading_user_order_details'] = 'Detalles del pedido';
$string['heading_user_order_items'] = 'Items del pedido';
$string['title_user_order_cancel'] = 'Cancelar pedido';
$string['heading_user_order_cancel'] = 'Cancelar pedido';

// Contexts
$string['context_unknown'] = 'N/A';
$string['context_system'] = 'Sistema';
$string['context_category'] = 'Categoría';

// Errors
$string['error_registry_page_create'] = 'Error al crear la página de registro';
$string['error_registry_page_not_found'] = 'Página de registro no encontrada';
$string['error_registry_page_can_be_edited'] = 'La página de registro no se puede editar';
$string['error_order_not_found'] = 'Pedido no encontrado';
$string['error_order_can_not_validate'] = 'El pedido no puede ser validado';
$string['error_order_can_not_validate_by_error'] = '<br>- {$a}';
$string['error_order_can_not_cancel'] = 'El pedido no puede ser cancelado';
$string['error_order_can_not_cancel_by_error'] = '<br>- {$a}';
$string['error_registry_page_is_enabled'] = 'La página de registro está habilitada';
$string['error_registry_page_has_orders'] = 'La página de registro tiene uno o más pedidos asociados';
$string['error_registry_page_can_not_delete'] = 'La página de registro no se puede borrar';
$string['error_slug_already_exists'] = 'El slug ya existe';
$string['error_order_noaccess'] = 'Usted no tiene acceso a éste pedido';


$string['confirmation_cancel'] = '¿Estás seguro de que quieres cancelar el pedido {$a->uniqueid}?';
$string['confirmation_validate'] = '¿Estás seguro de que quieres validar el pedido {$a->uniqueid}?';
$string['confirmation_rp_delete'] = '¿Estás seguro de que quieres borrar la página de registro "{$a->slug}"?';

$string['order_cancelled'] = 'El pedido ha sido cancelado';
$string['order_validated'] = 'El pedido ha sido validado';
$string['registry_page_deleted'] = 'La página de registro ha sido borrada';

$string['action_validate_course'] = 'El usuario <strong>{$a->user_fullname} ({$a->user_email})</strong><br>
será matriculado en el curso <strong>"[{$a->course_shortname}] {$a->course_fullname}"</strong><br>
desde <strong>{$a->fromtime}</strong> hasta <strong>{$a->untiltime}</strong>';
$string['action_validate_referral'] = 'El usuario <strong>{$a->user_firstname} {$a->user_lastname} ({$a->user_email})</strong><br>
será creado y matriculado en el curso <strong>"[{$a->course_shortname}] {$a->course_fullname}"</strong><br>
desde <strong>{$a->fromtime}</strong> hasta <strong>{$a->untiltime}</strong>';
$string['action_validate_cohort'] = 'El usuario <strong>{$a->user_fullname} ({$a->user_email})</strong><br>
se le añadirá a la cohorte <strong>"[{$a->cohort_category}] {$a->cohort_name}"</strong>';

$string['validate_actions_intro'] = 'Si valida este pedido, entonces se ejecutarán las siguiente acciones:';
$string['validate_no_actions'] = 'No hay acciones a ejecutar';

