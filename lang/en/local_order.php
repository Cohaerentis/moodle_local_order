<?php
defined('MOODLE_INTERNAL') || die();

$string['order'] = 'Order';
$string['pluginname'] = 'Order';

// Capabilities strings
$string['nocap_view'] = 'You do not have "local/order:view" capability, needed to perform this operation.';
$string['nocap_manage'] = 'You do not have "local/order:manage" capability, needed to perform this operation.';

// Registry pages default strings
$string['rp_notfound'] = 'Registry page not found, please review your bookmarks';
$string['rp_theme_notfound'] = 'Theme "{$a}" not found';
$string['rp_theme_noindex'] = 'Theme "{$a}" has no "index.php" file';
$string['rp_theme_bad_sesskey'] = 'Session is expired or invalid';

$string['order_promotional_discount'] = 'Promotional discount';

// Navigation menu labels
$string['menu_admin_orders'] = 'Orders';
$string['menu_admin_manage_registry_pages'] = 'Registry pages';
$string['menu_admin_manage_orders'] = 'Manage orders';

$string['menu_user_orders'] = 'Orders';
$string['menu_user_pending_orders'] = 'Pending orders';
$string['menu_user_validated_orders'] = 'Paid orders';

// Order cost
$string['cost_free'] = 'Free';
$string['cost_us_dollar'] = '$USD %.2f';
$string['cost_ca_dollar'] = '$CAD %.2f';
$string['cost_euro'] = '%.2f €';

// Order paymode
$string['paymode_unknown'] = 'Unknown';
$string['paymode_paypal'] = 'Paypal';
$string['paymode_banktransfer'] = 'Bank transfer';
$string['paymode_creditcard'] = 'Credit Card';
$string['paymode_westernunion'] = 'Western Union';

// Order status
$string['status_all'] = 'All';
$string['status_created'] = 'Created';
$string['status_prepared'] = 'Prepared';
$string['status_pending'] = 'Pending';
$string['status_paid'] = 'Paid';
$string['status_cancelled'] = 'Cancelled';

// Registry page status
$string['rp_status_all'] = 'All';
$string['rp_status_enabled'] = 'Enabled';
$string['rp_status_disabled'] = 'Disabled';

// Item types
$string['itemtype_cohort'] = 'Cohort';
$string['itemtype_discount'] = 'Discount';
$string['itemtype_paymode_surcharge'] = 'Paymode surchage';
$string['itemtype_paymode_discount'] = 'Paymode discount';


// Admin Pages
$string['heading_admin_registry_pages'] = 'Registry pages';
$string['heading_admin_registry_page_edit'] = 'Edit registry page';
$string['heading_admin_registry_page_add'] = 'Add a new registry page';
$string['heading_admin_registry_page_delete'] = 'Delete this registry page';
$string['heading_admin_orders'] = 'Orders';
$string['title_admin_order_details'] = 'Order details';
$string['heading_admin_order_details'] = 'Order details';
$string['heading_admin_order_items'] = 'Order items';
$string['title_admin_order_validate'] = 'Validate order';
$string['heading_admin_order_validate'] = 'Validate order';
$string['title_admin_order_cancel'] = 'Cancel order';
$string['heading_admin_order_cancel'] = 'Cancel order';
$string['noitems'] = 'There is no items in this order';
$string['search_uniqueid'] = 'UniqueID';
$string['search_email'] = 'Email';
$string['search_status'] = 'Status';
$string['search_theme'] = 'Theme';
$string['search_slug'] = 'Slug';
$string['search_cohort'] = 'Cohort';
$string['btn_filter'] = 'Filter';
$string['link_admin_order_details'] = 'Details';
$string['link_admin_order_validate'] = 'Validate';
$string['link_admin_order_cancel'] = 'Cancel';
$string['link_admin_rp_edit'] = 'Edit';
$string['link_admin_rp_enable'] = 'Enable';
$string['link_admin_rp_disable'] = 'Disable';
$string['link_admin_rp_delete'] = 'Delete';
$string['link_admin_rp_add'] = 'Add new registry page';
$string['link_return'] = 'Return';
$string['legend_admin_registry_page_basic'] = 'Basics';
$string['lbl_slug'] = 'Slug';
$string['lbl_cohort'] = 'Cohort';
$string['lbl_theme'] = 'Theme';
$string['legend_admin_registry_page_edit_general'] = 'General';
$string['link_user_order_details'] = 'Details';
$string['link_user_order_cancel'] = 'Cancel';


$string['col_uniqueid'] = 'UniqueID';
$string['col_fullname'] = 'User';
$string['col_email'] = 'Email';
$string['col_createdate'] = 'Date';
$string['col_finalcost'] = 'Amount';
$string['col_paymode'] = 'Paymode';
$string['col_actions'] = 'Actions';
$string['col_promotional'] = 'Promotional';
$string['col_status'] = 'Status';
$string['col_itemtype'] = 'Type';
$string['col_itemname'] = 'Name';
$string['col_itemdescription'] = 'Description';
$string['col_itemcost'] = 'Cost';
$string['col_total'] = 'TOTAL';
$string['col_slug'] = 'Slug';
$string['col_theme'] = 'Theme';
$string['col_cohort'] = 'Cohort';

// User pages
$string['title_user_pending_orders'] = 'Pending orders';
$string['heading_user_pending_orders'] = 'Pending orders';
$string['title_user_validated_orders'] = 'Paid orders';
$string['heading_user_validated_orders'] = 'Paid orders';
$string['title_user_order_details'] = 'Order details';
$string['heading_user_order_details'] = 'Order details';
$string['heading_user_order_items'] = 'Order items';
$string['title_user_order_cancel'] = 'Cancel order';
$string['heading_user_order_cancel'] = 'Cancel order';

// Contexts
$string['context_unknown'] = 'N/A';
$string['context_system'] = 'System';
$string['context_category'] = 'Category';

// Errors
$string['error_registry_page_create'] = 'Error while creating registry page';
$string['error_registry_page_not_found'] = 'Registry page not found';
$string['error_registry_page_can_be_edited'] = 'Registry page is not editable';
$string['error_order_not_found'] = 'Order not found';
$string['error_order_can_not_validate'] = 'Order could not be validated';
$string['error_order_can_not_validate_by_error'] = '<br>- {$a}';
$string['error_order_can_not_cancel'] = 'Order could not be cancelled';
$string['error_order_can_not_cancel_by_error'] = '<br>- {$a}';
$string['error_registry_page_is_enabled'] = 'Registry page is enabled';
$string['error_registry_page_has_orders'] = 'Registry page has one or more orders';
$string['error_registry_page_can_not_delete'] = 'Registry page can not be deleted';
$string['error_slug_already_exists'] = 'Slug already exists';
$string['error_order_noaccess'] = 'You do not have access to this order';


$string['confirmation_cancel'] = 'Are you sure you want to cancel order {$a->uniqueid}?';
$string['confirmation_validate'] = 'Are you sure you want to validate order {$a->uniqueid}?';
$string['confirmation_rp_delete'] = 'Are you sure you want to delete registry page "{$a->slug}"?';

$string['order_cancelled'] = 'Order has been cancelled';
$string['order_validated'] = 'Order has been validated';
$string['registry_page_deleted'] = 'Registry page has been deleted';

$string['action_validate_course'] = 'User <strong>{$a->user_fullname} ({$a->user_email})</strong><br>
will be enrolled into course <strong>"[{$a->course_shortname}] {$a->course_fullname}"</strong><br>
from <strong>{$a->fromtime}</strong> to <strong>{$a->untiltime}</strong>';
$string['action_validate_referral'] = 'User <strong>{$a->user_firstname} {$a->user_lastname} ({$a->user_email})</strong><br>
will be created and enrolled into course <strong>"[{$a->course_shortname}] {$a->course_fullname}"</strong><br>
from <strong>{$a->fromtime}</strong> to <strong>{$a->untiltime}</strong>';
$string['action_validate_cohort'] = 'User <strong>{$a->user_fullname} ({$a->user_email})</strong><br>
will be added into cohort <strong>"[{$a->cohort_category}] {$a->cohort_name}"</strong>';

$string['validate_actions_intro'] = 'If you validate this order, then these actions will be performed:';
$string['validate_no_actions'] = 'There is no action to perform';

