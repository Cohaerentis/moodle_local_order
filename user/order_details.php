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
 * Displays order details
 *
 * @package     order
 * @copyright   2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../../config.php');
require_once($CFG->dirroot . '/local/order/registry/lib.php');

$orderid = required_param('orderid', PARAM_INT);
$return  = optional_param('return', '/', PARAM_URL);

require_login(SITEID, false);

$returnurl = new moodle_url($return);
$order = local_order::read($orderid);

if (empty($order->user) || !empty($order->user->deleted) || empty($order->user->confirmed)) {
    redirect($returnurl, $this->get_string('error_order_not_found'));
}

if ($order->user->id != $USER->id) {
    redirect($returnurl, $this->get_string('error_order_noaccess'));
}

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');
$pageurl = new moodle_url('/local/order/user/order_details.php',
                          array('orderid' => $orderid,
                                'return'  => $return));
$PAGE->set_url($pageurl);

$PAGE->set_title(get_string('title_user_order_details', 'local_order'));
$PAGE->set_heading(get_string('heading_user_order_details', 'local_order'));

echo $OUTPUT->header();
echo $OUTPUT->box_start('', 'local_order');
echo $OUTPUT->heading(get_string('heading_user_order_details', 'local_order'));
echo $OUTPUT->box_start('', 'order-details');
?>

<table>
    <tr>
        <td class='label'><?php print_string('col_uniqueid', 'local_order'); ?></td>
        <td class='value'><?php echo $order->entry->uniqueid; ?></td>
    </tr>
    <tr>
        <td class='label'><?php print_string('col_createdate', 'local_order'); ?></td>
        <td class='value'><?php echo date('d/m/Y H:i:s', $order->entry->createdate); ?></td>
    </tr>
    <tr>
        <td class='label'><?php print_string('col_paymode', 'local_order'); ?></td>
        <td class='value'><?php echo $order->paymode_show(); ?></td>
    </tr>
    <tr>
        <td class='label'><?php print_string('col_promotional', 'local_order'); ?></td>
        <td class='value'><?php $promo = !empty($order->entry->promotional) ? $order->entry->promotional : '-'; echo $promo; ?></td>
    </tr>
    <tr>
        <td class='label'><?php print_string('col_status', 'local_order'); ?></td>
        <td class='value'><?php echo $order->status_show(); ?></td>
    </tr>
</table>

<?php
echo $OUTPUT->box_end();
echo $OUTPUT->heading(get_string('heading_user_order_items', 'local_order'));
echo $OUTPUT->box_start('', 'order-items');
?>

<table>
    <tr>
        <th class="item-type"><?php print_string('col_itemtype', 'local_order'); ?></th>
        <th class="item-name"><?php print_string('col_itemname', 'local_order'); ?></th>
        <th class="item-description"><?php print_string('col_itemdescription', 'local_order'); ?></th>
        <th class="item-cost"><?php print_string('col_itemcost', 'local_order'); ?></th>
    </tr>
<?php if (!empty($order->items)) : ?>
    <?php foreach($order->items as $item) : ?>
    <tr>
        <td class="item-type"><?php print_string('itemtype_' . $item->entry->itemtype, 'local_order'); ?></td>
        <td class="item-name"><?php echo $item->entry->name; ?></td>
        <td class="item-description"><?php echo $item->entry->description; ?></td>
        <td class="item-cost"><?php echo $item->cost_show(); ?></td>
    </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td class="item-none" colspan="4"><?php print_string('noitems', 'local_order'); ?></td>
    </tr>
<?php endif; ?>
    <tr>
        <td class="total-label" colspan="3"><?php print_string('col_total', 'local_order'); ?></td>
        <td class="total-value"><?php echo $order->cost_show(); ?></td>
    </tr>
</table>
<?php
echo $OUTPUT->box_end();
echo $OUTPUT->box_start('', 'order-actions');

$clink = new moodle_url('/local/order/user/order_cancel.php',
                        array('orderid' => $order->entry->id,
                              'return' => $return));

$output = '';

if ( ($order->entry->status != local_order::STATUS_PAID) &&
     ($order->entry->status != local_order::STATUS_CANCELLED) ){

    if (!empty($output)) $output .= ' - ';
    $output .= html_writer::link($clink, get_string('link_user_order_cancel', 'local_order'), array('class' => 'cancellink'));
}

if (!empty($output)) $output .= ' - ';
$output .= html_writer::link($return, get_string('link_return', 'local_order'), array('class' => 'returnlink'));

echo $output;

echo $OUTPUT->box_end();
echo $OUTPUT->box_end();
echo $OUTPUT->footer();

