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
 * USER : Validated orders list.
 *
 * @package   order
 * @copyright 2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../../config.php');
require_once($CFG->dirroot . '/local/order/registry/lib.php');
require_once($CFG->dirroot . '/local/order/user/lib.php');

require_login(SITEID, false);

$PAGE->set_context(context_user::instance($USER->id));
$PAGE->set_pagelayout('standard');
$pageurl = new moodle_url('/local/order/user/orders_validated.php');
$PAGE->set_url($pageurl);

$PAGE->set_title(get_string('title_user_validated_orders', 'local_order'));
$PAGE->set_heading(get_string('heading_user_validated_orders', 'local_order'));

echo $OUTPUT->header();
echo $OUTPUT->box_start('', 'local_order');
echo $OUTPUT->heading(get_string('heading_user_validated_orders', 'local_order'));

$table = new local_order_user_orders_table('orders', $USER->id, local_order::STATUS_PAID);
$table->define_baseurl($pageurl);
$table->out(10, true);

echo $OUTPUT->box_end();
echo $OUTPUT->footer();
