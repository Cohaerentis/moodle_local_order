<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die('');
    if (!empty($this->render->resendemail)) {
        $resendurl = new moodle_url($this->uri, array('action' => $this::ACTION_RESEND_CONFIRM,
                                                      'email'  => $this->render->resendemail));
    }
?>
<form method="post" action="<?php echo $this->uri; ?>" role="form">
    <fieldset>
    <div class="row">
        <div class="col-md-12">
            <h2><?php $this->print_string('form_emailsent_legend'); ?></h2>
        </div>
    </div>
    <?php if (!empty($this->render->error)) : ?>
        <div class="row">
            <div class="col-md-12 alert alert-danger">
            <?php echo $this->render->error; ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if (!empty($this->render->email)) : ?>
        <div class="row">
            <div class="col-md-12">
            <?php $this->print_string('form_emailsent_info', $this->render->email); ?>
            </div>
        </div>
    <?php endif; ?>
        <div class="row form-submit">
            <div class="col-md-5">
                <input type="hidden" value="<?php echo sesskey(); ?>" name="sesskey">
                <input type="hidden" value="1" name="_qf__local_order_rp_code_form">
                <input type="hidden" value="<?php echo $this::ACTION_SEND_CODE; ?>" name="action">
            </div>
            <div class="col-md-7 btn-auxiliar">
        <?php if (!empty($this->render->resendemail)) : ?>
                <input type="hidden" value="<?php echo $this->render->resendemail;?>" name="email">
                <a href="<?php echo $resendurl; ?>"><?php $this->print_string('btn_resend'); ?></a>
            </div>
        <?php endif; ?>
        </div>
    </fieldset>
</form>
