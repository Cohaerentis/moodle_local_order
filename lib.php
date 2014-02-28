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
 * ORDER interface library
 *
 * @package   order
 * @copyright 2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();    ///  It must be included after moodle config.php

require_once($CFG->dirroot . '/user/editlib.php');
require_once($CFG->dirroot . '/user/profile/lib.php');
require_once($CFG->dirroot . '/tag/lib.php');
require_once($CFG->dirroot . '/cohort/lib.php');

define('LOCAL_ORDER_INTERNAL', 'LocalOrder');
define('LOCAL_ORDER_DIRROOT',  $CFG->dirroot . '/local/order');
define('LOCAL_ORDER_WWWROOT',  $CFG->wwwroot . '/local/order');

define('LOCAL_ORDER_RP_BASE',     'registry');
define('LOCAL_ORDER_RP_URIBASE',  'local/order/signin');

require_once(LOCAL_ORDER_DIRROOT . '/lib/MCAPI.class.php');

/// Access API ////////////////////////////////////////////////////////

/**
 * Determines whether the current user can access to manage orders
 *
 * @return bool true if user can access logs
 */
function local_order_can_manage() {
    $context = context_system::instance();

    if (has_capability('local/order:manage', $context)) {
        return true;
    }

    return false;
}

/**
 * Determines whether the current user can access to manage orders
 *
 * @return bool true if user can access logs
 */
function local_order_can_view() {
    $context = context_system::instance();

    if (has_capability('local/order:view', $context) ||
        has_capability('local/order:manage', $context)) {
        // if user has the manage permission then is allowed to view orders
        return true;
    }

    return false;
}

/**
 * A require_capability() like function for this module.
 *
 * As we can't use capabilties alone this emulates the acceslib function to prevent having to do
 * it in ever file.
 */
function local_order_require_capability($cap = 'manage') {
    $cf = 'local_order_can_' . $cap;
    if (!function_exists($cf) || !is_callable($cf) || !call_user_func($cf)) {
        print_error('nopermissions', 'error', '',  get_string('nocap_' . $cap, 'local_order'));
        die;
    }
}

/// Navigation API ////////////////////////////////////////////////////

/**
 * Puts ORDER into the global navigation tree.
 *
 * @param global_navigation $navigation
 */

function local_order_extends_navigation(global_navigation $navigation) {
    return;
}

function local_order_extends_settings_navigation(settings_navigation $settingsnav, $context) {
   global $PAGE;

   if ($settingnode = $settingsnav->find('usercurrentsettings', navigation_node::TYPE_CONTAINER)) {
        $orders = $settingnode->add(get_string('menu_user_orders', 'local_order'), null, navigation_node::TYPE_CONTAINER);

        $url = new moodle_url('/local/order/user/orders_pending.php');
        $mypending = $orders->add(get_string('menu_user_pending_orders', 'local_order'), $url, navigation_node::TYPE_SETTING);
        if ($PAGE->url->compare($url, URL_MATCH_BASE)) {
            $mypending->make_active();
        }

        $url = new moodle_url('/local/order/user/orders_validated.php');
        $myvalidated = $orders->add(get_string('menu_user_validated_orders', 'local_order'), $url, navigation_node::TYPE_SETTING);
        if ($PAGE->url->compare($url, URL_MATCH_BASE)) {
            $myvalidated->make_active();
        }
    }
}

function local_order_cohorts_list() {
    global $DB;

    $cohorts = array();
    $sql  = 'SELECT c.id, ctx.id as ctxid, ctx.contextlevel, ctx.instanceid, c.name, c.description
             FROM {cohort} as c
             JOIN {context} as ctx ON ctx.id = c.contextid';
    $items = $DB->get_records_sql($sql);
    if (!empty($items)) {
        foreach($items as $item) {
            $name = local_order_cohort_category($item->ctxid, $item->contextlevel, $item->instanceid);
            $name .= " - $item->name";
            $cohorts[$item->id] = $name;
        }
    }
    return $cohorts;
}

function local_order_cohort_category($contextid, $contextlevel = 0, $instanceid = 0) {
    global $DB;

    $category = get_string('context_unknown', 'local_order');
    $instanceid = 0;
    if (empty($contexlevel)) {
        $context = $DB->get_record('context', array('id' => $contextid));
        if (!empty($context->contextlevel)) {
            $contextlevel = $context->contextlevel;
            $instanceid = $context->instanceid;
        } else {
            $contextlevel = CONTEXT_SYSTEM;
        }
    }

    switch ($contextlevel) {
        case CONTEXT_SYSTEM:
            $category = get_string('context_system', 'local_order');
            break;
        case CONTEXT_COURSECAT:
            $cc = $DB->get_record('course_categories', array('id' => $instanceid));
            $category = get_string('context_category', 'local_order') . ': ' . $cc->name;
            break;
    }

    return $category;
}

/// COMMON LIB ////////////////////////////////////////////////////////

class local_order {
    const DB_TABLE                  = 'local_order';

    const PAYMODE_FREE              = 0;
    const PAYMODE_PAYPAL            = 1;
    const PAYMODE_CREDITCARD        = 2;
    const PAYMODE_BANKTRANSFER      = 3;
    const PAYMODE_WESTERNUNION      = 4;

    const STATUS_UNKNOWN            = 0;
    const STATUS_CREATED            = 1;
    const STATUS_PREPARED           = 2;
    const STATUS_PENDING            = 3;
    const STATUS_PAID               = 4;
    const STATUS_CANCELLED          = 5;

    const CURRENCY_US_DOLLAR        = 'USD';
    const CURRENCY_CA_DOLLAR        = 'CAD';
    const CURRENCY_EURO             = 'EUR';

    const PREFIX_DEFAULT            = 'GENERAL';
    const COST_PRECISION            = 2;

    public $entry          = null;
    public $config         = null;
    public $rp             = null;
    public $user           = null;
    public $cohort         = null;
    public $items          = array();

    public function __construct($entry) {
        $this->entry = $entry;
        if (!empty($entry->metadata)) $this->config = json_decode($entry->metadata);
    }

    public static function create($userid, &$rp) {
        global $DB;

        if (empty($userid) || empty($rp->entry->id) ||
            empty($rp->entry->cohortid)) return false;

        // 1. Create order
        $entry              = new stdClass();
        $entry->userid      = $userid;
        $entry->registryid  = $rp->entry->id;
        $entry->cohortid    = $rp->entry->cohortid;
        $entry->status      = self::STATUS_CREATED;
        $entry->createdate  = time();
        $order_cost         = $rp->order_cost_get();

        $order = new self($entry);

        $order->cohort = $DB->get_record('cohort', array('id' => $rp->entry->cohortid));
        if (empty($order->cohort)) return false;

        $order->user = $DB->get_record('user', array('id' => $userid));
        if (empty($order->user)) return false;

        $order->rp =& $rp;

        // 2 Save order in DB
        if (!$order->save()) return false;

        // 3. Create first order item
        $name           = $rp->order_name_get();
        $description    = $rp->order_description_get();
        $item           = local_order_item::create($order,
                                                   $name, $description,
                                                   'cohort', $order_cost);
        $item->order_entry = $order->entry;

        // 3.1 Save item in DB
        if (!$item->save()) return false;
        $order->items[$item->entry->id] = $item;

        // 4. Mark order as prepared for user confirmation
        $order_prefix = $rp->order_prefix_get();
        $order->entry->uniqueid = (!empty($order_prefix)) ?
            $order_prefix        . '-' . $order->entry->id :
            self::PREFIX_DEFAULT . '-' . $order->entry->id;
        $order->entry->cost      = $order_cost;
        $order->entry->finalcost = $order_cost;
        $order->entry->currency  = $rp->order_currency_get();
        $order->entry->status    = self::STATUS_PREPARED;

        // 4. Update order in DB
        if (!$order->update()) return false;

        return $order;
    }

    public static function read($orderid) {
        global $DB;

        $order = false;

        if (!empty($orderid)) {
            $entry = $DB->get_record(self::DB_TABLE, array('id' => $orderid));

            if (!empty($entry)) {
                $order = new self($entry);

                // Read registry page
                $order->rp = local_order_rp::get_by_id($entry->registryid);
                if (empty($order->rp)) return false;

                // Read user
                $order->user = $DB->get_record('user', array('id' => $entry->userid));
                if (empty($order->user)) return false;

                // Read cohort
                $order->cohort = $DB->get_record('cohort', array('id' => $entry->cohortid));
                if (empty($order->cohort)) return false;

                // Read items
                $order->items = local_order_item::order_items_get($order);
            }
        }

        return $order;
    }

    public static function _cost_show($cost, $currency) {
        $html = '';
        if (!empty($cost) && ($cost != 0)) {
            switch ($currency) {
                case self::CURRENCY_US_DOLLAR:
                    $html .= sprintf(get_string('cost_us_dollar', 'local_order'), $cost);
                    break;
                case self::CURRENCY_CA_DOLLAR:
                    $html .= sprintf(get_string('cost_ca_dollar', 'local_order'), $cost);
                    break;
                case self::CURRENCY_EURO:
                default:
                    $html .= sprintf(get_string('cost_euro', 'local_order'), $cost);
            }
        } else {
            $html .= get_string('cost_free', 'local_order');
        }

        return $html;
    }

    public static function _discount($cost, $code, $promotional) {
        $promo = '';
        $varvalue = '';
        $matches = '';
        if (preg_match('/([a-z0-9]*)([\-+=][0-9]+)/i', $code, $matches)) {
            $promo = $matches[1];
            if (!empty($matches[2])) $varvalue = $matches[2];
        }

        $discount = trim((string) $promotional->qty);
        // Case A : Discount is number, no matter if is negative
        if (is_numeric($discount)) {
            if ($discount < 0) $discount = $discount * (-1);
            $discount = round($discount, self::COST_PRECISION);
        // Case B : Discount is a percent, no matter if is negative
        } else if (preg_match('/^-?[0-9]+([\.,][0-9]+){0,1}%$/i', $discount)){
            $discount = trim($discount, '%');
            $discount = preg_replace('/,/', '.', $discount);
            if ($discount < 0) $discount = $discount * (-1);
            $discount = round(($cost * $discount) / 100, self::COST_PRECISION);
        // Case C : Variable, discount is included into promotional code
        // =0 : Discount 100% of the cost, then make this order free
        // +N : Make this order cost exactly N
        // -N : Discount N
        } else if ($discount == 'variable') {
            if ($varvalue === '=0') {
                $discount = $cost;
            } else if (is_numeric($varvalue)) {
                if ($varvalue > 0) $discount = $cost - $varvalue;
                if ($varvalue < 0) $discount = $varvalue * (-1);
            } else {
                return false;
            }
        } else {
           return false;
        }
        return $discount;
    }

    public static function _penalty($cost, $penalty) {
        $surcharge = trim((string) $penalty->surcharge);
        // Case A : Surcharge is number, it can be negative (discount)
        if (is_numeric($surcharge)) {
            $surcharge = round($surcharge, self::COST_PRECISION);
        // Case B : Surcharge is a percent, it can be negative (discount)
        } else if (preg_match('/^-?[0-9]+([\.,][0-9]+){0,1}%$/i', $discount)){
            $surcharge = trim($surcharge, '%');
            $surcharge = preg_replace('/,/', '.', $surcharge);
            $surcharge = round(($cost * $surcharge) / 100, self::COST_PRECISION);
        } else {
           return false;
        }
        return $surcharge;
    }

    public static function _status_show($status) {
        $html = '';
        switch($status) {
            case self::STATUS_CREATED:      $html .= get_string('status_created', 'local_order'); break;
            case self::STATUS_PREPARED:     $html .= get_string('status_prepared', 'local_order'); break;
            case self::STATUS_PENDING:      $html .= get_string('status_pending', 'local_order'); break;
            case self::STATUS_PAID:         $html .= get_string('status_paid', 'local_order'); break;
            case self::STATUS_CANCELLED:    $html .= get_string('status_cancelled', 'local_order'); break;
            default:                        $html .= get_string('status_unknown', 'local_order'); break;
        }
        return $html;
    }

    public static function _paymode_show($paymode) {
        $html = '';
        switch($paymode) {
            case self::PAYMODE_PAYPAL:       $html .= get_string('paymode_paypal', 'local_order'); break;
            case self::PAYMODE_CREDITCARD:   $html .= get_string('paymode_creditcard', 'local_order'); break;
            case self::PAYMODE_BANKTRANSFER: $html .= get_string('paymode_banktransfer', 'local_order'); break;
            case self::PAYMODE_WESTERNUNION: $html .= get_string('paymode_westernunion', 'local_order'); break;
            default:                         $html .= get_string('paymode_unknown', 'local_order'); break;
        }
        return $html;
    }

    public static function registry_page_orders_get(&$rp) {
        global $DB;

        $orders = false;
        if (!empty($rp->entry->id)) {
            $entries = $DB->get_records(self::DB_TABLE, array('registryid' => $rp->entry->id));
            if (!empty($entries)) {
                foreach ($entries as $entry) {
                    $order = new self($entry);
                    $orders[$entry->id] = $order;
                }
            }
        }

        return $orders;
    }

    public static function registry_page_has_orders(&$rp) {
        global $DB;

        if (!empty($rp->entry->id)) {
            $entries = $DB->get_records(self::DB_TABLE, array('registryid' => $rp->entry->id));
            if (!empty($entries)) {
                return true;
            }
        }

        return false;
    }

    public function validate_show() {
        $actions = array();

        foreach ($this->items as $item) {
            $action = $item->action_show($this);
            if (!empty($action)) $actions[] = $action;
        }

        return $actions;
    }

    public function cost_show() {
        return self::_cost_show($this->entry->finalcost, $this->entry->currency);
    }

    public function status_show() {
        return self::_status_show($this->entry->status);
    }

    public function paymode_show() {
        return self::_paymode_show($this->entry->paymode);
    }

    public function confirm($paymode, $code) {
        if ($this->entry->status != self::STATUS_PREPARED) return false;

        $code = preg_replace('/[^a-z0-9-+=]/i', '', $code);
        $finalcost = $this->entry->cost;
        $discount = 0;
        $this->entry->status = self::STATUS_PENDING;
        $this->entry->paymode = $paymode;

        // Check promotional
        $promotional = $this->rp->promotional_get_by_code($code);
        if (!empty($promotional)) {
            $discount = self::_discount($finalcost, $code, $promotional);
            if ($discount === false) {
               $promotional = false;
            }
        }

        // Add promotional as order item
        if (!empty($promotional) && is_numeric($discount)) {
            $name = (!empty($promotional->name)) ? $promotional->name : $promotional->code;
            $description = (!empty($promotional->description)) ? $promotional->description : get_string('order_promotional_discount', 'local_order');
            $item  = local_order_item::create($this, $name, $description,
                                              'discount', - round($discount, self::COST_PRECISION));
            $item->order_entry = $this->entry;
            $item->save();

            $this->items[$item->entry->id] = $item;
            $this->entry->promotional = $code;
            $finalcost = round($finalcost - $discount, self::COST_PRECISION);

            // Normalize finalcost, it can not be negative
            if ($finalcost < 0) $finalcost = 0;
        }

        // Check paymode penalty
        $penalty = $this->rp->penalty_get_by_paymode($paymode);
        if (!empty($penalty)) {
            $surcharge = self::_penalty($finalcost, $penalty);
            if ($surcharge === false) {
               $penalty = false;
            }
        }

        // Add penalty as order item
        if (!empty($penalty) && is_numeric($surcharge)) {
            $type = ($surchage > 0) ? 'paymode_surcharge' : 'paymode_discount';
            $name = (!empty($penalty->name)) ? $penalty->name : $type;
            $description = (!empty($penalty->description)) ? $penalty->description : get_string("order_penalty_{$type}", 'local_order');
            $item  = local_order_item::create($this, $name, $description,
                                              $type, round($surcharge, self::COST_PRECISION));

            $item->order_entry = $this->entry;
            $item->save();

            $this->items[$item->entry->id] = $item;
            $finalcost = round($finalcost + $surcharge, self::COST_PRECISION);

            // Normalize finalcost, it can not be negative
            if ($finalcost < 0) $finalcost = 0;
        }

        $this->entry->finalcost = $finalcost;
        $this->update();

        // Notify user
        $this->rp->user_notify_pending_send($this);

        // Notify admin
        $this->rp->admin_notify_pending_send($this);
    }

    public function validate() {
        $errors = array();
        if ($this->entry->status == self::STATUS_PENDING) {

            foreach ($this->items as $item) {
                $error = $item->action($this);
                if (!empty($error)) $errors[] = $error;
            }

            $this->entry->status = self::STATUS_PAID;
            $this->update();

            // Notify user
            $this->rp->user_notify_validate_send($this);

             // Notify admin
            $this->rp->admin_notify_validate_send($this);
        }

        return $errors;
    }

    public function cancel() {
        $errors = array();
        if ( ($this->entry->status != self::STATUS_PAID) &&
             ($this->entry->status != self::STATUS_CANCELLED) ){

            $this->entry->status = self::STATUS_CANCELLED;
            $this->update();

            // Notify user
            $this->rp->user_notify_cancel_send($this);

            // Notify admin
            $this->rp->admin_notify_cancel_send($this);
        }

        return $errors;
    }

    public function save() {
        global $DB;

        if (empty($this->entry->id)) {
            if (!empty($this->config)) $this->entry->metadata = json_encode($this->config);
            $this->entry->id = $DB->insert_record(self::DB_TABLE, $this->entry, true);
            if (!empty($this->entry->id)) {
                return true;
            }
        } else {
            return $this->update();
        }
        return false;
    }

    public function update() {
        global $DB;

        if (!empty($this->entry->id)) {
            $this->entry->modifydate = time();
            if (!empty($this->config)) $this->entry->metadata = json_encode($this->config);
            return $DB->update_record(self::DB_TABLE, $this->entry);
        } else {
            return $this->save();
        }
        return true;
    }
}

class local_order_item {
    const DB_TABLE         = 'local_order_item';

    public $entry          = null;
    public $config         = null;
    public $order_entry    = null;

    public function __construct($entry) {
        $this->entry  = $entry;
        if (!empty($entry->metadata)) $this->config = json_decode($entry->metadata);
    }

    public function save() {
        global $DB;
        if (empty($this->entry->id)) {
            if (!empty($this->config)) $this->entry->metadata = json_encode($this->config);
            $this->entry->id = $DB->insert_record(self::DB_TABLE, $this->entry, true);
            if (!empty($this->entry->id)) {
                return true;
            }
        } else {
            return $this->update();
        }
        return false;
    }

    public function update() {
        global $DB;

        if (!empty($this->entry->id)) {
            if (!empty($this->config)) $this->entry->metadata = json_encode($this->config);
            return $DB->update_record(self::DB_TABLE, $this->entry);
        } else {
            return $this->save();
        }
        return true;
    }

    public function cost_show() {
        return local_order::_cost_show($this->entry->cost, $this->order_entry->currency);
    }

    public function action_show($order) {
        switch ($this->entry->itemtype) {
            // AEA - Not available
            // case 'course': return $this->action_course_show($order);

            // AEA - Not available
            // case 'course': return $this->action_referral_show($order);

            case 'cohort': return $this->action_cohort_show($order);
        }

        return false;
    }

    private function action_course_show($order) {
        // $straction = new stdClass();
        // $straction->course_shortname = $item->config->course->shortname;
        // $straction->course_fullname = $item->config->course->fullname;
        // $straction->fromtime = date('d/m/Y', $item->config->fromtime);
        // $straction->untiltime = date('d/m/Y', $item->config->untiltime);
        // $straction->user_fullname = fullname($this->user);
        // $straction->user_email = $this->user->email;
        // $action = get_string('action_validate_course', 'local_order', $straction);

        // return $action;
        return 'Course enrol action not implemented';
    }

    private function action_referral_show($order) {
        // $straction = new stdClass();
        // $straction->course_shortname = $item->config->course->shortname;
        // $straction->course_fullname = $item->config->course->fullname;
        // $straction->fromtime = date('d/m/Y', $item->config->fromtime);
        // $straction->untiltime = date('d/m/Y', $item->config->untiltime);
        // $straction->user_firstname = $item->config->user->firstname;
        // $straction->user_lastname = $item->config->user->lastname;
        // $straction->user_email = $item->config->user->email;
        // $action = get_string('action_validate_referral', 'local_order', $straction);

        // return $action;
        return 'Referral action not implemented';
    }

    private function action_cohort_show($order) {
        $straction = new stdClass();
        $straction->cohort_category = local_order_cohort_category($order->cohort->contextid);
        $straction->cohort_name = $order->cohort->name;
        $straction->user_fullname = fullname($order->user);
        $straction->user_email = $order->user->email;
        $action = get_string('action_validate_cohort', 'local_order', $straction);

        return $action;
    }

    public function action($order) {
        switch ($this->entry->itemtype) {
            // case 'course': return $this->action_cohort($order);
            // case 'referral': return $this->action_cohort($order);
            case 'cohort': return $this->action_cohort($order);
        }

        return false;
    }

    private function action_course($order) {
        return false;
    }

    private function action_referral($order) {
        return false;
    }

    private function action_cohort($order) {
        cohort_add_member($order->entry->cohortid, $order->user->id);
        return false;
    }

    public static function create($order, $name, $description, $itemtype = 'cohort', $cost = 0) {
        $item = false;

        if (!empty($order->entry->id)) {
            $entry                = new stdClass();
            $entry->orderid       = $order->entry->id;
            $entry->name          = $name;
            $entry->description   = $description;
            $entry->itemtype      = $itemtype;
            $entry->cost          = $cost;

            $item = new self($entry);
            $item->order_entry    = $order->entry;
        }

        return $item;
    }

    public static function read($itemid, &$order) {
        global $DB;

        $item = false;
        $entry = $DB->get_record(self::DB_TABLE, array('id', $itemid));
        if (!empty($entry)) {
            $item = new self($entry);
            $item->order_entry = $order->entry;
        }

        return $item;
    }

    public static function order_items_get(&$order) {
        global $DB;

        $items = false;
        if (!empty($order->entry->id)) {
            $entries = $DB->get_records(self::DB_TABLE, array('orderid' => $order->entry->id));
            if (!empty($entries)) {
                foreach ($entries as $entry) {
                    $item = new self($entry);
                    $item->order_entry = $order->entry;
                    $items[$entry->id] = $item;
                }
            }
        }

        return $items;
    }
}


/**
 * Sign up an user
 *
 * Theme configuration read, if available:
 * - user_confirm_enabled : User must confirm email (default : false)
 * - user_confirm_hide_pass : Do not send plain password in confirmation email (default : false)
 *
 * @param object $user User data
 * @param object $rp Registry page where user fill data
 * @return object User moodle object
 */
function local_order_user_signup($user, $rp = null) {
    global $CFG, $DB;

    $sendconfirm = false;

    // Read configuration from RP Theme
    // 1. Save password in plain in order to send to user by email
    $hide_pass = $rp->user_confirm_hide_pass();
    if (!empty($hide_pass)) {
        $password_plain = null;
    } else {
        $password_plain = $user->password;
    }
    $user->password = hash_internal_user_password($user->password);

    // 2. User confirmation
    $confirm_enabled = $rp->user_confirm_enabled();
    if (empty($user->confirmed) && !empty($confirm_enabled)) {
        $sendconfirm = true;
        $user->confirmed  = 0;
    } else {
        $user->confirmed  = 1;
    }

    // Other fixed user params
    $user->mnethostid   = $CFG->mnet_localhost_id; // always local user
    $user->timecreated  = time();
    $user->timemodified = time();
    $user->firstaccess  = time();
    $user->secret       = random_string(15);
    $user->auth         = 'email';

    // Insert record to Moodle
    $user->id = $DB->insert_record('user', $user);

    // Update preferences, preference_*
    useredit_update_user_preference($user);

    // Update interests, using tags associated to user
    local_order_user_interests_update($user);

    // Save extra fields, profile_field_*
    profile_save_data($user);

    // No errors until here, set this field for log file
    $user->errors = 'OK';

    unset($user->password);

    // Send confirmation email
    if ($sendconfirm) $rp->user_signup_confirm_send($user, $password_plain);

    // Send notification email to admin
    $rp->admin_notify_signup_send($user);

    unset($user->enroled);
    unset($user->mnethostid);
    unset($user->timemodified);
    unset($user->firstaccess);
    unset($user->secret);
    unset($user->auth);
    unset($user->interests);

    // Log to a csv file, if configured
    $signup_log_enabled = $rp->signup_log_enabled();
    if (!empty($signup_log_enabled)) $rp->log_signup($user);

    // Trigger event : user_created
    $user = local_order_user_load($user->id);
    events_trigger('user_created', $user);

    // Moodle log : user created
    add_to_log(SITEID, 'user', get_string('create'), '/view.php?id='.$user->id, fullname($user));

    return $user;
}

/**
 * Update an user
 *
 * @param integer $userid Loggedin user ID
 * @param object $usernew User new data to update
 * @param object $rp Registry page where user fill data
 * @return object User moodle object
 */
function local_order_user_update($userid, $usernew, $rp = null) {
    global $DB;

    if (empty($userid) || empty($usernew)) return false;

    $user = $DB->get_record('user', array('id'=>$userid));
    if (empty($user)) return false;
    if (isguestuser($user)) return false;

    $userauth = get_auth_plugin($user->auth);
    if (!$userauth->can_edit_profile()) return false;

    $authplugin = get_auth_plugin($user->auth);

    unset($usernew->email);
    unset($usernew->username);
    unset($usernew->password);

    $usernew->id = $user->id;
    $DB->update_record('user', $usernew);

    if (! $authplugin->user_update($user, $usernew)) {
        // auth update failed, rollback for moodle
        $DB->update_record('user', $user);
        return false;
    }

    // Update preferences
    useredit_update_user_preference($usernew);

    // Update interests
    local_order_user_interests_update($usernew);

    // Save custom profile fields data
    profile_save_data($usernew);

    $confirm_enabled = $rp->user_confirm_enabled();
    if (!empty($confirm_enabled) && empty($user->confirmed)) {
        $rp->user_signup_confirm_resend($user);
    }

    $user = local_order_user_load($user->id);

    local_order_mailchimp_user_update($user, $rp);

    return $user;
}

/**
 * Load user from DB by user ID
 *
 * @param integer $userid User ID
 * @return object User moodle object
 */
function local_order_user_load($userid) {
   global $DB;

   if (empty($userid)) return false;

   $user = $DB->get_record('user', array('id' => $userid));
   if (empty($user)) return false;

   useredit_load_preferences($user);
   profile_load_data($user);
   if ($interests = local_order_user_interests_read($user)) $user->interests = $interests;

   return $user;
}

/**
 * Load user from DB by email
 *
 * @param string $email User email
 * @return object User moodle object
 */
function local_order_user_load_by_email($email) {
   global $DB;
   if (empty($email)) return false;

   $user = $DB->get_record('user', array('email' => $email));
   if (empty($user)) return false;

   return local_order_user_load($user->id);
}

/**
 * Change user password by email and secret code
 *
 * @param string $email User email
 * @param string $code User secret code
 * @param string $password User new password
 * @return object User moodle object
 */
function local_order_user_password_set($email, $code, $password) {
    global $DB;

    if (empty($email) || empty($code) || empty($password)) return false;

    $user = $DB->get_record('user', array('email' => $email, 'secret' => $code, 'confirmed' => 1));
    if (empty($user)) return false;

    $userauth = get_auth_plugin($user->auth);
    if (!$userauth->can_change_password() || $userauth->change_password_url()) return false;

    $DB->update_record('user', array('id' => $user->id, 'secret' => ''));
    return $userauth->user_update_password($user, $password);
}

/**
 * Load user interest
 *
 * @param object $user User moodle object
 * @return object User interests
 */
function local_order_user_interests_read($user) {
    global $CFG;

    $interest = false;
    if (!empty($CFG->usetags)) {
        $interests = tag_get_tags_array('user', $user->id);
    }
    return $interests;
}

/**
 * Update user interests, merging with already existing
 *
 * @param object $user User data
 * @return void
 */
function local_order_user_interests_update($user) {
    global $CFG;

    if (!empty($CFG->usetags) && !empty($user->interests)) {
        $interests = array();
        if (is_string($user->interests)) $interests[] = $user->interests;
        if (is_array($user->interests)) $interests = $user->interests;
        if (is_object($user->interests)) $interests = (array) $user->interests;
        // useredit_update_interests($usernew, $usernew->interests);

        // Merge current tags with new tags
        $current = tag_get_tags_array('user', $user->id);
        $interests = array_merge($current, $interests);
        tag_set('user', $user->id, $interests);
    }
}

/**
 * Check user login
 *
 * @param object $data Login form data
 * @return object User moodle object or false
 */
function local_order_check_login($data) {
    $user = false;
    if (!empty($data->username) && $data->password) {
        $user = authenticate_user_login($data->username, $data->password);

        update_login_count();

        if ($user) {
            add_to_log(SITEID, 'user', 'login', "view.php?id=$user->id&course=".SITEID,
                          $user->id, 0, $user->id);
            $user = local_order_user_load($user->id);
            local_order_user_login($user);
        }
    }
    return $user;
}

/**
 * Login user into Moodle
 *
 * @param object $user User moodle object
 * @return object User moodle object
 */
function local_order_user_login($user) {
    global $USER;

    if ($user) {
        session_regenerate_id(true);

        unset($user->preference);
        check_user_preferences_loaded($user);

        $USER = $user;

        // check enrolments, load caps and setup $USER object
        session_set_user($user);

        // extra session prefs init
        set_login_session_preferences();
    }

    return $user;
}

/**
 * Send an email
 *
 * @param string $to        Destination email
 * @param string $from      From email
 * @param string $fromname  From name
 * @param string $subject   Subject
 * @param string $message   Message in plain text
 * @return bool
 */
function local_order_mail_send($to, $from, $fromname, $subject, $message) {
    global $CFG;

    if (!empty($CFG->noemailever)) {
        // hidden setting for development sites, set in config.php if needed
        $noemail = 'Not sending email due to noemailever config setting';
        // wrlog("Error: local/order/lib.php local_order_mail_send(): $noemail");
        return true;
    }

    if (!empty($CFG->divertallemailsto)) {
        $subject = "[DIVERTED {$to}] $subject";
        $to = $CFG->divertallemailsto;
    }

    if (!validate_email($to)) {
        // we can not send emails to invalid addresses - it might create security issue or confuse the mailer
        $invalidemail = "TO Email ($to) is invalid! Not sending.";
        // wrlog("Error: local/order/lib.php local_order_mail_send(): $invalidemail");
        return false;
    }

    if (!validate_email($from)) {
        // we can not send emails to invalid addresses - it might create security issue or confuse the mailer
        $invalidemail = "FROM Email ($from) is invalid! Not sending.";
        // wrlog("Error: local/order/lib.php local_order_mail_send(): $invalidemail");
        return false;
    }

    // Use Moodle email backend configuration
    $mail = get_mailer();

    $mail->Sender       = $from;
    $mail->From         = $from;
    $mail->FromName     = $fromname;
    $mail->Subject      = substr($subject, 0, 900);
    $mail->Body         = "\n$message\n";
    $mail->IsHTML(false);
    $mail->AddAddress($to);

    if (!$mail->Send()) {
        // wrlog("Error: local/order/lib.php local_order_mail_send(): $mail->ErrorInfo");
        return false;
    }

    return true;
}

/**
 * Update user contact data in Mailchimp list
 *
 * @param object $user      User moodle object
 * @param object $rp        Registry page where user fill data
 * @return object Mailchimp response object
 */
function local_order_mailchimp_user_update($user, $rp) {
    if (empty($user->email)) return false;
    if (empty($user->confirmed)) return false;
    $mailchimp_enabled = $rp->mailchimp_enabled();
    if (empty($mailchimp_enabled)) return false;

    $mcapi = new MCAPI($rp->mailchimp_apikey_get());
    $list = $rp->mailchimp_list_get();
    $merge_vars = $rp->mailchimp_mapping($user);

    $member = $mcapi->listMemberInfo($list, array($user->email));
    if (!empty($member['success'])) {
        // User exists, update info
        if ($mcapi->listUpdateMember($list, $user->email, $merge_vars, 'html', false)) {
            $member = $mcapi->listMemberInfo($list, array($user->email));
        }
    } else {
        // User does not exists, add to the list
        $member = false;
        if ($mcapi->listSubscribe($list, $user->email, $merge_vars, 'html', false)) {
            $member = $mcapi->listMemberInfo($list, array($user->email));
        }
    }
    return $member;
}

function local_order_code_confirm($email, $code, $rp) {
    global $DB;

    if (empty($code) || !validate_email($email)) return false;

    $user = $DB->get_record('user', array('email' => $email, 'secret' => $code, 'confirmed' => 0));
    if (empty($user)) return false;

    $DB->update_record('user', array('id' => $user->id, 'confirmed' => 1, 'secret' => ''));

    $user = local_order_user_load($user->id);

    // Send notification email to admin
    $rp->admin_notify_confirmed_send($user);

    // Send notification email to user
    $rp->user_notify_signup_send($user);

    // Update Mailchimp record
    local_order_mailchimp_user_update($user, $rp);

    return $user;
}

function local_order_user_confirmed($email) {
    global $DB;

    if (!validate_email($email)) return false;

    $user = $DB->get_record('user', array('email' => $email, 'confirmed' => 1));
    if (empty($user)) return false;

    $user = local_order_user_load($user->id);

    return $user;
}

