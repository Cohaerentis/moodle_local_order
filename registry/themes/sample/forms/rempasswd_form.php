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
 * Registry page. Remember password form
 *
 * @package   order:registry:theme:sample
 * @copyright 2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die('');    ///  It must be included from a Registry index page

require_once(LOCAL_ORDER_RP_THEME_DIRROOT . '/forms/rpform.php');

class local_order_rp_rempasswd_form extends rpform {

    function definition() {
        $mform  =& $this->_form;
        $rp     =& $this->_customdata;

        // EMAIL, is mandatory
        $field = 'email';
        $type = PARAM_EMAIL;
        $mform->addElement('text', $field);
        $mform->setType($field, $type);
        $mform->addRule($field, $rp->get_string('missing_email'), 'required', null, 'server');
    }

    function definition_after_data(){
        $mform =& $this->_form;

        // Main fields
        $field = 'email';
        $mform->applyFilter($field, 'trim');
    }

    function validation($data, $files) {
        global $DB;

        $rp     =& $this->_customdata;
        $errors = parent::validation($data, $files);

        // EMAIL (mandatory)
        $field = 'email';
        $ml = $rp->maxlength[$field];
        if (textlib::strlen($data[$field]) > $ml) {
            $errors[$field] = $rp->get_string("error_invalid_{$field}_toolong", $ml);
        // Validate email
        } else if (!validate_email($data[$field])) {
            $errors[$field] = $rp->get_string("error_invalid_{$field}");
        // Check if email exists
        } else if (!$DB->record_exists('user', array('email' => $data[$field]))) {
            $errors[$field]  = $rp->get_string('error_invalid_email_notexists');
        // Check if email is allowed
        } else if ($err = email_is_not_allowed($data[$field])) {
            $errors[$field] = $err;
        }

        return $errors;
    }
}
