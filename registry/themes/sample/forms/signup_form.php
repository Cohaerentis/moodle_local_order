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
 * Registry page. Email confirm code validation form
 *
 * @package   order:registry:theme:sample
 * @copyright 2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die('');    ///  It must be included from a Registry index page

require_once(LOCAL_ORDER_RP_THEME_DIRROOT . '/forms/rpform.php');

class local_order_rp_signup_form extends rpform {

    function definition() {
        $mform =& $this->_form;
        $rp    =& $this->_customdata;

        // Signup or validate
        if (!isloggedin()) {
            // EMAIL, is mandatory
            $field = 'email';
            $type = PARAM_EMAIL;
            $mform->addElement('text', $field);
            $mform->setType($field, $type);
            $mform->addRule($field, $rp->get_string('missing_email'), 'required', null, 'server');

            // PASSWORD
            if (!empty($rp->theme->config->field_password->enabled)) {
                $field = 'password';
                $type = PARAM_RAW;
                $mform->addElement('password', $field);
                $mform->setType($field, $type);
                if (!empty($rp->theme->config->field_password->required)) {
                    $mform->addRule($field, $rp->get_string('missing_password'), 'required', null, 'server');
                }
            }

            if (!empty($rp->theme->config->field_password->required) &&
                !empty($rp->theme->config->field_password->repassword)) {
                // Repassword
                $field = 'repassword';
                $mform->addElement('password', $field);
                $mform->setType($field, $type);
                $mform->addRule($field, $rp->get_string('missing_repassword'), 'required', null, 'server');
            }

            // USERNAME
            if (!empty($rp->theme->config->field_username->enabled)) {
                $field = 'username';
                $type = PARAM_USERNAME;
                $mform->addElement('username', $field);
                $mform->setType($field, $type);
                if (!empty($rp->theme->config->field_username->required)) {
                    $mform->addRule($field, $rp->get_string('missing_username'), 'required', null, 'server');
                }
            }
        }

        // Fixed fields
        foreach ($rp->signup_fixed_fields as $field) {
            $type = PARAM_NOTAGS;
            $mform->addElement('text', $field);
            $mform->setType($field, $type);
            $mform->addRule($field, $rp->get_string("missing_{$field}"), 'required', null, 'server');
        }

        // Config fields
        foreach ($rp->signup_config_fields as $field) {
            $configfield = "field_$field";
            $config = $rp->theme->config->$configfield;
            $type = PARAM_NOTAGS;
            if (!empty($config->enabled)) {
                $mform->addElement('text', $field);
                $mform->setType($field, $type);
                if (!empty($config->required)) {
                    $mform->addRule($field, $rp->get_string("missing_{$field}"), 'required', null, 'server');
                }
            }
        }

        // Special fields
    }

    function definition_after_data(){
        $mform =& $this->_form;
        $rp    =& $this->_customdata;

        if (!isloggedin()) {
            $field = 'email';
            $mform->applyFilter($field, 'trim');

            if (!empty($rp->theme->config->field_username->enabled)) {
                $field = 'username';
                $mform->applyFilter($field, 'textlib::strtolower');
                $mform->applyFilter($field, 'trim');
            }
        }

        // Extra fields
        if (!empty($rp->theme->config->field_nif->enabled)) {
            $field = 'nif';
            $mform->applyFilter($field, 'textlib::strtoupper');
            $mform->applyFilter($field, 'trim');
        }
    }

    function validation($data, $files) {
        global $CFG, $DB;

        $rp     =& $this->_customdata;
        $errors = parent::validation($data, $files);

        if (!isloggedin()) {
            // EMAIL (mandatory)
            $forgoturl = new moodle_url($rp->uri,
                array('action' => $rp::ACTION_REMEMBER_PASSWORD,
                      'email'  => urlencode($data['email']) ) );
            $resendurl = new moodle_url($rp->uri,
                array('action' => $rp::ACTION_RESEND_CONFIRM,
                      'email'  => urlencode($data['email']) ) );

            $field = 'email';
            $ml = $rp->maxlength[$field];
            if (textlib::strlen($data[$field]) > $ml) {
                $errors[$field] = $rp->get_string("error_invalid_{$field}_toolong", $ml);
            // Validate email
            } else if (!validate_email($data[$field])) {
                $errors[$field] = $rp->get_string('error_invalid_email');
            // Check if email already exists
            } else if ($DB->record_exists('user', array('email' => $data[$field]))) {
                $errors[$field]  = $rp->get_string('error_invalid_email_alreadyexists');
                if ($DB->record_exists('user', array('email' => $data['email'], 'confirmed' => '1'))) {
                    $errors[$field] .= '<br /><a href="' . $forgoturl . '">' . $rp->get_string('link_forgotaccount') . '</a>';
                } else {
                    $errors[$field] .= '<br /><a href="' . $resendurl . '">' . $rp->get_string('link_resendemail') . '</a>';
                }
            // Check if email is allowed
            } else if ($err = email_is_not_allowed($data[$field])) {
                $errors[$field] = $err;
            }

            // PASSWORD
            if (!empty($rp->theme->config->field_password->enabled)) {
                $field = 'password';
                if (!empty($data[$field])) {
                    // Check if password is valid
                    $errmsg = '';
                    $ml = $rp->maxlength[$field];
                    if (textlib::strlen($data[$field]) > $ml) {
                        $errors[$field] = $rp->get_string("error_invalid_{$field}_toolong", $ml);
                    } else if (!check_password_policy($data[$field], $errmsg)) {
                        $errors[$field] = $errmsg;
                    // Check if password is equal
                    } else if (!empty($rp->theme->config->field_password->repassword) &&
                        ($data[$field] !== $data['repassword']) ) {
                        $errors['repassword'] = $rp->get_string('error_invalid_password_passwordsnotequal');
                    }
                }
            }

            // USERNAME
            if (!empty($rp->theme->config->field_username->enabled)) {
                $field = 'username';
                if (!empty($data[$field])) {
                    $ml = $rp->maxlength[$field];
                    if (textlib::strlen($data[$field]) > $ml) {
                        $errors[$field] = $rp->get_string("error_invalid_{$field}_toolong", $ml);
                    // Check if username is valid
                    } else if (!preg_match('/[^-\.@_a-z0-9]/', $data[$field])) {
                        $errors[$field] = $rp->get_string('error_invalid_username_alphanumerical');
                    // Check if this username already exists
                    } else if ($DB->record_exists('user', array('username' => $data[$field], 'mnethostid' => $CFG->mnet_localhost_id))) {
                        $errors[$field]  = $rp->get_string('error_invalid_username_alreadyexists');
                        $errors[$field] .= '<br /><a href="' . $forgoturl . '">' . $rp->get_string('link_forgotaccount') . '</a>';
                    }
                }
            }
        }

        // NIF
        if (!empty($rp->theme->config->field_username->enabled)) {
            $field = 'nif';
            if (!empty($data[$field])) {
                $ml = $rp->maxlength[$field];
                if (textlib::strlen($data[$field]) > $ml) {
                    $errors[$field] = $rp->get_string("error_invalid_{$field}_toolong", $ml);
                } else {
                    // Check NIF integrity
                    $usernif = $data[$field];
                    $nif = local_order_rp_nif_parse($usernif);
                    // NIF is not DNI neither NIE or NIF/NIE letter is not correct
                    if (empty($nif->valid)) {
                    $errors[$field] = $rp->get_string('error_invalid_nif');
                    // Check if NIF already exists
                    } else {
                        $validnif = $nif->nif;
                        $nifsql = "SELECT u.id
                                   FROM {user} u
                                   JOIN {user_info_data} uid ON u.id = uid.userid
                                   JOIN {user_info_field} uif ON uif.id = uid.fieldid
                                   WHERE uid.data = '$validnif'
                                   AND uif.shortname = 'nif'
                                   AND u.deleted = '0'";
                        if ($DB->get_records_sql($nifsql)) {
                            $errors[$field] = $rp->get_string('error_invalid_nif_alreadyexists');
                        }
                    }
                }
            }
        }

        foreach ($rp->signup_config_fields as $field) {
            if ($field == 'nif') continue;

            $configfield = "field_$field";
            $config = $rp->theme->config->$configfield;
            if (!empty($config->enabled)) {
                $ml = $rp->maxlength[$field];
                if (!empty($data[$field]) && (textlib::strlen($data[$field]) > $ml) )  {
                    $errors[$field] = $rp->get_string("error_invalid_{$field}_toolong", $ml);
                }
            }
        }

        return $errors;
    }
}
