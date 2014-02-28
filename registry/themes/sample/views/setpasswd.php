<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die(''); ?>
<form method="post" action="<?php echo $this->uri; ?>" role="form">
    <fieldset>
    <div class="row">
        <div class="col-md-12">
            <h2><?php $this->print_string('form_setpasswd_legend'); ?></h2>
            <?php $this->print_string('form_setpasswd_instructions'); ?>
        </div>
    </div>
    <?php if (!empty($this->render->formserrors)) : ?>
        <div class="row">
            <div class="col-md-12 alert alert-danger">
            <?php $this->print_string('form_there_are_errors'); ?>
            </div>
        </div>
    <?php endif; ?>
        <?php
            $this->render_view('elements/fields_row', array(
                array('colsize' => 8, 'field' => 'password', 'type' => 'password', 'force' => true)
            ));
            $this->render_view('elements/fields_row', array(
                array('colsize' => 8, 'field' => 'repassword', 'type' => 'password', 'force' => true)
            ));
        ?>
        <div class="row form-submit"><div class="col-md-5">
            <input type="hidden" value="<?php echo sesskey(); ?>" name="sesskey">
            <input type="hidden" value="1" name="_qf__local_order_rp_setpasswd_form">
            <input type="hidden" value="<?php echo $this->render->code; ?>" name="code">
            <input type="hidden" value="<?php echo $this->render->email; ?>" name="email">
            <input type="hidden" value="<?php echo $this::ACTION_SET_PASSWORD; ?>" name="action">
            <button class="btn btn-lg btn-success" type="submit"><?php $this->print_string('btn_setpasswd'); ?></button>
        </div></div>
    </fieldset>
</form>
