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
 * Registry Page Theme class
 *
 * @package   order:registry:theme:sample
 * @copyright 2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('MOODLE_INTERNAL')) die('');    ///  It must be included after moodle config.php

require_once(LOCAL_ORDER_RP_DIRROOT . '/lib.php');

define('LOCAL_ORDER_RP_THEME_INTERNAL', 'LocalOrderRegistryPageTheme');
define('LOCAL_ORDER_RP_THEME_DIRROOT', LOCAL_ORDER_RP_DIRROOT . '/themes/sample');

require_once(LOCAL_ORDER_RP_THEME_DIRROOT . '/forms/code_form.php');
require_once(LOCAL_ORDER_RP_THEME_DIRROOT . '/forms/login_form.php');
require_once(LOCAL_ORDER_RP_THEME_DIRROOT . '/forms/payoptions_form.php');
require_once(LOCAL_ORDER_RP_THEME_DIRROOT . '/forms/rempasswd_form.php');
require_once(LOCAL_ORDER_RP_THEME_DIRROOT . '/forms/setpasswd_form.php');
require_once(LOCAL_ORDER_RP_THEME_DIRROOT . '/forms/signup_form.php');

define('LOCAL_ORDER_RP_ACTION_SIGNUP',             'signup');
define('LOCAL_ORDER_RP_ACTION_LOGIN',              'login');
define('LOCAL_ORDER_RP_ACTION_LOGOUT',             'logout');
define('LOCAL_ORDER_RP_ACTION_SET_PASSWORD',       'setpasswd');
define('LOCAL_ORDER_RP_ACTION_VALIDATE',           'validate');
define('LOCAL_ORDER_RP_ACTION_SEND_CODE',          'sendcode');
define('LOCAL_ORDER_RP_ACTION_RESEND_CONFIRM',     'resendconfirm');
define('LOCAL_ORDER_RP_ACTION_REMEMBER_PASSWORD',  'rempasswd');
define('LOCAL_ORDER_RP_ACTION_PAY_OPTIONS',        'payoptions');
define('LOCAL_ORDER_RP_ACTION_PAID',               'paid');

class local_order_rp_sample extends local_order_rp {

    const ACTION_SIGNUP             = 'signup';
    const ACTION_LOGIN              = 'login';
    const ACTION_LOGOUT             = 'logout';
    const ACTION_SET_PASSWORD       = 'setpasswd';
    const ACTION_VALIDATE           = 'validate';
    const ACTION_SEND_CODE          = 'sendcode';
    const ACTION_RESEND_CONFIRM     = 'resendconfirm';
    const ACTION_REMEMBER_PASSWORD  = 'rempasswd';
    const ACTION_PAY_OPTIONS        = 'payoptions';
    const ACTION_PAID               = 'paid';

    /** @var $defaults Defaults values for user mapping */
    public $defaults = array(
        'country' => 'CA',
        'lang'    => 'en',
        'action'  => 'signup',
    );

    /** @var $maxlength Max lenghts for form fields */
    public $maxlength = array(
        'username'      => 100,
        'email'         => 100,
        'password'      => 32,
        'firstname'     => 100,
        'lastname'      => 100,
        'nif'           => 20,
        'institution'   => 40,
        'position'      => 255,
        'city'          => 120,
        'country'       => 2,
        'phone'         => 20,
        'phone_intcode' => 10,
        'privacy'       => 1,
        'code'          => 64,
        'paymode'       => 1,
        'promotional'   => 32,
    );

    public $signup_fixed_fields  = array('firstname', 'lastname');
    public $signup_config_fields = array('nif', 'institution', 'position', 'country', 'city',
                                         'phone', 'phone_intcode', 'privacy');

    public $countries_selection_codes = array(
        'ALL' => array (
            'AD', 'AE', 'AF', 'AG', 'AI', 'AL', 'AM', 'AN', 'AO', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AW',
            'AX', 'AZ', 'BA', 'BB', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BL', 'BM', 'BN', 'BO',
            'BR', 'BS', 'BT', 'BV', 'BW', 'BY', 'BZ', 'CA', 'CC', 'CD', 'CF', 'CG', 'CI', 'CK', 'CL',
            'CM', 'CN', 'CO', 'CR', 'CU', 'CV', 'CX', 'CY', 'CZ', 'DE', 'DJ', 'DK', 'DM', 'DO', 'DZ',
            'EC', 'EE', 'EG', 'EH', 'ER', 'ES', 'ET', 'FI', 'FJ', 'FK', 'FM', 'FO', 'FR', 'GA', 'GB',
            'GD', 'GE', 'GF', 'GG', 'GH', 'GI', 'GL', 'GM', 'GN', 'GP', 'GQ', 'GR', 'GS', 'GT', 'GU',
            'GW', 'GY', 'HK', 'HM', 'HN', 'HR', 'HT', 'HU', 'CH', 'ID', 'IE', 'IL', 'IM', 'IN', 'IO',
            'IQ', 'IR', 'IS', 'IT', 'JE', 'JM', 'JO', 'JP', 'KE', 'KG', 'KH', 'KI', 'KM', 'KN', 'KP',
            'KR', 'KW', 'KY', 'KZ', 'LA', 'LB', 'LC', 'LI', 'LK', 'LR', 'LS', 'LT', 'LU', 'LV', 'LY',
            'MA', 'MC', 'MD', 'ME', 'MF', 'MG', 'MH', 'MK', 'ML', 'MM', 'MN', 'MO', 'MP', 'MQ', 'MR',
            'MS', 'MT', 'MU', 'MV', 'MW', 'MX', 'MY', 'MZ', 'NA', 'NC', 'NE', 'NF', 'NG', 'NI', 'NL',
            'NO', 'NP', 'NR', 'NU', 'NZ', 'OM', 'PA', 'PE', 'PF', 'PG', 'PH', 'PK', 'PL', 'PM', 'PN',
            'PR', 'PS', 'PT', 'PW', 'PY', 'QA', 'RE', 'RO', 'RS', 'RU', 'RW', 'SA', 'SB', 'SC', 'SD',
            'SE', 'SG', 'SH', 'SI', 'SJ', 'SK', 'SL', 'SM', 'SN', 'SO', 'SR', 'ST', 'SV', 'SY', 'SZ',
            'TC', 'TD', 'TF', 'TG', 'TH', 'TJ', 'TK', 'TL', 'TM', 'TN', 'TO', 'TR', 'TT', 'TV', 'TW',
            'TZ', 'UA', 'UG', 'UM', 'US', 'UY', 'UZ', 'VA', 'VC', 'VE', 'VG', 'VI', 'VN', 'VU', 'WF',
            'WS', 'YE', 'YT', 'ZA', 'ZM', 'ZW',
        )
        // TODO, classificate then into regions
        // 'america' => '',
        // 'europe' => '',
        // 'africa' => '',
        // 'asia' => '',
        // 'middle_east' => '',
        // 'oceania' => '',
    );

    /* * /
    public function action_debug() {
        global $USER;

        $render = required_param('render', PARAM_ALPHA);

        switch ($render) {
            case 'payoptions':
                $orderid = optional_param('orderid', 0, PARAM_INT);
                $order = local_order::read($orderid);
                if (empty($order)) {
                    $order = local_order::create(1, $this);
                }
                $this->render->rpform = new local_order_rp_payoptions_form(null, $this);

                $this->render_pay('payoptions', $order);
                break;

            case 'free':
            case 'paypal':
            case 'banktransfer':
            case 'creditcard':
            case 'westernunion':
                $orderid = optional_param('orderid', 0, PARAM_INT);
                $order = local_order::read($orderid);
                if (empty($order)) {
                    $order = local_order::create(1, $this);
                }
                $this->render_pay($render, $order);
                break;

            default:
                $this->render_error_common("Unknown render = $render");
        }
    }
    /* */

    /**
     * ACTION : User signup/validate form
     *
     * @return void
     */
    public function action_signup() {
        global $USER;

        $this->render->rpform = new local_order_rp_signup_form(null, $this);
        $rpform =& $this->render->rpform;

        if ($rpform->is_submitted()) {
            $data = $rpform->get_data();
            if (empty($data)) {
                if ($this->theme->config->debug_enabled) $rpform->_debug_log_error();
                // Case 1 : Any error found, validation failed
                $this->render_error_signup();
            } else {
                // Case 2 : Submitted data validated
                // A. Mapping data into user object
                $user = $this->user_mapping($data, true);

                // B. Signup this user,
                //    and send emails (code and notification, if enabled)
                $user = local_order_user_signup($user, $this);
                if (!empty($user)) {
                    $user = local_order_user_login($user);
                    if ($this->user_confirm_enabled()) {
                        // Confirm user email
                        $this->render->rpform = new local_order_rp_code_form(null, $this);

                        // Show email sent info to user
                        $this->render_emailsent($user->email);
                    } else {
                        // Create order
                        $order = local_order::create($user->id, $this);
                        $this->render->rpform = new local_order_rp_payoptions_form(null, $this);

                        // Show payment options to user
                        $this->render_pay('payoptions', $order);
                    }
                } else {
                    $this->render_error_common($this->get_string('error_signing_up'));
                }
            }
        } else {
            // Case 3 : No data submitted, called to show signup form
            if (isloggedin()) {
                $user = local_order_user_load($USER->id);
                $this->form_mapping($user);
            }
            $this->render_signup();
        }
    }

    /**
     * ACTION : User try to login
     *
     * @return void
     */
    public function action_login() {
        $this->render->rpform = new local_order_rp_login_form(null, $this);
        $rpform =& $this->render->rpform;

        // Needs user not logged in
        if (isloggedin()) return $this->render_error_common($this->get_string('error_user_loggedin'));

        if ($rpform->is_submitted()) {
            $data = $rpform->get_data();
            if (empty($data)) {
                if ($this->theme->config->debug_enabled) $rpform->_debug_log_error();
                // Case 1 : Any error found, validation failed
                $this->render_error_login();
            } else {
                // Case 2 : Submitted data validated
                if ($user = local_order_check_login($data)) {
                    // Case 2A : Login successful
                    $this->render->rpform = new local_order_rp_signup_form(null, $this);
                    $this->form_mapping($user);
                    $this->render_signup();
               } else {
                    // Case 2B : Login failed
                    $this->render_error_login_failed();
               }
            }
        } else {
            // Case 3 : No data submitted, called to show login form
            $this->render_login();
        }
    }

    /**
     * ACTION : User wants logout
     *
     * @return void
     */
    public function action_logout() {
        $lang = $this->render_current_lang();
        require_logout();

        $redirecturl = new moodle_url($this->uri);
        redirect($redirecturl, $this->get_string('msg_logout_success', null, $lang));
    }

    /**
     * ACTION : Validate user data
     *
     * @return void
     */
    public function action_validate() {
        global $USER;

        // Needs user logged in
        if (!isloggedin()) return $this->render_error_common($this->get_string('error_user_not_loggedin'));

        $this->render->rpform = new local_order_rp_signup_form(null, $this);
        $rpform =& $this->render->rpform;

        if ($rpform->is_submitted()) {
            $data = $rpform->get_data();
            if (empty($data)) {
                if ($this->theme->config->debug_enabled) $rpform->_debug_log_error();
                // Case 1 : Any error found, validation failed
                $this->render_error_signup();
            } else {
                // Case 2 : Submitted data validated
                // A. Mapping data into user object
                $user = $this->user_mapping($data, true);

                // B. Signup this user,
                //    and send emails (code and notification, if enabled)
                $user = local_order_user_update($USER->id, $user, $this);
                if (!empty($user)) {
                    $user = local_order_user_login($user);
                    if ($this->user_confirm_enabled() && empty($user->confirmed)) {
                        $this->render->rpform = new local_order_rp_code_form(null, $this);
                        $this->render_emailsent($user->email, $this->get_string('warning_confirmation_resent'));
                    } else {
                        // Create order
                        $order = local_order::create($user->id, $this);
                        $this->render->rpform = new local_order_rp_payoptions_form(null, $this);

                        // Show payment options to user
                        $this->render_pay('payoptions', $order);
                    }
                } else {
                    $this->render_error_common($this->get_string('error_updating_up'));
                }
            }
        } else {
            // Case 3 : No data submitted, called to show signup form
            $user = local_order_user_load($USER->id);
            $this->form_mapping($user);
            $this->render_signup();
        }

    }

    /**
     * ACTION : User email confirmation form
     *
     * @return void
     */
    public function action_sendcode() {
        $this->render->rpform = new local_order_rp_code_form(null, $this);
        $rpform =& $this->render->rpform;

        // Get mandatory data from GET or POST
        $email = optional_param('email', '', PARAM_EMAIL);
        $code  = optional_param('code', '', PARAM_ALPHANUM);

        // 1. Check if form is submitted (POST)
        if ($rpform->is_submitted()) {
            $data = $rpform->get_data();
            if (empty($data)) {
                if ($this->theme->config->debug_enabled) $rpform->_debug_log_error();
                $this->render_error_emailsent($email);
                return;
            }
        }

        // 2. Check if user already confirmed
        if ($user = local_order_user_confirmed($email)) {
            // User confirmed
            if (isloggedin()) {
                $order = local_order::create($user->id, $this);
                $this->render->rpform = new local_order_rp_payoptions_form(null, $this);

                // Show payment options to user
                $this->render_pay('payoptions', $order);

            } else {
                // Go to login page, user must authenticate
                $this->render_login();
            }

        // 3. Check if email-code are correct
        } else if ($user = local_order_code_confirm($email, $code, $this)) {
            // User confirmed,
            $user = local_order_user_login($user);
            // Create order
            $order = local_order::create($user->id, $this);
            $this->render->rpform = new local_order_rp_payoptions_form(null, $this);

            // Show payment options to user
            $this->render_pay('payoptions', $order);

        // 4. User is not confirmed and email-code are invalid
        } else {
            // No data or invalid data
            $this->render->rpform->element_value_set('code', $code);
            $this->render_error_emailsent($email, $this->get_string('error_invalid_code'));
        }
    }

    /**
     * ACTION : User wants receive confirmation code email again
     *
     * @return void
     */
    public function action_resendconfirm() {
        // GET request
        $email = optional_param('email', '', PARAM_EMAIL);

        $confirm_enabled = $this->user_confirm_enabled();
        if (empty($confirm_enabled)) return $this->render_error_common($this->get_string('error_confirmation_disabled'));

        $user = local_order_user_load_by_email($email);
        if (empty($user)) return $this->render_error_common($this->get_string('error_not_found_loading_user_by_email'));
        if (!empty($user->confirmed)) return $this->render_error_common($this->get_string('error_email_already_confirmed'));

        if ($this->user_signup_confirm_resend($user)) {
            $this->render->rpform = new local_order_rp_code_form(null, $this);
            $this->render_emailsent($user->email, $this->get_string('warning_confirmation_resent'));
        } else {
            $this->render_error_common($this->get_string('error_sending_confirmation_email'));
        }
    }

    /**
     * ACTION : Pay options form
     *
     * @return void
     */
    public function action_payoptions() {
        global $USER;

        // Needs user logged in
        if (!isloggedin()) return $this->render_error_common($this->get_string('error_user_not_loggedin'));

        $this->render->rpform = new local_order_rp_payoptions_form(null, $this);
        $rpform =& $this->render->rpform;

        $orderid = optional_param('orderid', 0, PARAM_INT);
        $order = local_order::read($orderid);

        // Needs a valid order
        if (empty($order)) return $this->render_error_common($this->get_string('error_order_not_found'));

        if ($rpform->is_submitted()) {
            $data = $rpform->get_data();
            if (empty($data)) {
                if ($this->theme->config->debug_enabled) $rpform->_debug_log_error();
                // Case 1 : Any error found, validation failed
                $this->render_error_payoptions($order);
            } else {
                // Case 2 : Submitted data validated
                $order->confirm($data->paymode, $data->promotional);
                if ($order->entry->finalcost > 0) {
                    switch ($data->paymode) {
                        case local_order::PAYMODE_PAYPAL:       $this->render_pay('paypal', $order); break;
                        case local_order::PAYMODE_CREDITCARD:   $this->render_pay('creaditcard', $order); break;
                        case local_order::PAYMODE_BANKTRANSFER: $this->render_pay('banktransfer', $order); break;
                        case local_order::PAYMODE_WESTERNUNION: $this->render_pay('westernunion', $order); break;
                        default: $this->render_error_common($this->get_string('error_paymode_not_available'));
                    }
                } else {
                    $this->render_pay('free', $order);
                }
            }
        } else {
            // Case 3 : No data submitted, error this action can not be reached by GET
            $this->render_error_common($this->get_string('error_bad_params'));
        }
    }

    /**
     * ACTION : User has complete an order
     *
     * @return void
     */
    public function action_paid() {
        // Needs user logged in
        if (!isloggedin()) return $this->render_error_common($this->get_string('error_user_not_loggedin'));

    }

    /**
     * ACTION : User wants to remember his password
     *
     * @return void
     */
    public function action_rempasswd() {
        $this->render->rpform = new local_order_rp_rempasswd_form(null, $this);
        $rpform =& $this->render->rpform;

        if (!isloggedin()) {
            if ($rpform->is_submitted()) {
                $data = $rpform->get_data();
                if (empty($data)) {
                    if ($this->theme->config->debug_enabled) $rpform->_debug_log_error();
                    // Case 1 : Any error found, validation failed
                    $this->render_error_rempasswd();
                } else {
                    // Send remember password email
                    $user = local_order_user_load_by_email($data->email);
                    if (!empty($user)) {
                        if ($this->user_rempasswd_send($user)) {
                            $this->render_rempasswdinfo($user->email);
                        } else {
                            $this->render_error_common($this->get_string('error_sending_rempasswd_email'));
                        }
                    } else {
                        $this->render_error_common($this->get_string('error_not_found_loading_user_by_email'));
                    }
                }
            } else {
                // No data submitted, show form
                $this->render_rempasswd();
            }
        } else {
            $this->render_error_common($this->get_string('error_user_already_loggedin'));
        }
    }

    /**
     * ACTION : User tries to set password
     *
     * @return void
     */
    public function action_setpasswd() {
        $this->render->rpform = new local_order_rp_setpasswd_form(null, $this);
        $rpform =& $this->render->rpform;

        $email = optional_param('email', '', PARAM_EMAIL);
        $code  = optional_param('code', '', PARAM_ALPHANUM);

        // 1. Check if form is submitted (POST)
        if ($rpform->is_submitted()) {
            $data = $rpform->get_data();
            if (empty($data)) {
                if ($this->theme->config->debug_enabled) $rpform->_debug_log_error();
                $this->render_error_setpasswd($email, $code);
            } else if ($user = local_order_user_password_set($email, $code, $data->password)) {
                $user = local_order_user_load_by_email($email);
                $this->render_password_changed($user->username);
            } else {
                // No data or invalid data
                $this->render->rpform->element_value_set('code', $code);
                $this->render_error_common($this->get_string('error_setting_password'));
            }

        } else {
            // No data submitted, render form
            $this->render_setpasswd($email, $code);
        }
    }

    /**
     * RENDER ERROR : Common fatal errors
     *
     * @return void
     */
    public function render_error_common($msg) {
        $redirecturl = new moodle_url($this->uri);
        redirect($redirecturl, $msg);
    }

    /**
     * RENDER ERROR : User send data with errors in signup form
     *
     * @return void
     */
    public function render_error_signup() {
        // Sign up form will render showing errors between fields
        $this->render->_content     = 'signup';
        $this->render->formerrors   = true;
        $this->render->showlogin    = true;
    }

    /**
     * RENDER ERROR : User try to login, but from has bad data
     *
     * @return void
     */
    public function render_error_login() {
        $this->render->_content     = 'login';
        $this->render->formerrors   = true;
        $this->render->showlogin    = false;
    }

    /**
     * RENDER ERROR : User try to login, username or password are not valid
     *
     * @return void
     */
    public function render_error_login_failed() {
        $this->render->rpform->element_value_set('password', '');
        $this->render->error        = $this->get_string('error_invalid_login');

        $this->render->_content     = 'login';
        $this->render->formerrors   = false;
        $this->render->showlogin    = false;

    }

    /**
     * RENDER ERROR : User send data with errors in signup form
     *
     * @return void
     */
    public function render_error_payoptions($order) {
        $this->render->order        = $order;

        // Sign up form will render showing errors between fields
        $this->render->_content     = 'payoptions';
        $this->render->formerrors   = true;
        $this->render->showlogin    = true;
    }

    /**
     * RENDER ERROR : Email or code ar invalid
     *
     * @return void
     */
    public function render_error_emailsent($email, $error = '') {

        $this->render->error        = $error;
        $this->render->resendemail  = $email;

        $this->render->_content     = 'emailsent';
        if (empty($error)) $this->render->formerrors = true;
        else               $this->render->formerrors = false;
        $this->render->showlogin    = true;

    }

    /**
     * RENDER ERROR : Email is invalid or not exists
     *
     * @return void
     */
    public function render_error_rempasswd() {
        $this->render->_content     = 'rempasswd';
        $this->render->formerrors   = true;
        $this->render->showlogin    = true;
    }

    /**
     * RENDER ERROR : Invalid new password selected
     *
     * @return void
     */
    public function render_error_setpasswd($email, $code) {
        $this->render->email        = $email;
        $this->render->code         = $code;

        $this->render->_content     = 'setpasswd';
        $this->render->formerrors   = true;
        $this->render->showlogin    = true;
    }

    /**
     * RENDER : Email sent message and confirm code form
     *
     * @return void
     */
    public function render_emailsent($email, $warning = '') {

        $this->render->warning      = $warning;
        $this->render->email        = $email;
        $this->render->resendemail  = $email;

        $this->render->_content     = 'emailsent';
        $this->render->formerrors   = false;
        $this->render->showlogin    = true;

    }

    /**
     * RENDER : Sign up form
     *
     * @return void
     */
    public function render_signup() {
        $this->render->_content     = 'signup';
        $this->render->formerrors   = false;
        $this->render->showlogin    = true;
    }

    /**
     * RENDER : Pay options form
     *
     * @return void
     */
    public function render_pay($type, $order) {
        $this->render->order        = $order;

        if ($type == 'paypal') $this->render->paypalurl = $this->paypalurl($order);

        $this->render->_content     = $type;
        $this->render->formerrors   = false;
        $this->render->showlogin    = true;
    }

    /**
     * RENDER : Login form
     *
     * @return void
     */
    public function render_login() {
        $this->render->_content     = 'login';
        $this->render->formerrors   = false;
        $this->render->showlogin    = false;
    }

    /**
     * RENDER : Remember password form
     *
     * @return void
     */
    public function render_rempasswd() {
        $this->render->_content     = 'rempasswd';
        $this->render->formerrors   = false;
        $this->render->showlogin    = true;
    }

    /**
     * RENDER : Remember password info
     *
     * @return void
     */
    public function render_rempasswdinfo($email) {
        $this->render->email        = $email;

        $this->render->_content     = 'rempasswdinfo';
        $this->render->formerrors   = false;
        $this->render->showlogin    = true;
    }

    /**
     * RENDER : Set password form
     *
     * @return void
     */
    public function render_setpasswd($email, $code) {
        $this->render->email        = $email;
        $this->render->code         = $code;

        $this->render->_content     = 'setpasswd';
        $this->render->formerrors   = false;
        $this->render->showlogin    = true;
    }

    /**
     * RENDER : User password has been changed
     *
     * @return void
     */
    public function render_password_changed($username) {
        $this->render->username     = $username;

        $this->render->_content     = 'passwordchanged';
        $this->render->formerrors   = false;
        $this->render->showlogin    = true;
    }

    public function paypalurl($order) {
        $url = false;
        if (!empty($order->entry->uniqueid)) {
            $return = new moodle_url($this->uri, array('action' => self::ACTION_PAID));
            if (!empty($this->theme->config->paypal_order_prefix)) {
                $item_number = urlencode($this->theme->config->paypal_order_prefix .
                                         '-' . $order->entry->uniqueid);
            } else {
                $item_number = urlencode($order->entry->uniqueid);
            }
            $item_name = urlencode($this->config->paypal_description);
            $finalcost = round($order->entry->finalcost, 2);
            $url = "https://{$this->theme->config->paypal_backend}/cgi-bin/webscr?cmd=_ext-enter&redirect_cmd=_xclick" .
                   "&business={$this->theme->config->paypal_account}" .
                   "&return=$return" .
                   "&amount=$finalcost" .
                   "&item_number=$item_number" .
                   "&item_name=$item_name" .
                   "&no_shipping=1" .
                   "&currency_code={$order->entry->currency}";
        }

        return $url;
    }

    /**
     * LOG : User signup log
     *
     * @return void
     */
    public function log_signup($user) {
        global $CFG;

        $path = $CFG->dataroot . '/logs';
        if (is_dir($path)) {
            // Prepare user data to add to signup log
            unset($user->profile);
            $userarray = get_object_vars($user);
            $userarray = preg_replace('/;/i', ' ', $userarray);
            $userarray['registrypage'] = $this->entry->slug;

            // Log the row
            $logdata = implode(';', array_values($userarray)) . PHP_EOL;
            $logfile = $path . '/' . $this->theme->config->signup_log_file;
            if (!file_exists($logfile)) {
                $logheader = implode(';', array_keys($userarray)) . PHP_EOL;
                file_put_contents($logfile, $logheader, FILE_APPEND | LOCK_EX);
            }
            file_put_contents($logfile, $logdata, FILE_APPEND | LOCK_EX);
        }
    }

    /**
     * SIGNUP : User email confirmation
     *
     * @return bool True if ok, False if error
     */
    public function user_signup_confirm_send($user, $password = null) {
        $confirm_enabled = $this->user_confirm_enabled();
        if (empty($confirm_enabled)) return false;

        $to         = $user->email;
        $fromname   = (!empty($this->theme->config->user_confirm_fromname)) ?
                      $this->theme->config->user_confirm_fromname : '';
        $fromemail  = $this->theme->config->user_confirm_fromemail;

        // Confirmation link
        $link = new moodle_url($this->uri, array('lang'   => current_language(),
                                                 'action' => self::ACTION_SEND_CODE,
                                                 'code'   => $user->secret,
                                                 'email'  => $user->email) );

        $userpassword = (!empty($password)) ? $password : $this->get_string('only_you_known_the_password');

        $vars = new stdClass();
        $vars->site_shortname   = $this->theme->config->shortname;
        $vars->site_longname    = $this->theme->config->longname;
        $vars->moodle_www       = (string) new moodle_url('/');
        $vars->user_firstname   = $user->firstname;
        $vars->user_lastname    = $user->lastname;
        $vars->user_email       = $user->email;
        $vars->user_username    = $user->username;
        $vars->user_password    = $userpassword;
        $vars->user_secret      = $user->secret;
        $vars->link             = $link->out(false);
        $vars->sign_name        = $fromname;

        // Email subject
        $subject = $this->get_string('email_user_signup_confirm-subject', $vars);

        // Email message
        $message = $this->get_string('email_user_signup_confirm-message', $vars);

        return local_order_mail_send($to, $fromemail, $fromname, $subject, $message);
    }

    /**
     * SIGNUP : Re-send user email confirmation
     *
     * @return bool True if ok, False if error
     */
    public function user_signup_confirm_resend($user) {
        $confirm_enabled = $this->user_confirm_enabled();
        if (empty($confirm_enabled)) return false;

        $to         = $user->email;
        $fromname   = (!empty($this->theme->config->user_confirm_fromname)) ?
                      $this->theme->config->user_confirm_fromname : '';
        $fromemail  = $this->theme->config->user_confirm_fromemail;

        // Confirmation link
        $link = new moodle_url($this->uri, array('lang'   => current_language(),
                                                 'action' => self::ACTION_SEND_CODE,
                                                 'code'   => $user->secret,
                                                 'email'  => $user->email) );

        $vars = new stdClass();
        $vars->site_shortname   = $this->theme->config->shortname;
        $vars->site_longname    = $this->theme->config->longname;
        $vars->moodle_www       = (string) new moodle_url('/');
        $vars->user_firstname   = $user->firstname;
        $vars->user_lastname    = $user->lastname;
        $vars->user_email       = $user->email;
        $vars->user_username    = $user->username;
        $vars->user_secret      = $user->secret;
        $vars->link             = $link->out(false);
        $vars->sign_name        = $fromname;

        // Email subject
        $subject = $this->get_string('email_user_signup_confirm_resend-subject', $vars);

        // Email message
        $message = $this->get_string('email_user_signup_confirm_resend-message', $vars);

        return local_order_mail_send($to, $fromemail, $fromname, $subject, $message);
    }

    /**
     * SIGNUP : Notification to user when confirmation is ok
     *
     * @return bool True if ok, False if error
     */
    public function user_notify_signup_send($user) {
        $signup_enabled = $this->user_notify_signup_enabled();
        if (empty($signup_enabled)) return false;

        $to         = $user->email;
        $fromname   = (!empty($this->theme->config->user_notify_signup_fromname)) ?
                      $this->theme->config->user_notify_signup_fromname : '';
        $fromemail  = $this->theme->config->user_notify_signup_fromemail;

        $vars = new stdClass();
        $vars->site_shortname   = $this->theme->config->shortname;
        $vars->site_longname    = $this->theme->config->longname;
        $vars->moodle_www       = (string) new moodle_url('/');
        $vars->user_firstname   = $user->firstname;
        $vars->user_lastname    = $user->lastname;
        $vars->user_email       = $user->email;
        $vars->user_username    = $user->username;
        $vars->sign_name        = $fromname;

        // Email subject
        $subject = $this->get_string('email_user_notify_signup-subject', $vars);

        // Email message
        $message = $this->get_string('email_user_notify_signup-message', $vars);

        return local_order_mail_send($to, $fromemail, $fromname, $subject, $message);
    }

    /**
     * REMPASSWD : Remember password instruction
     *
     * @return bool True if ok, False if error
     */
    public function user_rempasswd_send($user) {
        global $DB;

        if (empty($user->email) || !validate_email($user->email)) return false;
        if (empty($user->confirmed)) return false;

        $user->secret = random_string(15);
        $DB->set_field('user', 'secret', $user->secret, array('id' => $user->id));

        $to         = $user->email;
        $fromname   = (!empty($this->theme->config->user_rempasswd_fromname)) ?
                      $this->theme->config->user_rempasswd_fromname : '';
        $fromemail  = $this->theme->config->user_rempasswd_fromemail;

        // Set password link
        $link = new moodle_url($this->uri, array('lang'   => current_language(),
                                                 'action' => self::ACTION_SET_PASSWORD,
                                                 'code'   => $user->secret,
                                                 'email'  => $user->email) );

        $vars = new stdClass();
        $vars->site_shortname   = $this->theme->config->shortname;
        $vars->site_longname    = $this->theme->config->longname;
        $vars->user_firstname   = $user->firstname;
        $vars->user_lastname    = $user->lastname;
        $vars->user_username    = $user->username;
        $vars->link             = $link->out(false);
        $vars->sign_name        = $fromname;

        // Email subject
        $subject = $this->get_string('email_user_rempasswd-subject', $vars);

        // Email message
        $message = $this->get_string('email_user_rempasswd-message', $vars);

        return local_order_mail_send($to, $fromemail, $fromname, $subject, $message);
    }

    public function order_email_info($order) {
        $info = new stdClass();
        $info->createdate = date('d/m/Y H:i:s', $order->entry->createdate);
        $info->paymode    = $this->get_string('paymode_unknown');
        switch($order->entry->paymode) {
            case local_order::PAYMODE_PAYPAL:       $info->paymode = $this->get_string('paymode_paypal'); break;
            case local_order::PAYMODE_BANKTRANSFER: $info->paymode = $this->get_string('paymode_banktransfer'); break;
            case local_order::PAYMODE_CREDITCARD:   $info->paymode = $this->get_string('paymode_creditcard'); break;
            case local_order::PAYMODE_WESTERNUNION: $info->paymode = $this->get_string('paymode_westernunion'); break;
        }
        $info->finalcost = $order->cost_show();

        $info->items = '';
        if (!empty($order->items)) {
            foreach($order->items as $item) {
                $cost = $item->cost_show();
                $name = $item->entry->name;
                $description = $item->entry->description;
                $info->items .= <<< EOM
   - [$name] $description : $cost\n
EOM;
            }
        }

        return $info;
    }

    /**
     * ORDER PENDING : Notification to user when confirm an order and
     * is validation pending (even free order)
     *
     * @return bool True if ok, False if error
     */
    public function user_notify_pending_send($order) {
        $enabled = $this->user_notify_pending_enabled();
        if (empty($enabled)) return false;

        $to         = $order->user->email;
        $fromname   = (!empty($this->theme->config->user_notify_pending_fromname)) ?
                      $this->theme->config->user_notify_pending_fromname : '';
        $fromemail  = $this->theme->config->user_notify_pending_fromemail;

        $info = $this->order_email_info($order);

        $vars = new stdClass();
        $vars->site_shortname   = $this->theme->config->shortname;
        $vars->site_longname    = $this->theme->config->longname;
        $vars->moodle_www       = (string) new moodle_url('/');
        $vars->user_firstname   = $order->user->firstname;
        $vars->user_lastname    = $order->user->lastname;
        $vars->user_email       = $order->user->email;
        $vars->user_username    = $order->user->username;
        $vars->sign_name        = $fromname;
        $vars->order_uniqueid   = $order->entry->uniqueid;
        $vars->createdate       = $info->createdate;
        $vars->paymode          = $info->paymode;
        $vars->finalcost        = $info->finalcost;
        $vars->items            = $info->items;

        // Email subject
        $subject = $this->get_string('email_user_notify_pending-subject', $vars);

        // Email message
        $message = $this->get_string('email_user_notify_pending-message', $vars);

        return local_order_mail_send($to, $fromemail, $fromname, $subject, $message);
    }

    /**
     * ORDER VALIDATE : Notification to user when order is validated
     * by admin (even free order)
     *
     * @return bool True if ok, False if error
     */
    public function user_notify_validate_send($order) {
        $enabled = $this->user_notify_validate_enabled();
        if (empty($enabled)) return false;

        $to         = $order->user->email;
        $fromname   = (!empty($this->theme->config->user_notify_validate_fromname)) ?
                      $this->theme->config->user_notify_validate_fromname : '';
        $fromemail  = $this->theme->config->user_notify_validate_fromemail;

        $info = $this->order_email_info($order);

        $vars = new stdClass();
        $vars->site_shortname   = $this->theme->config->shortname;
        $vars->site_longname    = $this->theme->config->longname;
        $vars->moodle_www       = (string) new moodle_url('/');
        $vars->user_firstname   = $order->user->firstname;
        $vars->user_lastname    = $order->user->lastname;
        $vars->user_email       = $order->user->email;
        $vars->user_username    = $order->user->username;
        $vars->sign_name        = $fromname;
        $vars->order_uniqueid   = $order->entry->uniqueid;
        $vars->createdate       = $info->createdate;
        $vars->paymode          = $info->paymode;
        $vars->finalcost        = $info->finalcost;
        $vars->items            = $info->items;

        // Email subject
        $subject = $this->get_string('email_user_notify_validate-subject', $vars);

        // Email message
        $message = $this->get_string('email_user_notify_validate-message', $vars);

        return local_order_mail_send($to, $fromemail, $fromname, $subject, $message);
    }

    /**
     * ORDER CANCEL : Notification to user when order is cancelled
     *
     * @return bool True if ok, False if error
     */
    public function user_notify_cancel_send($order) {
        $enabled = $this->user_notify_cancel_enabled();
        if (empty($enabled)) return false;

        $to         = $order->user->email;
        $fromname   = (!empty($this->theme->config->user_notify_cancel_fromname)) ?
                      $this->theme->config->user_notify_cancel_fromname : '';
        $fromemail  = $this->theme->config->user_notify_cancel_fromemail;

        $info = $this->order_email_info($order);

        $vars = new stdClass();
        $vars->site_shortname   = $this->theme->config->shortname;
        $vars->site_longname    = $this->theme->config->longname;
        $vars->moodle_www       = (string) new moodle_url('/');
        $vars->user_firstname   = $order->user->firstname;
        $vars->user_lastname    = $order->user->lastname;
        $vars->user_email       = $order->user->email;
        $vars->user_username    = $order->user->username;
        $vars->sign_name        = $fromname;
        $vars->order_uniqueid   = $order->entry->uniqueid;
        $vars->createdate       = $info->createdate;
        $vars->paymode          = $info->paymode;
        $vars->finalcost        = $info->finalcost;
        $vars->items            = $info->items;

        // Email subject
        $subject = $this->get_string('email_user_notify_cancel-subject', $vars);

        // Email message
        $message = $this->get_string('email_user_notify_cancel-message', $vars);

        return local_order_mail_send($to, $fromemail, $fromname, $subject, $message);
    }

    /**
     * ADMIN NOTIFY : A new user has signed up, unconfirmed yet
     *
     * @return bool True if ok, False if error
     */
    public function admin_notify_signup_send($user) {
        $signup_enabled = $this->admin_notify_signup_enabled();
        if (empty($signup_enabled)) return false;
        if (empty($this->config->admin_notify_signup_toemail)) return false;

        $to         = $this->config->admin_notify_signup_toemail;
        $fromname   = $this->theme->config->shortname;
        $fromemail  = $this->theme->config->admin_notify_signup_fromemail;

        // User profile link
        $link = new moodle_url('/user/view.php',
                               array('id' => $user->id) );

        $vars = new stdClass();
        $vars->site_shortname   = $this->theme->config->shortname;
        $vars->site_longname    = $this->theme->config->longname;
        $vars->moodle_www       = (string) new moodle_url('/');
        $vars->user_firstname   = $user->firstname;
        $vars->user_lastname    = $user->lastname;
        $vars->user_email       = $user->email;
        $vars->user_username    = $user->username;
        $vars->link             = $link->out(false);

        // Email subject
        $subject = $this->get_string('email_admin_notify_signup-subject', $vars);

        // Email message
        $message = $this->get_string('email_admin_notify_signup-message', $vars);

        return local_order_mail_send($to, $fromemail, $fromname, $subject, $message);
    }

    /**
     * ADMIN NOTIFY : An user has confirmed his email
     *
     * @return bool True if ok, False if error
     */
    public function admin_notify_confirmed_send($user) {
        $enabled = $this->admin_notify_confirmed_enabled();
        if (empty($enabled)) return false;
        if (empty($this->config->admin_notify_confirmed_toemail)) return false;

        $to         = $this->config->admin_notify_confirmed_toemail;
        $fromname   = $this->theme->config->shortname;
        $fromemail  = $this->theme->config->admin_notify_confirmed_fromemail;

        // User profile link
        $link = new moodle_url('/user/view.php',
                               array('id' => $user->id) );

        $vars = new stdClass();
        $vars->site_shortname   = $this->theme->config->shortname;
        $vars->site_longname    = $this->theme->config->longname;
        $vars->moodle_www       = (string) new moodle_url('/');
        $vars->user_firstname   = $user->firstname;
        $vars->user_lastname    = $user->lastname;
        $vars->user_email       = $user->email;
        $vars->user_username    = $user->username;
        $vars->link             = $link->out(false);

        // Email subject
        $subject = $this->get_string('email_admin_notify_confirmed-subject', $vars);

        // Email message
        $message = $this->get_string('email_admin_notify_confirmed-message', $vars);

        return local_order_mail_send($to, $fromemail, $fromname, $subject, $message);
    }

    /**
     * ADMIN NOTIFY : An user has confirmed an order
     *
     * @return bool True if ok, False if error
     */
    public function admin_notify_pending_send($order) {
        $enabled = $this->admin_notify_pending_enabled();
        if (empty($enabled)) return false;
        if (empty($this->config->admin_notify_pending_toemail)) return false;

        $to         = $this->config->admin_notify_pending_toemail;
        $fromname   = $this->theme->config->shortname;
        $fromemail  = $this->theme->config->admin_notify_pending_fromemail;

        // User profile link
        $userlink = new moodle_url('/user/view.php',
                                   array('id' => $order->user->id) );

        // Order link
        $orderlink = new moodle_url('/local/order/admin/details.php',
                                    array('orderid' => $order->entry->id) );
        $vars = new stdClass();
        $vars->site_shortname   = $this->theme->config->shortname;
        $vars->site_longname    = $this->theme->config->longname;
        $vars->moodle_www       = (string) new moodle_url('/');
        $vars->user_firstname   = $order->user->firstname;
        $vars->user_lastname    = $order->user->lastname;
        $vars->user_email       = $order->user->email;
        $vars->user_username    = $order->user->username;
        $vars->user_link        = $userlink->out(false);
        $vars->order_uniqueid   = $order->entry->uniqueid;
        $vars->order_link       = $orderlink->out(false);

        // Email subject
        $subject = $this->get_string('email_admin_notify_pending-subject', $vars);

        // Email message
        $message = $this->get_string('email_admin_notify_pending-message', $vars);

        return local_order_mail_send($to, $fromemail, $fromname, $subject, $message);
    }

    /**
     * ADMIN NOTIFY : Admin has validated an order
     *
     * @return bool True if ok, False if error
     */
    public function admin_notify_validate_send($order) {
        $enabled = $this->admin_notify_validate_enabled();
        if (empty($enabled)) return false;
        if (empty($this->config->admin_notify_validate_toemail)) return false;

        $to         = $this->config->admin_notify_validate_toemail;
        $fromname   = $this->theme->config->shortname;
        $fromemail  = $this->theme->config->admin_notify_validate_fromemail;

        // User profile link
        $userlink = new moodle_url('/user/view.php',
                                   array('id' => $order->user->id) );

        // Order link
        $orderlink = new moodle_url('/local/order/admin/details.php',
                                    array('orderid' => $order->entry->id) );

        $vars = new stdClass();
        $vars->site_shortname   = $this->theme->config->shortname;
        $vars->site_longname    = $this->theme->config->longname;
        $vars->moodle_www       = (string) new moodle_url('/');
        $vars->user_firstname   = $order->user->firstname;
        $vars->user_lastname    = $order->user->lastname;
        $vars->user_email       = $order->user->email;
        $vars->user_username    = $order->user->username;
        $vars->user_link        = $userlink->out(false);
        $vars->order_uniqueid   = $order->entry->uniqueid;
        $vars->order_link       = $orderlink->out(false);

        // Email subject
        $subject = $this->get_string('email_admin_notify_validate-subject', $vars);

        // Email message
        $message = $this->get_string('email_admin_notify_validate-message', $vars);

        return local_order_mail_send($to, $fromemail, $fromname, $subject, $message);
    }

    /**
     * ADMIN NOTIFY : An user or admin has cancelled an order
     *
     * @return bool True if ok, False if error
     */
    public function admin_notify_cancel_send($order) {
        $enabled = $this->admin_notify_cancel_enabled();
        if (empty($enabled)) return false;
        if (empty($this->config->admin_notify_cancel_toemail)) return false;

        $to         = $this->config->admin_notify_cancel_toemail;
        $fromname   = $this->theme->config->shortname;
        $fromemail  = $this->theme->config->admin_notify_cancel_fromemail;

        // User profile link
        $userlink = new moodle_url('/user/view.php',
                                   array('id' => $order->user->id) );

        // Order link
        $orderlink = new moodle_url('/local/order/admin/details.php',
                                    array('orderid' => $order->entry->id) );

        $vars = new stdClass();
        $vars->site_shortname   = $this->theme->config->shortname;
        $vars->site_longname    = $this->theme->config->longname;
        $vars->moodle_www       = (string) new moodle_url('/');
        $vars->user_firstname   = $order->user->firstname;
        $vars->user_lastname    = $order->user->lastname;
        $vars->user_email       = $order->user->email;
        $vars->user_username    = $order->user->username;
        $vars->user_link        = $userlink->out(false);
        $vars->order_uniqueid   = $order->entry->uniqueid;
        $vars->order_link       = $orderlink->out(false);

        // Email subject
        $subject = $this->get_string('email_admin_notify_cancel-subject', $vars);

        // Email message
        $message = $this->get_string('email_admin_notify_cancel-message', $vars);

        return local_order_mail_send($to, $fromemail, $fromname, $subject, $message);
    }

    /**
     * NIF parser
     *
     * Decode a NIF string in its standard parts as Spanish national specifications
     * @link http://es.wikipedia.org/wiki/N%C3%BAmero_de_identificaci%C3%B3n_fiscal
     *
     * @return object NIF parts, result->valid == false if not valid
     */
    public function nif_parse($nif) {
        $result = false;
        if (!empty($nif)) {
            $result = new stdClass();
            $result->valid = false;
            if (preg_match('/^[0-9]{1,8}[TRWAGMYFPDXBNJZSQVHLCKE]{1}/i', $nif)) {
                $result->type = 'dni';
            } else if (preg_match('/^[XYZ]{1}[0-9]{1,8}[TRWAGMYFPDXBNJZSQVHLCKE]{1}/i', $nif)) {
                $result->type = 'nie';
            } else {
                $result->type = false;
            }
            if ($result->type !== false) {
                $result->letter = strtoupper(preg_replace('/^[XYZ]{0,1}[0-9]{1,8}([TRWAGMYFPDXBNJZSQVHLCKE]{1})/i', '$1', $nif));
                $result->nieletter = strtoupper(preg_replace('/^([XYZ]{0,1})[0-9]{1,8}[TRWAGMYFPDXBNJZSQVHLCKE]{1}/i', '$1', $nif));
                $result->number = strtoupper(preg_replace('/^[XYZ]{0,1}([0-9]{1,8})[TRWAGMYFPDXBNJZSQVHLCKE]{1}/i', '$1', $nif));
                $result->value = strtr(strtoupper(preg_replace('/^([XYZ]{0,1}[0-9]{1,8})[TRWAGMYFPDXBNJZSQVHLCKE]{1}/i', '$1', $nif)), 'XYZ', '012');
                $result->code = substr("TRWAGMYFPDXBNJZSQVHLCKE", $result->value % 23, 1);
                if ($result->type == 'dni') {
                    $result->nif = str_pad($result->number, 8, '0', STR_PAD_LEFT) . $result->letter;
                } else if ($result->type == 'nie') {
                    $result->nif = $result->nieletter . str_pad($result->number, 7, '0', STR_PAD_LEFT) . $result->letter;
                }
            }
            if (($result->type !== false) && ($result->letter == $result->code)) $result->valid = true;
        }
        return $result;
    }

    /**
     * Read user language from browser accept language HTTP request header
     *
     * @return string Language ISO code
     */
    public function browser_language() {
       $lang = $this->defaults['lang'];
       if (!empty($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
          $langarray = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
          $lang = substr($langarray[0], 0, 2);
       }

       return $lang;
    }

    /**
     * Get countries list
     *
     * @return array Countries selected and translated
     */
    public function countries_list() {
        $config = !empty($this->theme->config->field_country->list) ? $this->theme->config->field_country->list : 'all';
        $selection = array();
        if (!is_array($config)) $selection[] = $config;
        else                    $selection   = $config;

        $countries = array();
        foreach ($selection as $selected) {
            $selected = textlib::strtoupper($selected);
            if (array_key_exists($selected, $this->countries_selection_codes)) {
                foreach($this->countries_selection_codes[$selected] as $code) {
                    $countries[$code] = get_string($code, 'countries');
                }

            } else if (array_key_exists($selected, $this->countries_selection_codes['ALL'])) {
                $countries[$selected] = get_string($selected, 'countries');

            }
        }

        return $countries;
    }

    /**
     * Get paymodes list
     *
     * @return array Paymodes selected and translated
     */
    public function paymodes_list() {

        $paymodes = array();
        if (!empty($this->theme->config->paypal_enabled))
            $paymodes[local_order::PAYMODE_PAYPAL] = $this->get_string('lbl_paymode_paypal');
        if (!empty($this->theme->config->creditcard_enabled))
            $paymodes[local_order::PAYMODE_CREDITCARD] = $this->get_string('lbl_paymode_creditcard');
        if (!empty($this->theme->config->transfer_enabled))
            $paymodes[local_order::PAYMODE_BANKTRANSFER] = $this->get_string('lbl_paymode_banktransfer');
        if (!empty($this->theme->config->western_enabled))
            $paymodes[local_order::PAYMODE_WESTERNUNION] = $this->get_string('lbl_paymode_westernunion');

        return $paymodes;
    }

    /**
     * Get timezone from country
     *
     * @param string Country ISO two-letter code
     * @return string Moodle timezone
     */
    public function timezone_by_country($country) {
        // TODO, now return server-time
        return '99';
    }

    /**
     * Define an username from data received from signup form
     *
     * Used when no 'username' is provided by user
     *
     * @param object $data Data received from form
     * @return string username
     */
    public function user_createusername($data) {
        global $CFG, $DB;

        $usingfirstname     = false;
        $usinglastname      = false;
        $firstnamefield     = 'firstname';
        $lastnamefield      = 'lastname';
        $emailfield         = 'email';

        if (!empty($data->$lastnamefield)) $usinglastname = true;
        if (!empty($data->$firstnamefield)) $usingfirstname = true;

        if (!empty($usingfirstname) && !empty($usinglastname)) {
            // CASE A : First letter of firstame and first word of lastname
            $username = textlib::substr($data->$firstnamefield, 0, 1)
                      . preg_replace('#\s+.*#', '', $data->$lastnamefield);
            $username = strtolower($username);
            $username = substr($username, 0, 20);
        } else if (!empty($usingfirstname)) {
            // CASE B : First 20 letters firstame with no spaces
            $username = preg_replace('#\s+#', '', $data->$firstnamefield);
            $username = strtolower($username);
            $username = substr($username, 0, 20);
        } else {
            // CASE C : Left part of email, erasing not valid characters
            $username = preg_replace('#(.*)@.*#', '$1', $data->$emailfield);
            $username = preg_replace('#[^-\.@_a-z0-9]#', '', $username);
            $username = strtolower($username);
        }

        if (!$DB->record_exists('user', array('username' => $username, 'mnethostid' => $CFG->mnet_localhost_id))) {
            return $username;
        }

        $rn = rand(10, 99);
        $candidate = $username . $rn;
        while ($DB->record_exists('user', array('username' => $candidate, 'mnethostid' => $CFG->mnet_localhost_id))) {
            $rn++;
            $candidate = $username . $rn;
        }

        return $candidate;
    }

    /**
     * Mapping signup/validate form data to user moodle object
     *
     * @param object $data Data received from form
     * @param bool $signup data received from signup form, user does not exist yet
     * @return object user moodle object
     */
    public function user_mapping($data, $signup = false) {
        $user = new stdClass();

        if (!isloggedin() && $signup) {
            // EMAIL (mandatory)
            $user->email = $data->email;

            // PASSWORD
            if (!empty($this->theme->config->field_password->enabled)) {
                if (!empty($data->password)) {
                    $user->password = $data->password;
                } else {
                    $user->password = generate_password(12);
                }
            } else {
                $user->password = generate_password(12);
            }

            // USERNAME
            if (!empty($this->theme->config->field_username->enabled)) {
                if (!empty($data->username)) {
                    $user->username = $data->username;
                } else {
                    $user->username = $this->user_createusername($data);
                }
            } else {
                $user->username = $this->user_createusername($data);
            }
        }

        // FIRSTNAME & LASTNAME
        $user->firstname = $data->firstname;
        $user->lastname  = $data->lastname;

        // NIF
        if ($signup) $user->profile_field_nif = '';
        if (!empty($this->theme->config->field_nif->enabled)) {
            $field = 'nif';
            if (!empty($data->$field)) $user->profile_field_nif = $data->$field;
        }

        // INSTITUTION
        if ($signup) $user->institution = '';
        if (!empty($this->theme->config->field_institution->enabled)) {
            $field = 'institution';
            if (!empty($data->$field)) $user->institution = $data->$field;
        }

        // POSITION
        if ($signup) $user->profile_field_position = '';
        if (!empty($this->theme->config->field_position->enabled)) {
            $field = 'position';
            if (!empty($data->$field)) $user->profile_field_position = $data->$field;
        }

        // COUNTRY
        if ($signup) $user->country = $this->defaults['country'];
        if (!empty($this->theme->config->field_country->enabled)) {
            $field = 'country';
            if (!empty($data->$field)) $user->country = $data->$field;
        }

        // CITY
        if ($signup) $user->city = '';
        if (!empty($this->theme->config->field_city->enabled)) {
            $field = 'city';
            if (!empty($data->$field)) $user->city = $data->$field;
        }

        // PHONE
        if ($signup) $user->phone1 = '';
        if (!empty($this->theme->config->field_phone->enabled)) {
            $field = 'phone';
            if (!empty($data->$field)) $user->phone1 = $data->$field;
        }

        // PHONE INTCODE
        if ($signup) $user->profile_field_phoneintcode = '';
        if (!empty($this->theme->config->field_phone_intcode->enabled)) {
            $field = 'phone_intcode';
            if (!empty($data->$field)) $user->profile_field_phoneintcode = $data->$field;
        }

        // PRIVACY POLICY
        if ($signup) $user->profile_field_privacypolicy = 0;
        if (!empty($this->theme->config->field_privacy->enabled)) {
            $field = 'privacy';
            if (!empty($data->$field)) $user->profile_field_privacypolicy = 1;
        }

        if ($signup) $user->lang        = $this->browser_language(); // LANGUAGE
        if ($signup) $user->phone2      = ''; // MOBILE
        if ($signup) $user->address     = ''; // ADDRESS
        if ($signup) $user->department  = ''; // DEPARTMENT
        if ($signup) $user->timezone    = $this->timezone_by_country($user->country); // TIMEZONE
        if ($signup) $user->url         = ''; // URL
        if ($signup) $user->icq         = ''; // ICQ
        if ($signup) $user->skype       = ''; // SKYPE
        if ($signup) $user->yahoo       = ''; // YAHOO
        if ($signup) $user->aim         = ''; // AIM
        if ($signup) $user->msn         = ''; // MSN
        if ($signup) $user->idnumber    = ''; // IDNUMBER
        if ($signup) $user->maildisplay = $this->theme->config->maildisplay; // MAILDISPLAY
        if ($signup) $user->description = ''; // DESCRIPTION

        return $user;
    }

    /**
     * Mapping user moodle object to signup/validate form
     *
     * @param object $user
     * @return void
     */
    public function form_mapping($user) {
        if (!empty($this->render->rpform)) {
            $rpform =& $this->render->rpform;

            // Map fixed fields
            $rpform->element_value_set('email', $user->email);
            $rpform->element_value_set('username', $user->username);
            $rpform->element_value_set('firstname', $user->firstname);
            $rpform->element_value_set('lastname', $user->lastname);

            // Map config fields from user
            $rpform->element_value_set('institution', $user->institution);
            $rpform->element_value_set('country', $user->country);
            $rpform->element_value_set('city', $user->city);
            $rpform->element_value_set('phone', $user->phone1);

            // Map config fields from user profile
            if (!empty($user->profile_field_nif)) $rpform->element_value_set('nif', $user->profile_field_nif);
            if (!empty($user->profile_field_position)) $rpform->element_value_set('position', $user->profile_field_position);
            if (!empty($user->profile_field_phoneintcode)) $rpform->element_value_set('phone_intcode', $user->profile_field_phoneintcode);
            if (!empty($user->profile_field_privacypolicy)) $rpform->element_value_set('privacy', $user->profile_field_privacypolicy);

        }
    }

    /**
     * MAILCHIMP : User data to mailchimp merge vars mapping
     *
     * @return array Merge vars with user data assigned
     */
    public function mailchimp_mapping($user) {
        $merge_vars = array();
        $merge_vars['NOMBRE']   = $user->firstname;
        $merge_vars['APELLIDO'] = $user->lastname;
        if ($this->theme->config->field_country->enabled)       $merge_vars['PAIS']   = get_string_manager()->get_string($user->country, 'countries', null, 'es');
        if ($this->theme->config->field_city->enabled)          $merge_vars['CIUDAD'] = $user->city;
        if ($this->theme->config->field_institution->enabled)   $merge_vars['INSTI']  = $user->institution;
        if ($this->theme->config->field_position->enabled)      $merge_vars['CIUDAD'] = $user->profile_field_position;
        $merge_vars['LASTRP'] = $this->config->name;

        $topics = '';
        $selectedtopics = $this->config->mailchimp_topics;
        if (!empty($selectedtopics)) $topics = implode(',', $selectedtopics);
        $merge_vars['GROUPINGS'] = array(
            array('name'    => $this->theme->config->mailchimp_topic_field,
                  'groups'  => $topics),
            array('name'    => $this->theme->config->mailchimp_type_field,
                  'groups'  => $this->theme->config->mailchimp_type));

        return $merge_vars;
    }

    /**
     * CONFIG : Get configuration values
     *
     * @return mixed
     */
    public function user_confirm_enabled()              { return $this->theme->config->user_confirm_enabled; }
    public function user_confirm_hide_pass()            { return $this->theme->config->user_confirm_hide_pass; }
    public function user_notify_signup_enabled()        { return $this->theme->config->user_notify_signup_enabled; }
    public function user_notify_pending_enabled()       { return $this->theme->config->user_notify_pending_enabled; }
    public function user_notify_validate_enabled()      { return $this->theme->config->user_notify_validate_enabled; }
    public function user_notify_cancel_enabled()        { return $this->theme->config->user_notify_cancel_enabled; }
    public function admin_notify_signup_enabled()       { return $this->theme->config->admin_notify_signup_enabled; }
    public function admin_notify_confirmed_enabled()    { return $this->theme->config->admin_notify_confirmed_enabled; }
    public function admin_notify_pending_enabled()      { return $this->theme->config->admin_notify_pending_enabled; }
    public function admin_notify_validate_enabled()     { return $this->theme->config->admin_notify_validate_enabled; }
    public function admin_notify_cancel_enabled()       { return $this->theme->config->admin_notify_cancel_enabled; }
    public function signup_log_enabled()                { return $this->theme->config->signup_log_enabled; }
    public function mailchimp_enabled()                 { return $this->theme->config->mailchimp_enabled; }
    public function mailchimp_apikey_get()              { return $this->theme->config->mailchimp_apikey; }
    public function mailchimp_list_get()                { return $this->theme->config->mailchimp_list; }
    public function order_currency_get()                { return $this->config->order_currency; }
    public function order_cost_get()                    { return $this->config->order_cost; }
    public function order_name_get()                    { return $this->config->name; }
    public function order_description_get()             { return $this->config->title; }
    public function order_prefix_get()                  { return $this->config->order_prefix; }
}





