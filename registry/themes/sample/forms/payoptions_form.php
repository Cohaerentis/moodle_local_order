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
 * Registry page. Pay opptions form
 *
 * @package   order:registry:theme:sample
 * @copyright 2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die('');    ///  It must be included from a Registry index page

require_once(LOCAL_ORDER_RP_THEME_DIRROOT . '/forms/rpform.php');

class local_order_rp_payoptions_form extends rpform {

    function definition() {
        $mform  =& $this->_form;
        $rp     =& $this->_customdata;

        // Paymode, is mandatory
        $field = 'paymode';
        $type = PARAM_INT;
        $mform->addElement('text', $field);
        $mform->setType($field, $type);
        $mform->addRule($field, $rp->get_string('missing_paymode'), 'required', null, 'server');

        // Promotional
        $field = 'promotional';
        $type = PARAM_NOTAGS;
        $mform->addElement('text', $field);
        $mform->setType($field, $type);
    }

    function definition_after_data(){
        // Nothing to do
    }

    function validation($data, $files) {
        global $RP;

        $rp     =& $this->_customdata;
        $errors = parent::validation($data, $files);

        // PROMOTIONAL
        $field = 'promotional';
        $ml = $rp->maxlength[$field];
        if (!empty($data[$field]) && (textlib::strlen($data[$field]) > $ml) )  {
            $errors[$field] = $rp->get_string("error_invalid_{$field}_toolong", $ml);
        }

        // PAYMODE
        $field = 'paymode';
        $ml = $rp->maxlength[$field];
        if (!empty($data[$field]) && (textlib::strlen($data[$field]) > $ml) )  {
            $errors[$field] = $rp->get_string("error_invalid_{$field}_toolong", $ml);
        } else if ( !( (!empty($rp->theme->config->paypal_enabled)) && ($data[$field] == local_order::PAYMODE_PAYPAL) ) &&
                    !( (!empty($rp->theme->config->transfer_enabled)) && ($data[$field] == local_order::PAYMODE_BANKTRANSFER) ) &&
                    !( (!empty($rp->theme->config->western_enabled)) && ($data[$field] == local_order::PAYMODE_WESTERNUNION) ) &&
                    !( (!empty($rp->theme->config->creditcard_enabled)) && ($data[$field] == local_order::PAYMODE_CREDITCARD) ) ) {
            $errors[$field] = $rp->get_string("missing_{$field}");
        }

        return $errors;
    }
}
