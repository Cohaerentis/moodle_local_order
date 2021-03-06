<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die(''); ?>
<form method="post" action="<?php echo $this->uri; ?>" role="form">
    <fieldset>
    <div class="row">
        <div class="col-md-12">
            <h2><?php $this->print_string('form_login_legend'); ?></h2>
        </div>
    </div>
    <?php if (!empty($this->render->error)) : ?>
        <div class="row">
            <div class="col-md-12 alert alert-danger">
            <?php echo $this->render->error; ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if (!empty($this->render->formserrors)) : ?>
        <div class="row">
            <div class="col-md-12 alert alert-danger">
            <?php $this->print_string('form_there_are_errors'); ?>
            </div>
        </div>
    <?php endif; ?>
        <?php
            $this->render_view('elements/fields_row', array(
                array('colsize' => 8, 'field' => 'username', 'type' => 'text', 'force' => true)
            ));
            $this->render_view('elements/fields_row', array(
                array('colsize' => 8, 'field' => 'password', 'type' => 'password', 'force' => true)
            ));
        ?>
        <div class="row form-submit">
            <div class="col-md-4">
                <input type="hidden" value="<?php echo sesskey(); ?>" name="sesskey">
                <input type="hidden" value="1" name="_qf__local_order_rp_login_form">
                <input type="hidden" value="<?php echo $this::ACTION_LOGIN; ?>" name="action">
                <button class="btn btn-lg btn-success" type="submit"><?php $this->print_string('btn_login'); ?></button>
            </div>
            <div class="col-md-4 btn-auxiliar">
                <a href="<?php echo $this->uri; ?>?action=<?php echo $this::ACTION_REMEMBER_PASSWORD; ?>"><?php $this->print_string('btn_rempasswd'); ?></a>
            </div>
            <div class="col-md-4 btn-auxiliar">
                <a href="<?php echo $this->uri; ?>?action=<?php echo $this::ACTION_SIGNUP; ?>"><?php $this->print_string('btn_signup'); ?></a>
            </div>
        </div>
    </fieldset>
</form>
