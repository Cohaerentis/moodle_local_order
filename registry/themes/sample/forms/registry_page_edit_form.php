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
 * Registry page form main class
 *
 * @package   order:registry
 * @copyright 2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('LOCAL_ORDER_INTERNAL')) die('');    ///  It must be included from an Admin page

require_once($CFG->dirroot . '/lib/formslib.php');

class registry_page_edit_form extends moodleform {

    protected function definition() {
        $mform  =& $this->_form;
        $custom =& $this->_customdata;
        $rp     =& $custom['rp'];

        // -------------------------------------------------------------------------------
        $mform->addElement('header', 'general', $rp->get_string('legend_admin_registry_page_general'));

        // Name
        $mform->addElement('text', 'name', $rp->get_string('lbl_name'), array('size' => '64'));
        $mform->addRule('name', null, 'required', null, 'client');

        // Title
        $mform->addElement('text', 'title', $rp->get_string('lbl_title'), array('size' => '64'));
        $mform->addRule('title', null, 'required', null, 'client');

        // Description
        $mform->addElement('editor', 'description', $rp->get_string('lbl_description'),
                           null, array('maxfiles' => EDITOR_UNLIMITED_FILES,
                                       'noclean' => true,
                                       'context' => context_system::instance()));
        $mform->setType('description', PARAM_RAW); // no XSS prevention here, users must be trusted
        $mform->addRule('description', null, 'required', null, 'client');

        // -------------------------------------------------------------------------------
        $mform->addElement('header', 'general', $rp->get_string('legend_admin_registry_page_classification'));

        // Contact email
        $mform->addElement('text', 'contact_email', $rp->get_string('lbl_contact_email'), array('size' => '64'));
        $mform->addRule('contact_email', null, 'required', null, 'client');

        // Mailchimp topics
        $mailchimp_topics = array("" => $rp->get_string('lbl_mailchimp_selectone'),
                          "Teachnova" => "Teachnovas",
                          "Cohaerentis" => "Cohaerentis",
                          "OpenCodex" => "OpenCodex",
                          "Consultoria" => "Consultoria",
                          "Formación" => "Formación");
        $mform->addElement('select', 'mailchimp1', $rp->get_string('lbl_mailchimp'), $mailchimp_topics);
        $mform->addElement('select', 'mailchimp2', $rp->get_string('lbl_mailchimpother'), $mailchimp_topics);

        // -------------------------------------------------------------------------------
        $mform->addElement('header', 'general', $rp->get_string('legend_admin_registry_page_notifications'));

        // Admin notifications
        $mform->addElement('text', 'admin_notify_signup_toemail', $rp->get_string('lbl_admin_notify_signup_toemail'), array('size' => '64'));
        $mform->addRule('admin_notify_signup_toemail', null, 'required', null, 'client');

        $mform->addElement('text', 'admin_notify_confirmed_toemail', $rp->get_string('lbl_admin_notify_confirmed_toemail'), array('size' => '64'));
        $mform->addRule('admin_notify_confirmed_toemail', null, 'required', null, 'client');

        $mform->addElement('text', 'admin_notify_pending_toemail', $rp->get_string('lbl_admin_notify_pending_toemail'), array('size' => '64'));
        $mform->addRule('admin_notify_pending_toemail', null, 'required', null, 'client');

        $mform->addElement('text', 'admin_notify_validate_toemail', $rp->get_string('lbl_admin_notify_validate_toemail'), array('size' => '64'));
        $mform->addRule('admin_notify_validate_toemail', null, 'required', null, 'client');

        $mform->addElement('text', 'admin_notify_cancel_toemail', $rp->get_string('lbl_admin_notify_cancel_toemail'), array('size' => '64'));
        $mform->addRule('admin_notify_cancel_toemail', null, 'required', null, 'client');

        // -------------------------------------------------------------------------------
        $mform->addElement('header', 'general', $rp->get_string('legend_admin_registry_page_call'));

        // Call URL
        $mform->addElement('text', 'call_url', $rp->get_string('lbl_call_url'), array('size' => '64'));
        $mform->addRule('call_url', null, 'required', null, 'client');

        // Call PDF url
        $mform->addElement('text', 'call_pdf', $rp->get_string('lbl_call_pdf'), array('size' => '64'));
        $mform->addRule('call_pdf', null, 'required', null, 'client');

        // -------------------------------------------------------------------------------
        $mform->addElement('header', 'general', $rp->get_string('legend_admin_registry_page_banner'));

        // Banner URL
        $mform->addElement('text', 'banner_url', $rp->get_string('lbl_banner_url'), array('size' => '64'));

        // Banner IMG url
        $mform->addElement('text', 'banner_img', $rp->get_string('lbl_banner_img'), array('size' => '64'));

        // Banner ALT
        $mform->addElement('text', 'banner_alt', $rp->get_string('lbl_banner_alt'), array('size' => '64'));

        // -------------------------------------------------------------------------------
        $mform->addElement('header', 'general', $rp->get_string('legend_admin_registry_page_dates'));

        // Date last call
        $mform->addElement('date_time_selector', 'date_last_call', $rp->get_string('lbl_date_last_call'));
        $mform->addRule('date_last_call', null, 'required', null, 'client');

        // Date start
        $mform->addElement('date_time_selector', 'date_start', $rp->get_string('lbl_date_start'));
        $mform->addRule('date_start', null, 'required', null, 'client');

        // Date end
        $mform->addElement('date_time_selector', 'date_end', $rp->get_string('lbl_date_end'));
        $mform->addRule('date_end', null, 'required', null, 'client');

        // Duration
        $mform->addElement('text', 'time', $rp->get_string('lbl_time'), array('size' => '64'));
        $mform->addRule('time', null, 'required', null, 'client');

        // -------------------------------------------------------------------------------
        $mform->addElement('header', 'general', $rp->get_string('legend_admin_registry_page_order'));

        // Order Prefix
        $mform->addElement('text', 'order_prefix', $rp->get_string('lbl_order_prefix'), array('size' => '64'));
        $mform->addRule('order_prefix', null, 'required', null, 'client');

        // Order currency
        $currencies = array("EUR" => "Euro",
                          "USD" => "US Dollar",
                          "CAD" => "Canadian Dollar");
        $mform->addElement('select', 'order_currency', $rp->get_string('lbl_order_currency'), $currencies);
        $mform->addRule('order_currency', null, 'required', null, 'client');

        // Order cost
        $mform->addElement('text', 'order_cost', $rp->get_string('lbl_order_cost'), array('size' => '64'));
        $mform->addRule('order_cost', null, 'required', null, 'client');

        // Paypal description
        $mform->addElement('text', 'paypal_description', $rp->get_string('lbl_paypal_description'), array('size' => '64'));
        $mform->addRule('paypal_description', null, 'required', null, 'client');

        // -------------------------------------------------------------------------------
        $mform->addElement('header', 'general', $rp->get_string('legend_admin_registry_page_discount_graduate'));

        // Discount code
        $mform->addElement('text', 'discount_graduate_code', $rp->get_string('lbl_discount_code'), array('size' => '12'));
        $mform->setType('discount_graduate_code', PARAM_ALPHANUM);

        // Discount qty
        $mform->addElement('text', 'discount_graduate_qty', $rp->get_string('lbl_discount_qty'), array('size' => '8'));

        // Discount name
        $mform->addElement('text', 'discount_graduate_name', $rp->get_string('lbl_discount_name'), array('size' => '12'));

        // Discount description
        $mform->addElement('text', 'discount_graduate_description', $rp->get_string('lbl_discount_description'), array('size' => '64'));

        // -------------------------------------------------------------------------------
        $mform->addElement('header', 'general', $rp->get_string('legend_admin_registry_page_discount_additional'));

        // Discount code
        $mform->addElement('text', 'discount_additional_code', $rp->get_string('lbl_discount_code'), array('size' => '12'));
        $mform->setType('discount_additional_code', PARAM_ALPHANUM);

        // Discount qty
        $mform->addElement('text', 'discount_additional_qty', $rp->get_string('lbl_discount_qty'), array('size' => '8'));

        // Discount name
        $mform->addElement('text', 'discount_additional_name', $rp->get_string('lbl_discount_name'), array('size' => '12'));

        // Discount description
        $mform->addElement('text', 'discount_additional_description', $rp->get_string('lbl_discount_description'), array('size' => '64'));

        // -------------------------------------------------------------------------------
        $mform->addElement('header', 'general', $rp->get_string('legend_admin_registry_page_discount_groups'));

        // Discount code
        $mform->addElement('text', 'discount_groups_code', $rp->get_string('lbl_discount_code'), array('size' => '12'));
        $mform->setType('discount_groups_code', PARAM_ALPHANUM);

        // Discount qty
        $mform->addElement('text', 'discount_groups_qty', $rp->get_string('lbl_discount_qty'), array('size' => '8'));

        // Discount name
        $mform->addElement('text', 'discount_groups_name', $rp->get_string('lbl_discount_name'), array('size' => '12'));

        // Discount description
        $mform->addElement('text', 'discount_groups_description', $rp->get_string('lbl_discount_description'), array('size' => '64'));

        // -------------------------------------------------------------------------------
        $mform->addElement('header', 'general', $rp->get_string('legend_admin_registry_page_discount_members'));

        // Discount code
        $mform->addElement('text', 'discount_members_code', $rp->get_string('lbl_discount_code'), array('size' => '12'));
        $mform->setType('discount_members_code', PARAM_ALPHANUM);

        // Discount qty
        $mform->addElement('text', 'discount_members_qty', $rp->get_string('lbl_discount_qty'), array('size' => '8'));

        // Discount name
        $mform->addElement('text', 'discount_members_name', $rp->get_string('lbl_discount_name'), array('size' => '12'));

        // Discount description
        $mform->addElement('text', 'discount_members_description', $rp->get_string('lbl_discount_description'), array('size' => '64'));

        // -------------------------------------------------------------------------------
        $mform->addElement('header', 'general', $rp->get_string('legend_admin_registry_page_discount_group_members'));

        // Discount code
        $mform->addElement('text', 'discount_group_members_code', $rp->get_string('lbl_discount_code'), array('size' => '12'));
        $mform->setType('discount_group_members_code', PARAM_ALPHANUM);

        // Discount qty
        $mform->addElement('text', 'discount_group_members_qty', $rp->get_string('lbl_discount_qty'), array('size' => '8'));

        // Discount name
        $mform->addElement('text', 'discount_group_members_name', $rp->get_string('lbl_discount_name'), array('size' => '12'));

        // Discount description
        $mform->addElement('text', 'discount_group_members_description', $rp->get_string('lbl_discount_description'), array('size' => '64'));

        // -------------------------------------------------------------------------------
        $mform->addElement('header', 'general', $rp->get_string('legend_admin_registry_page_discount_variable'));

        // Discount code
        $mform->addElement('text', 'discount_variable_code', $rp->get_string('lbl_discount_code'), array('size' => '12'));
        $mform->setType('discount_variable_code', PARAM_ALPHANUM);

        // Discount name
        $mform->addElement('text', 'discount_variable_name', $rp->get_string('lbl_discount_name'), array('size' => '12'));

        // Discount description
        $mform->addElement('text', 'discount_variable_description', $rp->get_string('lbl_discount_description'), array('size' => '64'));

        $mform->addElement('hidden', 'action', 'edit');
        $mform->setType('action', PARAM_ALPHA);

        $mform->addElement('hidden', 'rpid', $rp->entry->id);
        $mform->setType('rpid', PARAM_INT);

        $mform->addElement('hidden', 'return', $custom['return']);
        $mform->setType('return', PARAM_URL);

        // -------------------------------------------------------------------------------
        $this->add_action_buttons();
    }

    public function definition_after_data(){
        $mform =& $this->_form;
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        // TODO

        return $errors;
    }

    public function decode($config) {
        $data = new StdClass();
        $data->name  = $config->name;
        $data->title = $config->title;
        $data->description = array('text' => $config->description, 'format' => 1);

        $data->contact_email = $config->contact_email;
        if (!empty($config->mailchimp_topics[0])) $data->mailchimp1 = $config->mailchimp_topics[0];
        if (!empty($config->mailchimp_topics[1])) $data->mailchimp2 = $config->mailchimp_topics[1];
        $data->admin_notify_signup_toemail = $config->admin_notify_signup_toemail;
        $data->admin_notify_confirmed_toemail = $config->admin_notify_confirmed_toemail;
        $data->admin_notify_pending_toemail = $config->admin_notify_pending_toemail;
        $data->admin_notify_validate_toemail = $config->admin_notify_validate_toemail;
        $data->admin_notify_cancel_toemail = $config->admin_notify_cancel_toemail;
        $data->call_url = $config->call_url;
        $data->call_pdf = $config->call_pdf;
        $data->banner_url = $config->banner_url;
        $data->banner_img = $config->banner_img;
        $data->banner_alt = $config->banner_alt;
        $data->order_prefix = $config->order_prefix;
        $data->order_currency = $config->order_currency;
        $data->order_cost = $config->order_cost;
        $data->paypal_description = $config->paypal_description;
        $data->date_last_call = $config->date_last_call;
        $data->date_start = $config->date_start;
        $data->date_end = $config->date_end;
        $data->time = $config->time;
        if (!empty($config->order_promotionals)) {
            foreach ($config->order_promotionals as $promotional) {
                if (!empty($promotional->index)) {
                    $field = 'discount_' . $promotional->index . '_code';
                    $data->$field = $promotional->code;
                    $field = 'discount_' . $promotional->index . '_qty';
                    $data->$field = $promotional->qty;
                    $field = 'discount_' . $promotional->index . '_name';
                    $data->$field = $promotional->name;
                    $field = 'discount_' . $promotional->index . '_description';
                    $data->$field = $promotional->description;
                }
            }
        }

        return $data;
    }

    public function encode($data) {
        $custom =& $this->_customdata;
        $rp     =& $custom['rp'];

        $config = new StdClass();
        $config->name  = $data->name;
        $config->title = $data->title;
        $config->description = $data->description['text'];
        $config->contact_email = $data->contact_email;
        $config->mailchimp_topics = array();
        if (!empty($data->mailchimp1)) $config->mailchimp_topics[] = $data->mailchimp1;
        if (!empty($data->mailchimp2)) $config->mailchimp_topics[] = $data->mailchimp2;
        $config->admin_notify_signup_toemail = $data->admin_notify_signup_toemail;
        $config->admin_notify_confirmed_toemail = $data->admin_notify_confirmed_toemail;
        $config->admin_notify_pending_toemail = $data->admin_notify_pending_toemail;
        $config->admin_notify_validate_toemail = $data->admin_notify_validate_toemail;
        $config->admin_notify_cancel_toemail = $data->admin_notify_cancel_toemail;
        $config->call_url = $data->call_url;
        $config->call_pdf = $data->call_pdf;
        $config->banner_url = $data->banner_url;
        $config->banner_img = $data->banner_img;
        $config->banner_alt = $data->banner_alt;
        $config->order_prefix = $data->order_prefix;
        $config->order_currency = $data->order_currency;
        $config->order_cost = $data->order_cost;
        $config->paypal_description = $data->paypal_description;
        $config->date_last_call = $data->date_last_call;
        $config->date_start = $data->date_start;
        $config->date_end = $data->date_end;
        $config->time = $data->time;
        $config->order_promotionals = array();
        if (!empty($data->discount_graduate_code) && !empty($data->discount_graduate_qty)) {
            $discount = new stdClass();
            $discount->index = 'graduate';
            $discount->code = $data->discount_graduate_code;
            $discount->qty = $data->discount_graduate_qty;
            $discount->name = empty($data->discount_graduate_name) ? $data->discount_graduate_code : $data->discount_graduate_name;
            $discount->description = empty($data->discount_graduate_description) ? $rp->get_string('default_discount_graduate_description') : $data->discount_graduate_description;
            $config->order_promotionals[] = $discount;
        }
        if (!empty($data->discount_additional_code) && !empty($data->discount_additional_qty)) {
            $discount = new stdClass();
            $discount->index = 'additional';
            $discount->code = $data->discount_additional_code;
            $discount->qty = $data->discount_additional_qty;
            $discount->name = empty($data->discount_additional_name) ? $data->discount_additional_code : $data->discount_additional_name;
            $discount->description = empty($data->discount_additional_description) ? $rp->get_string('default_discount_additional_description') : $data->discount_additional_description;
            $config->order_promotionals[] = $discount;
        }
        if (!empty($data->discount_groups_code) && !empty($data->discount_groups_qty)) {
            $discount = new stdClass();
            $discount->index = 'groups';
            $discount->code = $data->discount_groups_code;
            $discount->qty = $data->discount_groups_qty;
            $discount->name = empty($data->discount_groups_name) ? $data->discount_groups_code : $data->discount_groups_name;
            $discount->description = empty($data->discount_groups_description) ? $rp->get_string('default_discount_groups_description') : $data->discount_groups_description;
            $config->order_promotionals[] = $discount;
        }
        if (!empty($data->discount_members_code) && !empty($data->discount_members_qty)) {
            $discount = new stdClass();
            $discount->index = 'members';
            $discount->code = $data->discount_members_code;
            $discount->qty = $data->discount_members_qty;
            $discount->name = empty($data->discount_members_name) ? $data->discount_members_code : $data->discount_members_name;
            $discount->description = empty($data->discount_members_description) ? $rp->get_string('default_discount_members_description') : $data->discount_members_description;
            $config->order_promotionals[] = $discount;
        }
        if (!empty($data->discount_group_members_code) && !empty($data->discount_group_members_qty)) {
            $discount = new stdClass();
            $discount->index = 'group_members';
            $discount->code = $data->discount_group_members_code;
            $discount->qty = $data->discount_group_members_qty;
            $discount->name = empty($data->discount_group_members_name) ? $data->discount_group_members_code : $data->discount_group_members_name;
            $discount->description = empty($data->discount_group_members_description) ? $rp->get_string('default_discount_group_members_description') : $data->discount_group_members_description;
            $config->order_promotionals[] = $discount;
        }
        if (!empty($data->discount_variable_code)) {
            $discount = new stdClass();
            $discount->index = 'variable';
            $discount->code = $data->discount_variable_code;
            $discount->qty = 'variable';
            $discount->name = empty($data->discount_variable_name) ? $data->discount_variable_code : $data->discount_variable_name;
            $discount->description = empty($data->discount_variable_description) ? $rp->get_string('default_discount_variable_description') : $data->discount_variable_description;
            $config->order_promotionals[] = $discount;
        }

        return $config;
    }
}