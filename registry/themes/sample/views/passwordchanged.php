<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die(''); ?>
<?php
    $link = "{$this->uri}?action=" . $this::ACTION_LOGIN;
    $loginlink = '<a href="' . $link . '">' . $this->get_string('btn_return_to_login') . '</a>';
    $vars = new stdClass();
    $vars->link = $loginlink;
    $vars->username = $this->render->username;
?>
<div class="row">
    <div class="col-md-12">
        <h2><?php $this->print_string('form_password_changed_legend'); ?></h2>
        <?php $this->print_string('form_password_changed_instructions', $vars); ?>
    </div>
</div>
