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
 * Registry page. Set new password form
 *
 * @package   order:registry:theme:sample
 * @copyright 2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die('');    ///  It must be included from a Registry index page

require_once(LOCAL_ORDER_RP_THEME_DIRROOT . '/forms/rpform.php');

class local_order_rp_setpasswd_form extends rpform {

    function definition() {
        $mform  =& $this->_form;
        $rp     =& $this->_customdata;

        // PASSWORD, is mandatory
        $field = 'password';
        $type = PARAM_RAW;
        $mform->addElement('password', $field);
        $mform->setType($field, $type);
        $mform->addRule($field, $rp->get_string('missing_password'), 'required', null, 'server');

        // RE-PASSWORD, is mandatory
        $field = 're' . $field;
        $type = PARAM_RAW;
        $mform->addElement('password', $field);
        $mform->setType($field, $type);
        $mform->addRule($field, $rp->get_string('missing_repassword'), 'required', null, 'server');

        $field = 'code';
        $type = PARAM_RAW;
        $mform->addElement('hidden', $field);
        $mform->setType($field, $type);

        $field = 'email';
        $type = PARAM_EMAIL;
        $mform->addElement('hidden', $field);
        $mform->setType($field, $type);
    }

    function definition_after_data() {
        // Nothing to do
    }

    function validation($data, $files) {

        $rp     =& $this->_customdata;
        $errors = parent::validation($data, $files);

        // PASSWORD (mandatory)
        $field = 'password';
        $ml = $rp->maxlength[$field];

        // Check if password is valid
        $errmsg = '';
        if (textlib::strlen($data[$field]) > $ml) {
            $errors[$field] = $rp->get_string("error_invalid_{$field}_toolong", $ml);
        } else if (!check_password_policy($data[$field], $errmsg)) {
            $errors[$field] = $errmsg;
        // Check if password is equal
        } else if ($data[$field] !== $data['re' . $field]) {
            $errors['re' . $field] = $rp->get_string('error_invalid_password_passwordsnotequal');
        }

        return $errors;
    }
}
