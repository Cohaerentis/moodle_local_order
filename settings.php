<?php

$ADMIN->add('root', new admin_category('local_order', get_string('menu_admin_orders', 'local_order')));
$ADMIN->add('local_order', new admin_externalpage('local_order_registry_pages', get_string('menu_admin_manage_registry_pages', 'local_order'),
        $CFG->wwwroot."/local/order/admin/registry_pages.php",
        'local/order:manage'));
$ADMIN->add('local_order', new admin_externalpage('local_order_manage_orders', get_string('menu_admin_manage_orders', 'local_order'),
        $CFG->wwwroot."/local/order/admin/orders.php",
        'local/order:manage'));
