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

require_once(LOCAL_ORDER_DIRROOT . '/admin/registry_page_add_form.php');

$return     = optional_param('return', '/', PARAM_URL);

/// Print the header
if (empty($rpid)) {
    $addform = new registry_page_add_form(null, array('return' => $return));
    if ($rpbasic = $addform->get_data()) {
        $rp = local_order_rp::create($rpbasic->cohortid, $rpbasic->theme, $rpbasic->slug, '');
        if (!empty($rp)) {
            $editlink = new moodle_url('/local/order/admin/registry_pages.php', array(
                'action' => 'edit',
                'rpid'   => $rp->entry->id,
                'return' => $return));
            redirect($editlink);
        } else {
            redirect($return, get_string('error_registry_page_create', 'local_order'));
        }
    } else {
        echo $OUTPUT->header();
        echo $OUTPUT->heading(get_string('heading_admin_registry_page_add', 'local_order'));
        $addform->display();
    }
} else {
    $rp = local_order_rp::get_by_id($rpid);
    if (!empty($rp)) {
        $themeform = $rp->theme->path . '/forms/registry_page_edit_form.php';
        if (file_exists($themeform)) {
            require_once($themeform);
        } else {
            redirect($return, get_string('error_registry_page_can_be_edited', 'local_order'));
        }
    } else {
        redirect($return, get_string('error_registry_page_not_found', 'local_order'));
    }

    $editform = new registry_page_edit_form(null, array('return' => $return, 'rp' => $rp));
    if (!empty($rp->config)) {
        $data = $editform->decode($rp->config);
        $editform->set_data($data);
    }

    if ($editform->is_cancelled()) {
        redirect($return);
    } else if ($editform->is_submitted() && ($newdata = $editform->get_data())) {
        $rp->config = $editform->encode($newdata);
        $rp->update();
        redirect($return);
    } else {
        echo $OUTPUT->header();
        echo $OUTPUT->heading(get_string('heading_admin_registry_page_edit', 'local_order'));
        $editform->display();
    }

}

echo $OUTPUT->footer();

