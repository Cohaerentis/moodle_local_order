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
 * ORDER local library. Moodle pages classes and functions
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
class local_order_admin_orders_table extends table_sql {

    /**
     * Sets up the table_sql parameters
     *
     * @param string $tableid Unique id for this table in the page
     * @param string $userid User ID, optional (pending orders only for this UserID)
     */
    public function __construct($tableid, $userid = null, $uniqueid = null, $status = null, $email = null) {
        parent::__construct($tableid);
        $this->set_attribute('class', 'orderlist generaltable generalbox');
        $this->filter = array();
        if (!isset($this->sql)) {
            $this->sql = new stdClass();
        }
        $this->sql->fields = 'o.id, o.uniqueid, u.firstname, u.lastname, u.email, o.userid, o.createdate, o.finalcost, o.currency, o.paymode, o.status';
        $this->sql->from = '{local_order} o
                            JOIN {user} u ON u.id = o.userid';
        $this->sql->where = 'u.deleted = :deleted AND u.confirmed = :confirmed';
        $this->sql->params = array('deleted' => 0,
                                   'confirmed' => 1);

        if (!empty($userid)) {
            $this->sql->where .= ' AND u.id = :userid';
            $this->sql->params['userid'] = $userid;
            $this->filter['userid'] = $userid;
        }
        if (!empty($uniqueid)) {
            $this->sql->where .= ' AND o.uniqueid LIKE :uniqueid';
            $this->sql->params['uniqueid'] = '%' . $uniqueid . '%';
            $this->filter['uniqueid'] = $uniqueid;
        }
        if (!empty($status)) {
            $this->sql->where .= ' AND o.status = :status';
            $this->sql->params['status'] = $status;
            $this->filter['status'] = $status;
        }
        if (!empty($email)) {
            $this->sql->where .= ' AND u.email LIKE :email';
            $this->sql->params['email'] = '%' . $email . '%';
            $this->filter['email'] = $email;
        }

        $this->define_columns(array('uniqueid', 'fullname', 'email', 'createdate', 'finalcost', 'paymode', 'status', 'actions'));
        $this->define_headers(array(get_string('col_uniqueid', 'local_order'),
                                    get_string('col_fullname', 'local_order'),
                                    get_string('col_email', 'local_order'),
                                    get_string('col_createdate', 'local_order'),
                                    get_string('col_finalcost', 'local_order'),
                                    get_string('col_paymode', 'local_order'),
                                    get_string('col_status', 'local_order'),
                                    get_string('col_actions', 'local_order')));
        $this->no_sorting('actions');
        $this->collapsible(false);
        $this->sortable(true, 'createdate', SORT_ASC);
    }

    /**
     * Generate fullname cell
     *
     * @param stdClass $row row data
     * @return string HTML for the column
     */
    public function col_fullname($row) {
        if (!$this->is_downloading()) {
            $link = new moodle_url('/user/view.php');
            $link->params( array('id' => $row->userid,
                                 'course' => SITEID));

            return html_writer::link($link, fullname($row), array('class' => 'userlink'));
        } else {
            return fullname($row);
        }
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

    public function col_status($row) {
        return local_order::_status_show($row->status);
    }

    /**
     * Generate actions cell
     *
     * @param stdClass $row row data
     * @return string HTML for the column
     */
    public function col_actions($row) {
        $actions = '';
        $returnlink = new moodle_url('/local/order/admin/orders.php', $this->filter);

        if (!$this->is_downloading()) {
            $dlink = new moodle_url('/local/order/admin/order_details.php');
            $dlink->params( array('orderid' => $row->id, 'return' => $returnlink));
            $details = html_writer::link($dlink, get_string('link_admin_order_details', 'local_order'), array('class' => 'detailslink'));

            $actions .= $details;

            if ($row->status == local_order::STATUS_PENDING) {
                $vlink = new moodle_url('/local/order/admin/order_validate.php');
                $vlink->params( array('orderid' => $row->id, 'return' => $returnlink));
                $validate = html_writer::link($vlink, get_string('link_admin_order_validate', 'local_order'), array('class' => 'validatelink'));

                $actions .= ' - ' . $validate;
            }

            if ( ($row->status != local_order::STATUS_PAID) &&
                 ($row->status != local_order::STATUS_CANCELLED) ){
                $clink = new moodle_url('/local/order/admin/order_cancel.php');
                $clink->params( array('orderid' => $row->id, 'return' => $returnlink));
                $cancel = html_writer::link($clink, get_string('link_admin_order_cancel', 'local_order'), array('class' => 'cancellink'));

                $actions .= ' - ' . $cancel;
            }
        }

        return $actions;
    }

}

/**
 * Admin registry pages list
 *
 * @copyright   2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class local_order_admin_registry_pages_table extends table_sql {

    /**
     * Sets up the table_sql parameters
     *
     * @param string $tableid Unique id for this table in the page
     * @param string $userid User ID, optional (pending orders only for this UserID)
     */
    public function __construct($tableid, $theme = null, $slug = null, $status = null, $cohort = null) {
        parent::__construct($tableid);
        $this->set_attribute('class', 'registrypagelist generaltable generalbox');
        $this->filter = array();
        if (!isset($this->sql)) {
            $this->sql = new stdClass();
        }
        $this->sql->fields = 'rp.id, rp.theme, rp.slug, rp.status, c.id as cohortid, c.name as cohortname';
        $this->sql->from = '{local_order_registry} rp
                            JOIN {cohort} c ON c.id = rp.cohortid';
        $this->sql->where = 'rp.id > :id';
        $this->sql->params = array('id' => 0);

        if (!empty($theme)) {
            $this->sql->where .= ' AND rp.theme LIKE :theme';
            $this->sql->params['theme'] = '%' . $theme . '%';
            $this->filter['theme'] = $theme;
        }
        if (!empty($slug)) {
            $this->sql->where .= ' AND rp.slug LIKE :slug';
            $this->sql->params['slug'] = '%' . $slug . '%';
            $this->filter['slug'] = $slug;
        }
        if (!empty($status) && (($status === 'enabled') || ($status === 'disabled')) ) {
            $this->sql->where .= ' AND rp.status = :status';
            $this->sql->params['status'] = ($status === 'enabled') ? 1 : 0;
            $this->filter['status'] = $status;
        }
        if (!empty($email)) {
            $this->sql->where .= ' AND c.name LIKE :cohort';
            $this->sql->params['cohort'] = '%' . $cohort . '%';
            $this->filter['cohort'] = $cohort;
        }

        $this->define_columns(array('slug', 'theme', 'cohort', 'actions'));
        $this->define_headers(array(get_string('col_slug', 'local_order'),
                                    get_string('col_theme', 'local_order'),
                                    get_string('col_cohort', 'local_order'),
                                    get_string('col_actions', 'local_order')));
        $this->no_sorting('actions');
        $this->collapsible(false);
        $this->sortable(true, 'theme', SORT_ASC);
    }

    /**
     * Generate slug cell
     *
     * @param stdClass $row row data
     * @return string HTML for the column
     */
    public function col_slug($row) {
        if (!$this->is_downloading() && !empty($row->status)) {
            $link = new moodle_url('/' . LOCAL_ORDER_RP_URIBASE . '/' . $row->slug);

            return html_writer::link($link, $row->slug, array('class' => 'sluglink'));
        } else {
            return $row->slug;
        }
    }

    /**
     * Generate createdate cell
     *
     * @param stdClass $row row data
     * @return string HTML for the column
     */
    public function col_cohort($row) {
        if (!$this->is_downloading()) {
            $link = new moodle_url('/cohort/assign.php', array('id' => $row->cohortid));
            return html_writer::link($link, $row->cohortname, array('class' => 'cohortlink'));
        } else {
            return $row->cohortname;
        }
    }

    /**
     * Generate actions cell
     *
     * @param stdClass $row row data
     * @return string HTML for the column
     */
    public function col_actions($row) {
        $actions = '';
        $baseurl = '/local/order/admin/registry_pages.php';
        $returnlink = new moodle_url($baseurl, $this->filter);

        if (!$this->is_downloading()) {
            $editlink = new moodle_url($baseurl, array('action' => 'edit', 'rpid' => $row->id, 'return' => $returnlink));
            $edit = html_writer::link($editlink, get_string('link_admin_rp_edit', 'local_order'), array('class' => 'editlink'));

            $actions .= $edit;

            if ($row->status == 0) {
                $enablelink = new moodle_url($baseurl, array('action' => 'enable', 'rpid' => $row->id, 'return' => $returnlink));
                $enable = html_writer::link($enablelink, get_string('link_admin_rp_enable', 'local_order'), array('class' => 'enablelink'));

                $actions .= ' - ' . $enable;

                $deletelink = new moodle_url($baseurl, array('action' => 'delete', 'rpid' => $row->id, 'return' => $returnlink));
                $delete = html_writer::link($deletelink, get_string('link_admin_rp_delete', 'local_order'), array('class' => 'deletelink'));

                $actions .= ' - ' . $delete;

            } else {
                $disablelink = new moodle_url($baseurl, array('action' => 'disable', 'rpid' => $row->id, 'return' => $returnlink));
                $disable = html_writer::link($disablelink, get_string('link_admin_rp_disable', 'local_order'), array('class' => 'disablelink'));

                $actions .= ' - ' . $disable;

            }

        }

        return $actions;
    }
}

