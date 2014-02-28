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
 * Validate an order
 *
 * @package     order
 * @copyright   2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../../config.php');
require_once($CFG->dirroot . '/local/order/registry/lib.php');
require_once($CFG->dirroot . '/local/order/admin/lib.php');

$orderid = required_param('orderid', PARAM_INT);
$return  = optional_param('return', '/', PARAM_URL);
$confirm = optional_param('confirm', 0, PARAM_BOOL);

require_login(SITEID, false);
local_order_require_capability('manage');

$returnurl = new moodle_url($return);
$order = local_order::read($orderid);
if (empty($order)) {
    redirect($returnurl, $this->get_string('error_order_not_found'));
}

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');
$pageurl = new moodle_url('/local/order/admin/order_validate.php',
                          array('orderid' => $orderid,
                                'return'  => $return,
                                'confirm' => $confirm));
$PAGE->set_url($pageurl);

$PAGE->set_title(get_string('title_admin_order_validate', 'local_order'));
$PAGE->set_heading(get_string('heading_admin_order_validate', 'local_order'));

$confirmurl = new moodle_url('/local/order/admin/order_validate.php',
                          array('orderid' => $orderid,
                                'return'  => $return,
                                'confirm' => 1));

if ($confirm and confirm_sesskey()) {
    // Validate order
    $errors = $order->validate();
    if (empty($errors)) {
        redirect($returnurl, get_string('order_validated', 'local_order'));
    } else {
        $errormsg = $this->get_string('error_order_can_not_validate');
        foreach ($errors as $error) {
            $errormsg .= $this->get_string('error_order_can_not_validate_by_error', $error);
        }
        redirect($returnurl, $errormsg);
    }

} else {
    // Ask for comfirmation
    echo $OUTPUT->header();
    echo $OUTPUT->box_start('', 'local_order');
    echo $OUTPUT->heading(get_string('heading_admin_order_validate', 'local_order'));

    echo $OUTPUT->box_start('', 'order-validate-actions');
    $actions = $order->validate_show();
?>

<?php if (!empty($actions)) : ?>
<p class="order-validate-actions-intro">
    <?php print_string('validate_actions_intro', 'local_order'); ?>
</p>
<ul class="order-validate-actions-list">
<?php foreach ($actions as $action) : ?>
    <li><?php echo $action; ?></li>
<?php endforeach; ?>
</ul>
<?php else : ?>

<p class="order-validate-no-actions"><?php print_string('validate_no_actions', 'local_order'); ?></p>
<?php endif; ?>

<?php
    echo $OUTPUT->box_end();
    $formcontinue = new single_button($confirmurl, get_string('yes'));
    $formcancel = new single_button($returnurl, get_string('no'), 'get');
    $strorder = new StdClass();
    $strorder->uniqueid = $order->entry->uniqueid;
    echo $OUTPUT->confirm(get_string('confirmation_validate', 'local_order', $strorder), $formcontinue, $formcancel);

    echo $OUTPUT->box_end();
    echo $OUTPUT->footer();
}

