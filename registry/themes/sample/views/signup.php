<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die(''); ?>
<?php
    $countries = $this->countries_list();
    asort($countries);
    $countries = array_merge(array('' => $this->get_string('select_option_empty')),
                             $countries);

?>
<form method="post" action="<?php echo $this->uri; ?>" role="form">
    <fieldset>
    <div class="row">
        <div class="col-md-12">
            <?php if (isloggedin()) : ?>
            <h2><?php $this->print_string('form_validate_legend'); ?></h2>
            <?php else : ?>
            <h2><?php $this->print_string('form_signup_legend'); ?></h2>
            <?php endif; ?>
            <p><?php $this->print_string('form_required_info'); ?></p>
        </div>
    </div>
    <?php if (!empty($this->render->formerrors)) : ?>
        <div class="row">
            <div class="col-md-12 alert alert-danger">
            <?php $this->print_string('form_there_are_errors'); ?>
            </div>
        </div>
    <?php endif; ?>
        <?php
            if (!isloggedin()) {
                $this->render_view('elements/fields_row', array(
                    array('colsize' => 12, 'field' => 'email', 'type' => 'text')
                ));
                $this->render_view('elements/fields_row', array(
                    array('colsize' => 6, 'field' => 'password', 'type' => 'password'),
                    array('colsize' => 6, 'field' => 'repassword', 'type' => 'password')
                ));
            }
            $this->render_view('elements/fields_row', array(
                array('colsize' => 5, 'field' => 'firstname', 'type' => 'text'),
                array('colsize' => 7, 'field' => 'lastname', 'type' => 'text'),
            ));
            $this->render_view('elements/fields_row', array(
                array('colsize' => 12, 'field' => 'institution', 'type' => 'text')
            ));
            $this->render_view('elements/fields_row', array(
                array('colsize' => 12, 'field' => 'position', 'type' => 'text')
            ));
            $this->render_view('elements/fields_row', array(
                array('colsize' => 5, 'field' => 'country', 'type' => 'select', 'options' => $countries),
                array('colsize' => 7, 'field' => 'city', 'type' => 'text')
            ));
            $this->render_view('elements/fields_row', array(
                array('colsize' => 5, 'field' => 'phone_intcode', 'type' => 'text'),
                array('colsize' => 7, 'field' => 'phone', 'type' => 'text')
            ));
            $this->render_view('elements/fields_row', array(
                array('colsize' => 12, 'field' => 'privacy', 'type' => 'checkbox')
            ));
        ?>
        <div class="row form-submit"><div class="col-md-5">
            <input type="hidden" value="<?php echo sesskey(); ?>" name="sesskey">
            <input type="hidden" value="1" name="_qf__local_order_rp_signup_form">
        <?php if (isloggedin()) : ?>
            <input type="hidden" value="<?php echo $this::ACTION_VALIDATE; ?>" name="action">
            <button class="btn btn-lg btn-success" type="submit"><?php $this->print_string('btn_validate'); ?></button>
        <?php else : ?>
            <input type="hidden" value="<?php echo $this::ACTION_SIGNUP; ?>" name="action">
            <button class="btn btn-lg btn-success" type="submit"><?php $this->print_string('btn_signup'); ?></button>
        <?php endif; ?>
        </div></div>
    </fieldset>
</form>
