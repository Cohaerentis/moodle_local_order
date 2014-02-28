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
 * ORDER user library.
 *
 * @package   order
 * @copyright 2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('LOCAL_ORDER_INTERNAL') || die();

require_once($CFG->libdir . '/tablelib.php');

/**
 * Admin orders list
 *
 * @copyright   2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class local_order_user_orders_table extends table_sql {

    /**
     * Sets up the table_sql parameters
     *
     * @param string $tableid Unique id for this table in the page
     * @param string $userid User ID, optional (pending orders only for this UserID)
     */
    public function __construct($tableid, $userid = null, $status = null) {
        parent::__construct($tableid);
        $this->set_attribute('class', 'orderlist generaltable generalbox');
        $this->filter = array();
        if (!isset($this->sql)) {
            $this->sql = new stdClass();
        }
        $this->sql->fields = 'o.id, o.uniqueid, o.userid, o.createdate, o.finalcost, o.currency, o.paymode, o.status';
        $this->sql->from = '{local_order} o';
        $this->sql->where = 'o.userid = :userid AND o.status = :status';
        $this->sql->params = array('userid' => $userid,
                                   'status' => $status);

        $this->define_columns(array('uniqueid', 'createdate', 'finalcost', 'paymode', 'actions'));
        $this->define_headers(array(get_string('col_uniqueid', 'local_order'),
                                    get_string('col_createdate', 'local_order'),
                                    get_string('col_finalcost', 'local_order'),
                                    get_string('col_paymode', 'local_order'),
                                    get_string('col_actions', 'local_order')));
        $this->no_sorting('actions');
        $this->collapsible(false);
        $this->sortable(true, 'createdate', SORT_ASC);
    }

    /**
     * Generate createdate cell
     *
     * @param stdClass $row row data
     * @return string HTML for the column
     */
    public function col_createdate($row) {
        return date('d/m/Y H:i:s', $row->createdate);
    }

    /**
     * Generate finalcost cell
     *
     * @param stdClass $row row data
     * @return string HTML for the column
     */
    public function col_finalcost($row) {
        return local_order::_cost_show($row->finalcost, $row->currency);
    }

    /**
     * Generate paymode cell
     *
     * @param stdClass $row row data
     * @return string HTML for the column
     */
    public function col_paymode($row) {
        return local_order::_paymode_show($row->paymode);
    }

    /**
     * Generate actions cell
     *
     * @param stdClass $row row data
     * @return string HTML for the column
     */
    public function col_actions($row) {
        $actions = '';
        if ($row->status == local_order::STATUS_PAID) {
            $returnlink = new moodle_url('/local/order/user/orders_validated.php');
        } else {
            $returnlink = new moodle_url('/local/order/user/orders_pending.php');
        }

        $dlink = new moodle_url('/local/order/user/order_details.php');
        $dlink->params( array('orderid' => $row->id, 'return' => $returnlink));
        $details = html_writer::link($dlink, get_string('link_user_order_details', 'local_order'), array('class' => 'detailslink'));

        $actions .= $details;

        if ( ($row->status != local_order::STATUS_PAID) &&
             ($row->status != local_order::STATUS_CANCELLED) ){
            $clink = new moodle_url('/local/order/user/order_cancel.php');
            $clink->params( array('orderid' => $row->id, 'return' => $returnlink));
            $cancel = html_writer::link($clink, get_string('link_user_order_cancel', 'local_order'), array('class' => 'cancellink'));

            $actions .= ' - ' . $cancel;
        }

        return $actions;
    }

}
