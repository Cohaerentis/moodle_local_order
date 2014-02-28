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
 * Registry pages - Theme SAMPLE - Spanish
 *
 * @package   order
 * @copyright 2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('LOCAL_ORDER_RP_INTERNAL')) die('');    ///  It must be included after Registry index page

// Forms
$rp_string['select_option_empty'] = 'Selecciona ...';
$rp_string['form_required_info'] = 'Los campos con (*) son obligatorios.';
$rp_string['form_there_are_errors'] = 'Hay errores en el formulario.';
$rp_string['form_signup_legend'] = 'Inscríbete';
$rp_string['form_validate_legend'] = 'Confirma los datos de tu perfil';
$rp_string['form_login_legend'] = 'Accede con tu cuenta de usuario';
$rp_string['form_emailsent_legend'] = 'Es necesario confirmar tu registro';
$rp_string['form_emailsent_info'] = '<p>Un correo electrónico ha sido enviado a la dirección:</p>
<center><p class="emailinfo">{$a}</p></center>
<p>Contiene un enlace.</p>
<p>Necesitamos verificar que ésta dirección de correo es válida.
   Por favor, sigue el enlace que has recibido.</p>
<p><strong>¡ATENCIÓN!</strong> Ten en cuenta que es posible que te haya llegado
   a la carpeta de spam o correo no deseado.</p>
';
$rp_string['form_rempasswd_legend'] = 'Recordar contraseña';
$rp_string['form_rempasswd_instructions'] = 'Introduce el correo electrónico que utilizaste para registrarte';
$rp_string['form_rempasswdinfo_legend'] = 'Instrucciones enviadas';
$rp_string['form_rempasswdinfo_instructions'] = '<p>Un mensaje ha sido enviado a:</p>
<center><p class="emailinfo">{$a}</p></center>
<p>Este correo contiene instrucciones para recuperar su clave.</p>
<p>Por favor, siga el link que aparece en el mensaje para proceder a la recuperación.</p>
';
$rp_string['form_setpasswd_legend'] = 'Nueva contraseña';
$rp_string['form_setpasswd_instructions'] = '<p>Introduce una nueva contraseña que te sea fácil recordar</p>';
$rp_string['form_password_changed_legend'] = 'Contraseña cambiada';
$rp_string['form_password_changed_instructions'] = '<p>Tu contraseña ha cambiado</p>
<h3>Siguientes pasos</h3>
<ol>
    <li>{$a->link}</li>
    <li>Usa tu nombre de usuario : {$a->username}</li>
    <li>Usa tu nueva contraseña</li>
</ol>
';
$rp_string['form_payoptions_legend'] = 'Confirmación de inscripción';
$rp_string['form_banktransfer_legend'] = 'Pago por transferencia bancaria';
$rp_string['form_creditcard_legend'] = 'Pago por tarjeta de crédito';
$rp_string['form_paypal_legend'] = 'Pago por PayPal<sup>&trade;</sup>';
$rp_string['form_westernunion_legend'] = 'Pago por Western Union<sup>&trade;</sup>';
$rp_string['form_free_legend'] = 'Inscripción confirmada';

$rp_string['order_details'] = 'Detalles de la inscripción';
$rp_string['order_details_title_name'] = 'Código';
$rp_string['order_details_title_description'] = 'Descripción';
$rp_string['order_details_title_cost'] = 'Importe';
$rp_string['order_details_no_items'] = 'No hay elementos en esta inscripción';
$rp_string['order_details_total'] = 'TOTAL';
$rp_string['order_info_total_lbl'] = 'Importe total';
$rp_string['order_info_concept_lbl'] = 'Concepto';
$rp_string['order_info_bank_lbl'] = 'Banco';
$rp_string['order_info_bank_swift_lbl'] = 'SWIFT';
$rp_string['order_info_bank_aba_lbl'] = 'ABA';
$rp_string['order_info_bank_address_lbl'] = 'Dirección del banco';
$rp_string['order_info_payee_account_lbl'] = 'Número de cuenta';
$rp_string['order_info_payee_name_lbl'] = 'Nombre del beneficiario';
$rp_string['order_info_payee_address_lbl'] = 'Dirección del beneficiario';
$rp_string['order_info_creditcard'] = 'TODO : Forma de pago no implementada';
$rp_string['order_info_banktransfer'] = 'Haga la transferencia y envíe justificante a ésta dirección de email : {$a}';
$rp_string['order_info_westernunion'] = 'Haga el pago en su oficina de Wester Union<sup>&trade;</sup> y envíe justificante a ésta dirección de email : {$a}<br/>
<strong>Por favor, aclarar a nombre de quien se ha realizado el pago</strong>';
$rp_string['order_info_paypal'] = 'Haz clic en el siguiente enlace para realizar el pago:';
$rp_string['order_info_paypal_link'] = 'Pagar a través de PayPal<sup>&trade;</sup>';
$rp_string['order_confirm_free'] = 'Esta inscripción no tiene coste, si está de acuerdo confirme su inscripción.';
$rp_string['order_info_free'] = 'Esta inscripción no tiene coste, pero debe ser validado por un administrador antes de hacerse efectivo.';

$rp_string['lbl_email'] = 'Correo electrónico';
$rp_string['placeholder_email'] = 'tu correo electrónico';
$rp_string['lbl_firstname'] = 'Nombre';
$rp_string['placeholder_firstname'] = 'tu nombre';
$rp_string['lbl_lastname'] = 'Apellidos';
$rp_string['placeholder_lastname'] = 'tus apellidos';
$rp_string['lbl_institution'] = 'Institución';
$rp_string['placeholder_institution'] = 'tu universidad, organización, empresa, administración, ...';
$rp_string['lbl_position'] = 'Cargo';
$rp_string['placeholder_position'] = 'tu cargo en la institución';
$rp_string['lbl_country'] = 'País de residencia';
$rp_string['lbl_city'] = 'Ciudad de residencia';
$rp_string['placeholder_city'] = 'la ciudad donde vives habitualmente';
$rp_string['lbl_phone'] = 'Teléfono o móvil de contacto';
$rp_string['placeholder_phone'] = '555123123';
$rp_string['lbl_phone_intcode'] = 'Prefijo internacional';
$rp_string['placeholder_phone_intcode'] = '+1';
$rp_string['lbl_privacy'] = 'Acepto la <a href="#modalPrivacy" data-toggle="modal">política de privacidad</a>';
$rp_string['lbl_username'] = 'Usuario';
$rp_string['placeholder_username'] = 'usuario';
$rp_string['lbl_password'] = 'Contraseña';
$rp_string['placeholder_password'] = 'contraseña';
$rp_string['lbl_repassword'] = 'Repite la contraseña';
$rp_string['placeholder_repassword'] = 'la misma contraseña';
$rp_string['lbl_code'] = 'Código de confirmación';
$rp_string['placeholder_code'] = 'escribe aquí el código que te enviamos por email';
$rp_string['lbl_paymode'] = 'Modo de pago';
$rp_string['lbl_paymode_paypal'] = 'PayPal<sup>&trade;</sup>';
$rp_string['lbl_paymode_banktransfer'] = 'Transferencia bancaria';
$rp_string['lbl_paymode_creditcard'] = 'Tarjeta de crédito';
$rp_string['lbl_paymode_westernunion'] = 'Western Union<sup>&trade;</sup>';
$rp_string['lbl_promotional'] = 'Código promocional';
$rp_string['placeholder_promotional'] = 'Indique su código para obtener su descuento';

$rp_string['msg_logout_success'] = 'Ha finalizado la sesión correctamente';

// Edit form
$rp_string['legend_admin_registry_page_general'] = 'General';
$rp_string['lbl_name'] = 'Name';
$rp_string['lbl_title'] = 'Title';
$rp_string['lbl_description'] = 'Description';
$rp_string['lbl_contact_email'] = 'Email de contacto';
$rp_string['legend_admin_registry_page_classification'] = 'Clasificación';
$rp_string['lbl_mailchimp_selectone'] = 'Seleccione una temática';
$rp_string['lbl_mailchimp'] = 'Temática Mailchimp principal';
$rp_string['lbl_mailchimpother'] = 'Temática Mailchimp secundaria';
$rp_string['legend_admin_registry_page_notifications'] = 'Notificaciones a administradores';
$rp_string['lbl_admin_notify_signup_toemail'] = 'Email para notificación de alta de usuario';
$rp_string['lbl_admin_notify_confirmed_toemail'] = 'Email para notificación de confirmación de usuario';
$rp_string['lbl_admin_notify_pending_toemail'] = 'Email para notificación de inscripción pendiente';
$rp_string['lbl_admin_notify_validate_toemail'] = 'Email para notificación de inscripción validada';
$rp_string['lbl_admin_notify_cancel_toemail'] = 'Email para notificación de inscripción cancelada';
$rp_string['legend_admin_registry_page_call'] = 'Convocatoria';
$rp_string['lbl_call_url'] = 'Enlace a la convocaria';
$rp_string['lbl_call_pdf'] = 'Enlace al PDF de la convocatoria';
$rp_string['legend_admin_registry_page_banner'] = 'Banner';
$rp_string['lbl_banner_url'] = 'URL destino';
$rp_string['lbl_banner_img'] = 'URL imágen';
$rp_string['lbl_banner_alt'] = 'Texto alternativo';
$rp_string['legend_admin_registry_page_dates'] = 'Fechas y duración';
$rp_string['legend_admin_registry_page_order'] = 'Inscripción';
$rp_string['lbl_order_prefix'] = 'Prefijo';
$rp_string['lbl_order_currency'] = 'Moneda';
$rp_string['lbl_order_cost'] = 'Precio';
$rp_string['lbl_paypal_description'] = 'Descripción para PayPal';
$rp_string['legend_admin_registry_page_discount_graduate'] = 'Descuento a antiguos alumnos';
$rp_string['legend_admin_registry_page_discount_additional'] = 'Descuento a participante adicional';
$rp_string['legend_admin_registry_page_discount_groups'] = 'Descuento a grupos';
$rp_string['lbl_discount_code'] = 'Código';
$rp_string['lbl_discount_qty'] = 'Cantidad a descontar';
$rp_string['lbl_discount_name'] = 'Nombre';
$rp_string['lbl_discount_description'] = 'Descripción';
$rp_string['legend_admin_registry_page_discount_members'] = 'Descuento a miembros';
$rp_string['legend_admin_registry_page_discount_group_members'] = 'Descuento a grupos de miembros';
$rp_string['legend_admin_registry_page_discount_variable'] = 'Descuento variable';
$rp_string['default_discount_graduate_description'] = 'Descuento a antiguos alumnos';
$rp_string['default_discount_additional_description'] = 'Descuento a participante adicional';
$rp_string['default_discount_groups_description'] = 'Descuento a grupos';
$rp_string['default_discount_members_description'] = 'Descuento a miembros';
$rp_string['default_discount_group_members_description'] = 'Descuento a grupos de miembros';
$rp_string['default_discount_variable_description'] = 'Descuento personal';

// Buttons
$rp_string['btn_login'] = 'Entrar';
$rp_string['btn_login_page'] = 'Página de acceso';
$rp_string['btn_logout'] = 'Salir';
$rp_string['btn_changeuser'] = 'Cambiar de usuario';
$rp_string['btn_close'] = 'Cerrar';
$rp_string['btn_signup'] = 'Registrarme';
$rp_string['btn_validate'] = 'Inscribirse';
$rp_string['btn_sendcode'] = 'Enviar código';
$rp_string['btn_resend'] = 'Enviar de nuevo la confirmación';
$rp_string['btn_return_to_login'] = 'Volver a la página de acceso';
$rp_string['btn_rempasswd'] = 'Recordar contraseña';
$rp_string['btn_setpasswd'] = 'Cambiar contraseña';
$rp_string['btn_pay'] = 'Pagar';
$rp_string['btn_confirm_order'] = 'Confirmar inscripción';

// Header
$rp_string['if_you_are_already_student'] = 'Si ya eres alumno';

$rp_string['only_you_known_the_password'] = '[Sólo tú conoces la contraseña]';

// Common labels
$rp_string['lbl_signup'] = 'Inscripción';
$rp_string['lbl_dates_and_prices'] = 'Fechas y precios';
$rp_string['lbl_date_last_call'] = 'Cierre inscripciones';
$rp_string['lbl_date_start'] = 'Comienzo';
$rp_string['lbl_date_end'] = 'Finalización';
$rp_string['lbl_time'] = 'Horas lectivas';
$rp_string['lbl_price'] = 'Precio';
$rp_string['lbl_more_info'] = 'Más información';
$rp_string['lbl_call'] = 'Convocatoria';
$rp_string['lbl_contact'] = 'Contacto';
$rp_string['lbl_notes'] = 'Notas';
$rp_string['lbl_note1'] = 'Si desea más información o requiere ayuda en el proceso de registro, no dude en escribirnos a <a href="mailto:{$a}">{$a}</a>';
$rp_string['lbl_note2'] = 'Si su organización es miembro de Mi Organización favor de contactarnos para conocer los beneficios a los cuales puede acceder.';
$rp_string['lbl_note3'] = 'Su usted es egresado del Colegio de las Américas tiene derecho a un descuento especial. Contáctenos para conocerlo.';

// Paymodes
$rp_string['paymode_unknown'] = 'Sin modo de pago';
$rp_string['paymode_paypal'] = 'PayPal';
$rp_string['paymode_banktransfer'] = 'Transferencia bancaria';
$rp_string['paymode_creditcard'] = 'Tarjeta de crédito';
$rp_string['paymode_westernunion'] = 'Western Union';


// Privacy policy
$rp_string['title_privacy_policy'] = 'Política de privacidad';
$rp_string['content_privacy_policy'] = '<p>Mi Organización (en adelante, MYORG) es el titular de este sitio, y este documento recoge el compromiso de privacidad que el usuario se compromete a conocer y a aceptar.</p>
<p>En ese sitio existen formularios a través de los que te solicitamos datos personales, con la finalidad de matricular al usuario en los cursos online que imparte MYORG, así como mantenerlo informado de actividades promovidas por MYORG</p>
<p>Los usuarios se comprometen a suministrar información veraz y auténtica a la organización. En caso de incumplimiento el usuario es el responsable del daño que dicha información haya podido generar a MYORG o a terceros.</p>
<p>Sus datos pueden ser comunicados a los promotores de la actividad y cuya identidad puede ser consultada en la misma página donde se encuentra el formulario.</p>
<p>En caso de que tenga cualquier inquietud respecto a sus datos personales, o desee la cancelación parcial o total de los mismos, puede escribir un correo electrónico a la siguiente dirección de correo <a href="mailto:info@example.edu">info@example.edu</a></p>
<p>&nbsp;</p>
<p><strong>Vigencia y modificación de la presente política de protección de datos</strong></p>
<p>La presente política de privacidad está vigente desde el 01 Enero de 2013.</p>
<p>MYORG se reserva el derecho de modificar su política de privacida. Si se introdujese algún cambio en esta política el nuevo texto, se publicará en esta misma dirección.</p>';

// Warnings
$rp_string['warning_confirmation_resent'] = 'El email con el código de confirmación ha sido enviado de nuevo';

// Errors
$rp_string['error_unknown_action'] = 'ERROR : Acción desconocida';
$rp_string['error_layout_not_found'] = 'ERROR : No se encuentra el fichero para renderizar el esquema "$a"';
$rp_string['error_no_layout'] = 'ERROR : No hay esquema que renderizar';
$rp_string['error_registry_page_not_loaded'] = 'ERROR : Página de registro no cargada';
$rp_string['error_bad_sesskey'] = 'ERROR : La sesión es inválida o ha expirado';
$rp_string['error_signing_up'] = 'ERROR : Al dar de alta el usuario';
$rp_string['error_updating_up'] = 'ERROR : Al actualizar los datos del usuario';
$rp_string['error_user_not_loggedin'] = 'ERROR : No ha iniciado sesión con su usuario o ha caducado';
$rp_string['error_user_already_loggedin'] = 'ERROR : Ya ha iniciado sesión con su usuario';
$rp_string['error_sending_rempasswd_email'] = 'ERROR : Al enviar las instrucciones de recuperación de contraseña';
$rp_string['error_sending_confirmation_email'] = 'ERROR : Al enviar el código de confirmación por email';
$rp_string['error_not_found_loading_user_by_email'] = 'ERROR : No se encuentra el usuario asociado a ésta dirección de correo';
$rp_string['error_setting_password'] = 'ERROR : Cambiando la contraseña del usuario';
$rp_string['error_confirmation_disabled'] = 'ERROR : Confirmación de email desactivada';
$rp_string['error_email_already_confirmed'] = 'ERROR : El correo electrónico ya está confirmado';
$rp_string['error_order_not_found'] = 'ERROR : Inscripción no encontrada';

$rp_string['error_invalid_login'] = 'El usuario o la contraseña no son válidos';
$rp_string['error_invalid_email'] = 'La dirección de correo no es válida';
$rp_string['error_invalid_email_toolong'] = 'La dirección de correo es demasiado larga';
$rp_string['error_invalid_email_notexists'] = 'La dirección de corre no existe';
$rp_string['error_invalid_password_toolong'] = 'La contraseña es demasiado larga';
$rp_string['error_invalid_password_passwordsnotequal'] = 'Las contraseñas no coinciden';
$rp_string['error_invalid_email_alreadyexists'] = 'La dirección de correo ya existe';
$rp_string['error_invalid_username_toolong'] = 'El nombre de usuario es demasiado largo';
$rp_string['error_invalid_username_alphanumerical'] = 'El nombre de usuario sólo adminte letras y números';
$rp_string['error_invalid_username_alreadyexists'] = 'El nombre de usuario ya existe';
$rp_string['error_invalid_nif'] = 'El NIF es inválido';
$rp_string['error_invalid_nif_toolong'] = 'EL NIF es demasiado largo';
$rp_string['error_invalid_nif_alreadyexists'] = 'El NIF ya existe';
$rp_string['error_invalid_institution_toolong'] = 'La institución es demasiado larga';
$rp_string['error_invalid_position_toolong'] = 'El cargo es demasiado largo';
$rp_string['error_invalid_country_toolong'] = 'El código de país es demasiado largo';
$rp_string['error_invalid_city_toolong'] = 'La ciudad es demasiado larga';
$rp_string['error_invalid_phone_toolong'] = 'El teléfono es demasiado largo';
$rp_string['error_invalid_phone_intcode_toolong'] = 'El prefijo internacional es demasiado largo';
$rp_string['error_invalid_privacy_toolong'] = 'La política de privacidad es demasiado larga';
$rp_string['error_invalid_code'] = 'El código de confirmación es inválido o ya ha sido utilizado';
$rp_string['error_invalid_code_toolong'] = 'El código de confirmación es demasiado largo';
$rp_string['error_invalid_paymode_toolong'] = 'El modo de pago es demasiado largo';

$rp_string['link_forgotaccount'] = '¿Necesitas recordar tu contraseña?';
$rp_string['link_resendemail'] = 'Enviar de nuevo el correo de confirmación';

// Missing fields errors
$rp_string['missing_code'] = 'Falta el código de confirmación';
$rp_string['missing_email'] = 'Falta la dirección de email';
$rp_string['missing_username'] = 'Falta el nombre de usuario';
$rp_string['missing_password'] = 'Falta la contraseña';
$rp_string['missing_repassword'] = 'Vuelva a introducir la contraseña';
$rp_string['missing_paymode'] = 'Falta el modo de pago';
$rp_string['missing_firstname'] = 'Falta el nombre';
$rp_string['missing_lastname'] = 'Faltan los apellidos';
$rp_string['missing_nif'] = 'Falta el NIF';
$rp_string['missing_institution'] = 'Falta la institución';
$rp_string['missing_position'] = 'Falta el cargo';
$rp_string['missing_country'] = 'Falta el país';
$rp_string['missing_city'] = 'Falta la ciudad';
$rp_string['missing_phone'] = 'Falta el teléfono';
$rp_string['missing_phone_intcode'] = 'Falta el prefijo internacional';
$rp_string['missing_privacy'] = 'Falta aceptar la política de privacidad';

// Email messages
// CONFIRM SIGNUP ------------------------------------------------------------------
$rp_string['email_user_signup_confirm-subject'] = '[{$a->site_shortname}] Código de confirmación';
$rp_string['email_user_signup_confirm-message'] = 'Hola {$a->user_firstname} {$a->user_lastname},

Has enviado tus datos para darte de alta.
Necesitamos confirmar tu dirección de correo electrónico ({$a->user_email}) antes de continuar.

Puedes hacer clic sobre el enlace siguiente y continuar el proceso de inscripción.
{$a->link}

Por favor, NO BORRES este email. Estas son tus credenciales de acceso para usarlas en el futuro:
----------------------------------------
URL acceso  : {$a->moodle_www}
Usuario     : {$a->user_username}
Contraseña  : {$a->user_password}
----------------------------------------

NOTA: Si has recibido este email por error o no sabes porqué lo has recibido,
      y no estás inscribiéndote en "{$a->site_longname}", no tienes que hacer nada.
      Si no confirmas, esta petición se borrará en unas horas.

Saludos,
{$a->sign_name}
';

// CONFIRM SIGNUP RESEND ------------------------------------------------------------------
$rp_string['email_user_signup_confirm_resend-subject'] = '[{$a->site_shortname}] Reenvío del código de confirmación';
$rp_string['email_user_signup_confirm_resend-message'] = 'Hola {$a->user_firstname} {$a->user_lastname},

Has solicitado que te volvamos a enviar el enlace de confirmación de alta.

Puedes hacer clic sobre el enlace siguiente y continuar el proceso de inscripción.
{$a->link}

NOTA: Si has recibido este email por error o no sabes porqué lo has recibido,
y no estás inscribiéndote en "{$a->site_longname}", no tienes que hacer nada.
Si no confirmas, esta petición se borrará en unas horas.

Saludos,
{$a->sign_name}
';

// USER NOTIFY SIGNUP ------------------------------------------------------------------
$rp_string['email_user_notify_signup-subject'] = '[{$a->site_shortname}] Usuario confirmado';
$rp_string['email_user_notify_signup-message'] = 'Hola {$a->user_firstname} {$a->user_lastname},

El proceso de confirmación de tu email ({$a->user_email}) se ha realizado con éxito.

Ya puedes acceder a "{$a->site_longname}" con las credenciales que te enviamos en el primer correo electrónico:
{$a->moodle_www}

Saludos,
{$a->sign_name}
';

// USER REMEMBER PASSWORD ------------------------------------------------------------------
$rp_string['email_user_rempasswd-subject'] = '[{$a->site_shortname}] Instrucciones de recuperación de contraseña';
$rp_string['email_user_rempasswd-message'] = 'Hola {$a->user_firstname} {$a->user_lastname},

Has solicitado una recuperación de contraseña.
Puedes hacer clic sobre el enlace siguiente para cambiar tu contraseña.
{$a->link}

Recuerda tu nombre de usuario : {$a->user_username}

NOTA: Si has recibido este email por error o no sabes porqué lo has recibido,
no tienes que hacer nada.

Saludos,
{$a->sign_name}
';

// USER ORDER PENDING ------------------------------------------------------------------
$rp_string['email_user_notify_pending-subject'] = '[{$a->site_shortname}] Confirmación de inscripción';
$rp_string['email_user_notify_pending-message'] = 'Hola {$a->user_firstname} {$a->user_lastname},

Has confirmado tu inscripción.
Ahora un administrador tiene que validarlo, antes de que se haga efectivo.

A continuación encontrarás los datos de tu inscripción:

Registro
----------------------------------------------------
Código de identificación: {$a->order_uniqueid}
Fecha de creación: {$a->createdate}
Modalidad de pago: {$a->paymode}
Importe total: {$a->finalcost}
----------------------------------------------------

Servicios
----------------------------------------------------
{$a->items}
----------------------------------------------------

Saludos,
{$a->sign_name}
';

// USER ORDER VALIDATE ------------------------------------------------------------------
$rp_string['email_user_notify_validate-subject'] = '[{$a->site_shortname}] Inscripción validada';
$rp_string['email_user_notify_validate-message'] = 'Hola {$a->user_firstname} {$a->user_lastname},

Su inscripción ha sido validada por una administrador.

A continuación encontrarás los datos de tu inscripción:

Registro
----------------------------------------------------
Código de identificación: {$a->order_uniqueid}
Fecha de creación: {$a->createdate}
Modalidad de pago: {$a->paymode}
Importe total: {$a->finalcost}
----------------------------------------------------

Servicios
----------------------------------------------------
{$a->items}
----------------------------------------------------

Saludos,
{$a->sign_name}
';

// USER ORDER CANCEL ------------------------------------------------------------------
$rp_string['email_user_notify_cancel-subject'] = '[{$a->site_shortname}] Inscripción cancelada';
$rp_string['email_user_notify_cancel-message'] = 'Hola {$a->user_firstname} {$a->user_lastname},

Su inscripción ha sido cancelada.

A continuación encontrarás los datos de la inscripción cancelada:

Registro
----------------------------------------------------
Código de identificación: {$a->order_uniqueid}
Fecha de creación: {$a->createdate}
Modalidad de pago: {$a->paymode}
Importe total: {$a->finalcost}
----------------------------------------------------

Servicios
----------------------------------------------------
{$a->items}
----------------------------------------------------

Saludos,
{$a->sign_name}
';

// ADMIN NOTIFY SIGNUP ------------------------------------------------------------------
$rp_string['email_admin_notify_signup-subject'] = '[{$a->site_shortname}] Nuevo alta de usuario';
$rp_string['email_admin_notify_signup-message'] = 'Hola,

Se ha dado de alta un nuevo usuario: {$a->user_username}
Nombre    : {$a->user_firstname}
Apellidos : {$a->user_lastname}
Email     : {$a->user_email}

Puedes consultar su perfil completo : {$a->link}

NOTA: Aún no ha confirmado el email que ha introducido.

Saludos,
{$a->site_longname}
';

// ADMIN NOTIFY CONFIRMED ------------------------------------------------------------------
$rp_string['email_admin_notify_confirmed-subject'] = '[{$a->site_shortname}] Alta confirmada de usuario';
$rp_string['email_admin_notify_confirmed-message'] = 'Hola,

Un nuevo usuario ha confirmado su email : {$a->user_username}
Nombre    : {$a->user_firstname}
Apellidos : {$a->user_lastname}
Email     : {$a->user_email}

Puedes consultar su perfil completo : {$a->link}

Saludos,
{$a->site_longname}
';

// ADMIN NOTIFY PENDING ------------------------------------------------------------------
$rp_string['email_admin_notify_pending-subject'] = '[{$a->site_shortname}] Nueva inscripción pendiente';
$rp_string['email_admin_notify_pending-message'] = 'Hola,

Un usuario ha confirmado su inscripción : {$a->order_uniqueid}

Registro
---------------------------------------
Detalles  : {$a->order_link}

Usuario:
---------------------------------------
Nombre       : {$a->user_firstname}
Apellidos    : {$a->user_lastname}
Email        : {$a->user_email}
Perfil       : {$a->user_link}

Saludos,
{$a->site_longname}
';

// ADMIN NOTIFY VALIDATE ------------------------------------------------------------------
$rp_string['email_admin_notify_validate-subject'] = '[{$a->site_shortname}] Inscripción validada';
$rp_string['email_admin_notify_validate-message'] = 'Hola,

La inscripción "{$a->order_uniqueid}" ha sido validada

Registro
---------------------------------------
Detalles  : {$a->order_link}

Usuario:
---------------------------------------
Nombre    : {$a->user_firstname}
Apellidos : {$a->user_lastname}
Email     : {$a->user_email}
Perfil    : {$a->user_link}

Saludos,
{$a->site_longname}
';

// ADMIN NOTIFY CANCEL ------------------------------------------------------------------
$rp_string['email_admin_notify_cancel-subject'] = '[{$a->site_shortname}] Inscripción cancelada';
$rp_string['email_admin_notify_cancel-message'] = 'Hola,

La inscripción "{$a->order_uniqueid}" ha sido cancelada

Registro
---------------------------------------
Detalles  : {$a->order_link}

Usuario:
---------------------------------------
Nombre    : {$a->user_firstname}
Apellidos : {$a->user_lastname}
Email     : {$a->user_email}
Perfil    : {$a->user_link}

Saludos,
{$a->site_longname}
';
