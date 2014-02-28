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
 * Registry pages - Theme SAMPLE - English
 *
 * @package   order
 * @copyright 2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('LOCAL_ORDER_RP_INTERNAL')) die('');    ///  It must be included after Registry index page

// Forms
$rp_string['select_option_empty'] = 'Select ...';
$rp_string['form_required_info'] = 'Fields with (*) are mandatory.';
$rp_string['form_there_are_errors'] = 'There are errors in form.';
$rp_string['form_signup_legend'] = 'Sign in';
$rp_string['form_validate_legend'] = 'Confirm your profile data';
$rp_string['form_login_legend'] = 'Access with your user account';
$rp_string['form_emailsent_legend'] = 'We need to confirm your registration';
$rp_string['form_emailsent_info'] = '<p>An email has been sent to this address:</p>
<center><p class="emailinfo">{$a}</p></center>
<p>It contents a link.</p>
<p>In order to verify that this email address is valid,
   please, follow the link received.</p>
<p><strong>¡WARNING!</strong> Maybe you should find this email in spam folder.</p>
';
$rp_string['form_rempasswd_legend'] = 'Remember password';
$rp_string['form_rempasswd_instructions'] = 'Enter the email you used to register';
$rp_string['form_rempasswdinfo_legend'] = 'Instructions sent';
$rp_string['form_rempasswdinfo_instructions'] = '<p>A email message has been sento to:</p>
<center><p class="emailinfo">{$a}</p></center>
<p>This email content instructions to recover your password.</p>
<p>Please, follow the link included in the email message to continue recovering process.</p>
';
$rp_string['form_setpasswd_legend'] = 'New password';
$rp_string['form_setpasswd_instructions'] = '<p>Enter a new easy remember password</p>';
$rp_string['form_password_changed_legend'] = 'Password changed';
$rp_string['form_password_changed_instructions'] = '<p>Your password has been changed</p>
<h3>Next steps</h3>
<ol>
    <li>{$a->link}</li>
    <li>Use your username : {$a->username}</li>
    <li>Use your new password</li>
</ol>
';
$rp_string['form_payoptions_legend'] = 'Order confirmation';
$rp_string['form_banktransfer_legend'] = 'Bank transfer paymode';
$rp_string['form_creditcard_legend'] = 'Credit card paymode';
$rp_string['form_paypal_legend'] = 'PayPal<sup>&trade;</sup> paymode';
$rp_string['form_westernunion_legend'] = 'Western Union<sup>&trade;</sup> paymode';
$rp_string['form_free_legend'] = 'Order confirmed';

$rp_string['order_details'] = 'Order details';
$rp_string['order_details_title_name'] = 'Code';
$rp_string['order_details_title_description'] = 'Description';
$rp_string['order_details_title_cost'] = 'Amount';
$rp_string['order_details_no_items'] = 'There is no items in this order';
$rp_string['order_details_total'] = 'TOTAL';
$rp_string['order_info_total_lbl'] = 'Total amount';
$rp_string['order_info_concept_lbl'] = 'Concept';
$rp_string['order_info_bank_lbl'] = 'Bank';
$rp_string['order_info_bank_swift_lbl'] = 'SWIFT';
$rp_string['order_info_bank_aba_lbl'] = 'ABA';
$rp_string['order_info_bank_address_lbl'] = 'Bank address';
$rp_string['order_info_payee_account_lbl'] = 'Account number';
$rp_string['order_info_payee_name_lbl'] = 'Payee name';
$rp_string['order_info_payee_address_lbl'] = 'Payee address';
$rp_string['order_info_creditcard'] = 'TODO : Not implemented paymode';
$rp_string['order_info_banktransfer'] = 'Make a bank transfer and send payment proof to this email : {$a}';
$rp_string['order_info_westernunion'] = 'Pay at your Wester Union<sup>&trade;</sup> office and send payment proof to this email : {$a}';
$rp_string['order_info_paypal'] = 'Click next link to pay:';
$rp_string['order_info_paypal_link'] = 'Pay via PayPal<sup>&trade;</sup>';
$rp_string['order_confirm_free'] = 'This order is free. If you are agreed, confirm it.';
$rp_string['order_info_free'] = 'This order is free, but must be validated by an admin.';

$rp_string['lbl_email'] = 'Email';
$rp_string['placeholder_email'] = 'your email';
$rp_string['lbl_firstname'] = 'First name';
$rp_string['placeholder_firstname'] = 'your first name';
$rp_string['lbl_lastname'] = 'Last name';
$rp_string['placeholder_lastname'] = 'your last name';
$rp_string['lbl_institution'] = 'Institution';
$rp_string['placeholder_institution'] = 'your university, organization, company, ...';
$rp_string['lbl_position'] = 'Position';
$rp_string['placeholder_position'] = 'your position in that organization';
$rp_string['lbl_country'] = 'Residence country';
$rp_string['lbl_city'] = 'Residence city';
$rp_string['placeholder_city'] = 'the city where you actually live';
$rp_string['lbl_phone'] = 'Contact phone or mobile';
$rp_string['placeholder_phone'] = '555123123';
$rp_string['lbl_phone_intcode'] = 'International prefix';
$rp_string['placeholder_phone_intcode'] = '+1';
$rp_string['lbl_privacy'] = 'I accept <a href="#modalPrivacy" data-toggle="modal">privacy policy</a>';
$rp_string['lbl_username'] = 'Username';
$rp_string['placeholder_username'] = 'your username';
$rp_string['lbl_password'] = 'Password';
$rp_string['placeholder_password'] = 'your password';
$rp_string['lbl_repassword'] = 'Reply your password';
$rp_string['placeholder_repassword'] = 'the same password';
$rp_string['lbl_code'] = 'Email confirmation code';
$rp_string['placeholder_code'] = 'write here the code sent by email to you';
$rp_string['lbl_paymode'] = 'Paymode';
$rp_string['lbl_paymode_paypal'] = 'PayPal<sup>&trade;</sup>';
$rp_string['lbl_paymode_banktransfer'] = 'Bank transfer';
$rp_string['lbl_paymode_creditcard'] = 'Credit card';
$rp_string['lbl_paymode_westernunion'] = 'Western Union<sup>&trade;</sup>';
$rp_string['lbl_promotional'] = 'Promotional code';
$rp_string['placeholder_promotional'] = 'enter the code for a discount';

$rp_string['msg_logout_success'] = 'Your session has successfully terminated';

// Edit form
$rp_string['legend_admin_registry_page_general'] = 'General';
$rp_string['lbl_name'] = 'Name';
$rp_string['lbl_title'] = 'Title';
$rp_string['lbl_description'] = 'Description';
$rp_string['lbl_contact_email'] = 'Email';
$rp_string['legend_admin_registry_page_classification'] = 'Clasification';
$rp_string['lbl_mailchimp_selectone'] = 'Select one topic';
$rp_string['lbl_mailchimp'] = 'Main Mailchimp topic';
$rp_string['lbl_mailchimpother'] = 'Secondary Mailchimp topic';
$rp_string['legend_admin_registry_page_notifications'] = 'Admin notifications';
$rp_string['lbl_admin_notify_signup_toemail'] = 'Email for user sign up notifications';
$rp_string['lbl_admin_notify_confirmed_toemail'] = 'Email for user confirm notifications';
$rp_string['lbl_admin_notify_pending_toemail'] = 'Email for pending order notification';
$rp_string['lbl_admin_notify_validate_toemail'] = 'Email for validated order notification';
$rp_string['lbl_admin_notify_cancel_toemail'] = 'Email for cancel order notification';
$rp_string['legend_admin_registry_page_call'] = 'Call';
$rp_string['lbl_call_url'] = 'Call URL';
$rp_string['lbl_call_pdf'] = 'Call PDF url';
$rp_string['legend_admin_registry_page_banner'] = 'Banner';
$rp_string['lbl_banner_url'] = 'Target URL';
$rp_string['lbl_banner_img'] = 'Image URL';
$rp_string['lbl_banner_alt'] = 'Alternative text';
$rp_string['legend_admin_registry_page_dates'] = 'Dates';
$rp_string['legend_admin_registry_page_order'] = 'Order';
$rp_string['lbl_order_prefix'] = 'Prefix';
$rp_string['lbl_order_currency'] = 'Currency';
$rp_string['lbl_order_cost'] = 'Price';
$rp_string['lbl_paypal_description'] = 'PayPal description';
$rp_string['legend_admin_registry_page_discount_graduate'] = 'Graduated discount';
$rp_string['legend_admin_registry_page_discount_additional'] = 'Additional participant discount';
$rp_string['legend_admin_registry_page_discount_groups'] = 'Group discount';
$rp_string['lbl_discount_code'] = 'Code';
$rp_string['lbl_discount_qty'] = 'Qty to discount';
$rp_string['lbl_discount_name'] = 'Name';
$rp_string['lbl_discount_description'] = 'Description';
$rp_string['legend_admin_registry_page_discount_members'] = 'Members discount';
$rp_string['legend_admin_registry_page_discount_group_members'] = 'Member groups discount';
$rp_string['legend_admin_registry_page_discount_variable'] = 'Variable discount';
$rp_string['default_discount_graduate_description'] = 'Graduated discount';
$rp_string['default_discount_additional_description'] = 'Additional participant discount';
$rp_string['default_discount_groups_description'] = 'Discount for groups';
$rp_string['default_discount_members_description'] = 'Discount to members';
$rp_string['default_discount_group_members_description'] = 'Discount for groups of members';
$rp_string['default_discount_variable_description'] = 'Personal discount';

// Buttons
$rp_string['btn_login'] = "Login";
$rp_string['btn_login_page'] = 'Login page';
$rp_string['btn_logout'] = "Logout";
$rp_string['btn_changeuser'] = 'User change';
$rp_string['btn_close'] = "Close";
$rp_string['btn_signup'] = 'Sign up';
$rp_string['btn_validate'] = 'Sign up';
$rp_string['btn_sendcode'] = 'Send code';
$rp_string['btn_resend'] = 'Resend email';
$rp_string['btn_return_to_login'] = 'Return to login';
$rp_string['btn_rempasswd'] = 'Remember password';
$rp_string['btn_setpasswd'] = 'Set password';
$rp_string['btn_pay'] = 'Pay';
$rp_string['btn_confirm_order'] = 'Confirm order';

// Header
$rp_string['if_you_are_already_student'] = 'If you are already a student';

$rp_string['only_you_known_the_password'] = '[Only you know your password]';

// Common labels
$rp_string['lbl_signup'] = 'Sign up';
$rp_string['lbl_dates_and_prices'] = 'Dates and price';
$rp_string['lbl_date_last_call'] = "Last call date";
$rp_string['lbl_date_start'] = "Start date";
$rp_string['lbl_date_end'] = "End date";
$rp_string['lbl_time'] = "Teaching hours";
$rp_string['lbl_price'] = "Price";
$rp_string['lbl_more_info'] = 'More info';
$rp_string['lbl_call'] = 'Call';
$rp_string['lbl_contact'] = 'Contact';
$rp_string['lbl_notes'] = 'Notes';
$rp_string['lbl_note1'] = 'If you need more information or help for sign up, don\'t be hesiate to contact us at <a href="mailto:{$a}">{$a}</a>';
$rp_string['lbl_note2'] = 'If your organization is member of My Organization, please contact us to know available discounts.';
$rp_string['lbl_note3'] = 'If you are graduate of Colegio de las Américas, please contact us to know your special discount.';

// Paymodes
$rp_string['paymode_unknown'] = 'No paymode';
$rp_string['paymode_paypal'] = 'PayPal';
$rp_string['paymode_banktransfer'] = 'Bank transfer';
$rp_string['paymode_creditcard'] = 'Creadit card';
$rp_string['paymode_westernunion'] = 'Western Union';


// Privacy policy
$rp_string['title_privacy_policy'] = 'Privacy policy';
$rp_string['content_privacy_policy'] = '<p>My organization (hereinafter MYORG) is the owner of this site, and this document reflects the commitment of privacy you agree to know and accept.</p>
<p>In this website there through the forms we request personal information in order to enroll the user in the online courses offered MYORG and keep you informed of activities promoted by MYORG</p>
<p>Users agree to provide truthful and authentic information to the organization. In case of default the user is responsible for the damage that such information has been generated to MYORG or third parties.</p>
<p>Your data may be communicated to the promoters of the activity and whose identity can be found on the same page where the form is located.</p>
<p>In case you have any concerns regarding your personal data, or want partial or total cancellation of the same, please write an email to the following address <a href="mailto:info@example.edu">info@example.edu</a></p>
<p>&nbsp;</p>
<p><strong>Term and amend this data protection policy</strong></p>
<p>This privacy policy is effective from January 1, 2013.</p>
<p>MYORG reserves the right to modify its privacy policy. If there is any change in this policy, the new text will be published in the same direction.</p>';

// Warnings
$rp_string['warning_confirmation_resent'] = 'An email with confirmation code has been resend';

// Errors
$rp_string['error_unknown_action'] = 'ERROR : Unknown action';
$rp_string['error_layout_not_found'] = 'ERROR : No file found to render layout "$a"';
$rp_string['error_no_layout'] = 'ERROR : No layout to render';
$rp_string['error_registry_page_not_loaded'] = 'ERROR : Registry page not loaded';
$rp_string['error_bad_sesskey'] = 'ERROR : Expired or invalid session';
$rp_string['error_signing_up'] = 'ERROR : While signing up user';
$rp_string['error_updating_up'] = 'ERROR : While updating user data';
$rp_string['error_user_not_loggedin'] = 'ERROR : You are not logged in or session expired';
$rp_string['error_user_already_loggedin'] = 'ERROR : You are already logged in';
$rp_string['error_sending_rempasswd_email'] = 'ERROR : While sending password recover instructions by email';
$rp_string['error_sending_confirmation_email'] = 'ERROR : While sending confirmation code by email';
$rp_string['error_not_found_loading_user_by_email'] = 'ERROR : There is no user with this email';
$rp_string['error_setting_password'] = 'ERROR : While changing user password';
$rp_string['error_confirmation_disabled'] = 'ERROR : Email confirmation is not activated';
$rp_string['error_email_already_confirmed'] = 'ERROR : This email is already confirmed';
$rp_string['error_order_not_found'] = 'ERROR : Order not found';

$rp_string['error_invalid_login'] = 'Username or password are not valid';
$rp_string['error_invalid_email'] = 'Email is not valid';
$rp_string['error_invalid_email_toolong'] = 'Email is too long';
$rp_string['error_invalid_email_notexists'] = 'Email doesn\'t exist';
$rp_string['error_invalid_password_toolong'] = 'Password is too long';
$rp_string['error_invalid_password_passwordsnotequal'] = 'Password are not equal';
$rp_string['error_invalid_email_alreadyexists'] = 'Email already exists';
$rp_string['error_invalid_username_toolong'] = 'Username is too long';
$rp_string['error_invalid_username_alphanumerical'] = 'Username can only content leters and numbers';
$rp_string['error_invalid_username_alreadyexists'] = 'Username already exists';
$rp_string['error_invalid_nif'] = 'NIF is not valid';
$rp_string['error_invalid_nif_toolong'] = 'NIF is too long';
$rp_string['error_invalid_nif_alreadyexists'] = 'NIF already exists';
$rp_string['error_invalid_institution_toolong'] = 'Institution is too long';
$rp_string['error_invalid_position_toolong'] = 'Position is too long';
$rp_string['error_invalid_country_toolong'] = 'Country code is too long';
$rp_string['error_invalid_city_toolong'] = 'City is too long';
$rp_string['error_invalid_phone_toolong'] = 'Phone number is too long';
$rp_string['error_invalid_phone_intcode_toolong'] = 'Internation pefix is too long';
$rp_string['error_invalid_privacy_toolong'] = 'Privacy policy is too long';
$rp_string['error_invalid_code'] = 'Confirmation code is not valid or already used';
$rp_string['error_invalid_code_toolong'] = 'Confirmation code is too long';
$rp_string['error_invalid_paymode_toolong'] = 'Paymode is too long';

$rp_string['link_forgotaccount'] = 'Recover your password';
$rp_string['link_resendemail'] = 'Resend confirmation email';

// Missing fields errors
$rp_string['missing_code'] = 'Confirmation code is missing';
$rp_string['missing_email'] = 'Email is missing';
$rp_string['missing_username'] = 'Username is missing';
$rp_string['missing_password'] = 'Password is missing';
$rp_string['missing_repassword'] = 'Re-enter password';
$rp_string['missing_paymode'] = 'Paymode is missing';
$rp_string['missing_firstname'] = 'First name is missing';
$rp_string['missing_lastname'] = 'Last name is missing';
$rp_string['missing_nif'] = 'NIF is missing';
$rp_string['missing_institution'] = 'Institution is missing';
$rp_string['missing_position'] = 'Position is missing';
$rp_string['missing_country'] = 'Country is missing';
$rp_string['missing_city'] = 'City is missing';
$rp_string['missing_phone'] = 'Phone number is missing';
$rp_string['missing_phone_intcode'] = 'Internationa prefix is missing';
$rp_string['missing_privacy'] = 'You have to accept our privacy policy to continue';

// Email messages
// CONFIRM SIGNUP ------------------------------------------------------------------
$rp_string['email_user_signup_confirm-subject'] = '[{$a->site_shortname}] Confirmation code';
$rp_string['email_user_signup_confirm-message'] = 'Hi {$a->user_firstname} {$a->user_lastname},

You have sent your data in order to sign up.
We need to confirm you email address ({$a->user_email}) before continue.

You can click the next link and continue sign up process:
{$a->link}

Please, DO NOT ERASE this email. These are you access credentials for future use:
----------------------------------------
Access URL  : {$a->moodle_www}
Username    : {$a->user_username}
Password    : {$a->user_password}
----------------------------------------

NOTE: If you have receive this email by mistake or you don\'t know why you have received it,
      and you are not signing up in "{$a->site_longname}", you don\'t have to do anything.
      If you don\'t confirm it, this request will be erase in a few hours.

Best regards,
{$a->sign_name}
';

// CONFIRM SIGNUP RESEND ------------------------------------------------------------------
$rp_string['email_user_signup_confirm_resend-subject'] = '[{$a->site_shortname}] Confirmation code resent';
$rp_string['email_user_signup_confirm_resend-message'] = 'Hi {$a->user_firstname} {$a->user_lastname},

You have requested to resend confirmation email link.

You can click the next link and continue sign up process:
{$a->link}

NOTE: If you have receive this email by mistake or you don\'t know why you have received it,
      and you are not signing up in "{$a->site_longname}", you don\'t have to do anything.
      If you don\'t confirm it, this request will be erase in a few hours.

Best regards,
{$a->sign_name}
';

// USER NOTIFY SIGNUP ------------------------------------------------------------------
$rp_string['email_user_notify_signup-subject'] = '[{$a->site_shortname}] User confirmed';
$rp_string['email_user_notify_signup-message'] = 'Hi {$a->user_firstname} {$a->user_lastname},

Your email confirmation process ({$a->user_email}) has been completed successfully.

Now you can full access to "{$a->site_longname}" with credentials we sent in the first email:
{$a->moodle_www}

Best regards,
{$a->sign_name}
';

// USER REMEMBER PASSWORD ------------------------------------------------------------------
$rp_string['email_user_rempasswd-subject'] = '[{$a->site_shortname}] Recover password instructions';
$rp_string['email_user_rempasswd-message'] = 'Hi {$a->user_firstname} {$a->user_lastname},

You have requested to recover your password.
You can click the next link to change your password.
{$a->link}

Remember your username : {$a->user_username}

NOTA: If you have receive this email by mistake or you don\'t know why you have received it,
      you don\'t have to do anything.

Best regards,
{$a->sign_name}
';

// USER ORDER PENDING ------------------------------------------------------------------
$rp_string['email_user_notify_pending-subject'] = '[{$a->site_shortname}] Order confirmation';
$rp_string['email_user_notify_pending-message'] = 'Hi {$a->user_firstname} {$a->user_lastname},

You have confirm your order.
Now a admin has to validate it before it becomes effective.

Below is the details of your order:

Order
----------------------------------------------------
Unique ID: {$a->order_uniqueid}
Create date: {$a->createdate}
Paymode: {$a->paymode}
Total amount: {$a->finalcost}
----------------------------------------------------

Items
----------------------------------------------------
{$a->items}
----------------------------------------------------

Best regards,
{$a->sign_name}
';

// USER ORDER VALIDATE ------------------------------------------------------------------
$rp_string['email_user_notify_validate-subject'] = '[{$a->site_shortname}] Order validated';
$rp_string['email_user_notify_validate-message'] = 'Hi {$a->user_firstname} {$a->user_lastname},

Your order has been validated by an admin.

A continuación encontrarás los datos de tu pedido:

Below is the details of your order:

Order
----------------------------------------------------
Unique ID: {$a->order_uniqueid}
Create date: {$a->createdate}
Paymode: {$a->paymode}
Total amount: {$a->finalcost}
----------------------------------------------------

Items
----------------------------------------------------
{$a->items}
----------------------------------------------------

Best regards,
{$a->sign_name}
';

// USER ORDER CANCEL ------------------------------------------------------------------
$rp_string['email_user_notify_cancel-subject'] = '[{$a->site_shortname}] Order cancelled';
$rp_string['email_user_notify_cancel-message'] = 'Hi {$a->user_firstname} {$a->user_lastname},

Your order has been cancelled.

Below is the details of your order:

Order
----------------------------------------------------
Unique ID: {$a->order_uniqueid}
Create date: {$a->createdate}
Paymode: {$a->paymode}
Total amount: {$a->finalcost}
----------------------------------------------------

Items
----------------------------------------------------
{$a->items}
----------------------------------------------------

Best regards,
{$a->sign_name}
';

// ADMIN NOTIFY SIGNUP ------------------------------------------------------------------
$rp_string['email_admin_notify_signup-subject'] = '[{$a->site_shortname}] New user sign up';
$rp_string['email_admin_notify_signup-message'] = 'Hi,

New user has signed up: {$a->user_username}
First name : {$a->user_firstname}
Last name  : {$a->user_lastname}
Email      : {$a->user_email}

You can acces to user full profile : {$a->link}

NOTA: User has not confirmed email address yet.

Best regards,
{$a->site_longname}
';

// ADMIN NOTIFY CONFIRMED ------------------------------------------------------------------
$rp_string['email_admin_notify_confirmed-subject'] = '[{$a->site_shortname}] User sign up confirmed';
$rp_string['email_admin_notify_confirmed-message'] = 'Hola,

User has confirmed the email : {$a->user_username}
First name : {$a->user_firstname}
Last name  : {$a->user_lastname}
Email      : {$a->user_email}

You can acces to user full profile : {$a->link}

Best regards,
{$a->site_longname}
';

// ADMIN NOTIFY PENDING ------------------------------------------------------------------
$rp_string['email_admin_notify_pending-subject'] = '[{$a->site_shortname}] New pending order';
$rp_string['email_admin_notify_pending-message'] = 'Hi,

An user has confirmed a new order : {$a->order_uniqueid}

Order
---------------------------------------
Details  : {$a->order_link}

User:
---------------------------------------
First name   : {$a->user_firstname}
Last name    : {$a->user_lastname}
Email        : {$a->user_email}
Profile      : {$a->user_link}

Best regards,
{$a->site_longname}
';

// ADMIN NOTIFY VALIDATE ------------------------------------------------------------------
$rp_string['email_admin_notify_validate-subject'] = '[{$a->site_shortname}] Order validated';
$rp_string['email_admin_notify_validate-message'] = 'Hi,

Order "{$a->order_uniqueid}" has been validated

Order
---------------------------------------
Details  : {$a->order_link}

User:
---------------------------------------
First name : {$a->user_firstname}
Last name  : {$a->user_lastname}
Email      : {$a->user_email}
Profile    : {$a->user_link}

Best regards,
{$a->site_longname}
';

// ADMIN NOTIFY CANCEL ------------------------------------------------------------------
$rp_string['email_admin_notify_cancel-subject'] = '[{$a->site_shortname}] Order cancelled';
$rp_string['email_admin_notify_cancel-message'] = 'Hi,

Order "{$a->order_uniqueid}" has been cancelled

Order
---------------------------------------
Details  : {$a->order_link}

User:
---------------------------------------
First name : {$a->user_firstname}
Last name  : {$a->user_lastname}
Email      : {$a->user_email}
Profile    : {$a->user_link}

Best regards,
{$a->site_longname}
';
