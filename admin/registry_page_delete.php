<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * ADMIN : Registry pages management.
 *
 * @package   order
 * @copyright 2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('LOCAL_ORDER_RP_INTERNAL')) die('');    ///  It must be included from a Registry index page

$return     = optional_param('return', '/', PARAM_URL);
$confirm    = optional_param('confirm', 0, PARAM_BOOL);

$returnurl = new moodle_url($return);
$rp = local_order_rp::get_by_id($rpid);
if (empty($rp)) redirect($returnurl, get_string('error_registry_page_not_found', 'local_order'));
if ($rp->entry->status != local_order_rp::STATUS_DISABLED)
    redirect($returnurl, get_string('error_registry_page_is_enabled', 'local_order'));
if (local_order::registry_page_has_orders($rp))
    redirect($returnurl, get_string('error_registry_page_has_orders', 'local_order'));

$confirmurl = new moodle_url('/local/order/admin/registry_pages.php',
                          array('action'  => 'delete',
                                'rpid'    => $rpid,
                                'return'  => $return,
                                'confirm' => 1));

if ($confirm and confirm_sesskey()) {
    if ($rp->delete()) {
        redirect($returnurl, get_string('registry_page_deleted', 'local_order'));
    } else {
        redirect($returnurl, get_string('error_registry_page_can_not_delete', 'local_order'));
    }

} else {
    /// Print the header
    echo $OUTPUT->header();
    echo $OUTPUT->box_start('', 'local_order');
    echo $OUTPUT->heading(get_string('heading_admin_registry_page_delete', 'local_order'));

    $formcontinue = new single_button($confirmurl, get_string('yes'));
    $formcancel = new single_button($returnurl, get_string('no'), 'get');
    $strorder = new StdClass();
    $strorder->slug = $rp->entry->slug;
    echo $OUTPUT->confirm(get_string('confirmation_rp_delete', 'local_order', $strorder), $formcontinue, $formcancel);

    echo $OUTPUT->box_end();
    echo $OUTPUT->footer();
}
