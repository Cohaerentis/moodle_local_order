<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die(''); ?>
<div class="row">
    <div class="col-md-12">
        <h2><?php $this->print_string('form_rempasswdinfo_legend'); ?></h2>
        <?php $this->print_string('form_rempasswdinfo_instructions', $this->render->email); ?>
        <center><a href="<?php echo $this->uri; ?>?action=<?php echo $this::ACTION_LOGIN; ?>"><?php $this->print_string('btn_return_to_login'); ?></a></center>
    </div>
</div>
