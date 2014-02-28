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
 * ADMIN : Orders management.
 *
 * @package   order
 * @copyright 2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->dirroot . '/local/order/registry/lib.php');
require_once($CFG->dirroot . '/local/order/admin/lib.php');

local_order_require_capability('manage');
admin_externalpage_setup('local_order_manage_orders');

$uniqueid 	= optional_param('uniqueid', '', PARAM_NOTAGS);
$status 	= optional_param('status', '', PARAM_INT);
$email 		= optional_param('email', '', PARAM_NOTAGS);
$download 	= optional_param('download', '', PARAM_ALPHA);

if (empty($download)) {
	echo $OUTPUT->header();
	echo $OUTPUT->box_start('', 'local_order');
	echo $OUTPUT->heading(get_string('heading_admin_orders', 'local_order'));

	$pageurl = new moodle_url('/local/order/admin/orders.php', array(
        'uniqueid'  => $uniqueid,
        'status'    => $status,
        'email'     => $email));

?>

	<form action="" method="get" class="filter">
	    <div class="label"><label for="uniqueid"><?php print_string('search_uniqueid', 'local_order'); ?></label></div>
	    <div class="field"><input type="text" name="uniqueid" id="uniqueid" value="<?php echo $uniqueid; ?>"></div>
	    <div class="clearer"></div>
	    <div class="label"><label for="email"><?php print_string('search_email', 'local_order'); ?></label></div>
	    <div class="field"><input type="text" name="email" id="email" value="<?php echo $email; ?>"></div>
	    <div class="clearer"></div>
	    <div class="label"><label for="status"><?php print_string('search_status', 'local_order'); ?></label></div>
	    <div class="field"><select name="status" id="status">
	        <option value="0" <?php if (empty($status)) echo 'selected="selected"'; ?>><?php print_string('status_all', 'local_order'); ?></option>
	        <option value="2" <?php if ($status == 2) echo 'selected="selected"'; ?>><?php print_string('status_prepared', 'local_order'); ?></option>
	        <option value="3" <?php if ($status == 3) echo 'selected="selected"'; ?>><?php print_string('status_pending', 'local_order'); ?></option>
	        <option value="4" <?php if ($status == 4) echo 'selected="selected"'; ?>><?php print_string('status_paid', 'local_order'); ?></option>
	        <option value="5" <?php if ($status == 5) echo 'selected="selected"'; ?>><?php print_string('status_cancelled', 'local_order'); ?></option>
	    </select></div>
	    <div class="clearer"></div>
	    <div class="label"></div>
	    <div class="field"><input type="submit" value="<?php print_string('btn_filter', 'local_order'); ?>"></div>
	</form>

<?php
}
$table = new local_order_admin_orders_table('orders', null, $uniqueid, $status, $email);
$table->define_baseurl($pageurl);
$table->is_downloading($download, 'orders', 'orders');
$table->out(100, true);

if (empty($download)) {
	echo $OUTPUT->box_end();
	echo $OUTPUT->footer();
}