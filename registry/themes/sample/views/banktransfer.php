<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die(''); ?>
<?php
    if (!empty($this->render->order))
        $order =& $this->render->order;
    else if (!empty($this->render->orderid))
        $order = local_order::read($this->render->orderid);
    else
        $order = false;

    $concept = '';
    if (!empty($this->theme->config->transfer_order_prefix)) {
        $concept .= $this->theme->config->transfer_order_prefix . '-';
    }
    if (!empty($order->entry->uniqueid)) $concept .= $order->entry->uniqueid . ', ';
    if (!empty($this->theme->config->transfer_concept_field) && !empty($USER)) {
        $field = $this->theme->config->transfer_concept_field;
        if ($field == 'realname') {
            $concept .= fullname($USER);
        } else if (!empty($USER->$field)) {
            $concept .= $USER->$field;
        }
    }

?>
<form method="post" action="<?php echo $this->uri; ?>" role="form">
    <fieldset>
    <div class="row">
        <div class="col-md-12">
            <h2><?php $this->print_string('form_banktransfer_legend'); ?></h2>
        </div>
    </div>
    <?php if (!empty($this->render->error)) : ?>
        <div class="row">
            <div class="col-md-12 alert alert-danger">
            <?php echo $this->render->error; ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if (!empty($order)) : ?>
        <div class="row">
            <div class="col-md-12">
                <?php /* * / ?><pre><?php var_export($order); ?></pre><?php /* */ ?>
                <?php $this->render_view('elements/order_details', array('order' => $order)); ?>
            </div>
        </div>
    <?php else : ?>
            <div class="col-md-12 alert alert-danger">
            No order created/loaded
            </div>
    <?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <p class="order_info">
                    <span class="order_info_total_lbl"><?php $this->print_string('order_info_total_lbl'); ?></span> :
                    <?php echo $order->cost_show(); ?>
                </p>
                <p class="order_info">
                    <span class="order_info_concept_lbl"><?php $this->print_string('order_info_concept_lbl'); ?></span> :
                    <?php echo $concept; ?>
                </p>
            <?php if (!empty($this->theme->config->transfer_bank)) : ?>
                <p class="order_info">
                    <span class="order_info_bank_lbl"><?php $this->print_string('order_info_bank_lbl'); ?></span> :
                    <?php echo $this->theme->config->transfer_bank; ?>
                </p>
            <?php endif; ?>
            <?php if (!empty($this->theme->config->transfer_bank_swift)) : ?>
                <p class="order_info">
                    <span class="order_info_bank_swift_lbl"><?php $this->print_string('order_info_bank_swift_lbl'); ?></span> :
                    <?php echo $this->theme->config->transfer_bank_swift; ?>
                </p>
            <?php endif; ?>
            <?php if (!empty($this->theme->config->transfer_bank_aba)) : ?>
                <p class="order_info">
                    <span class="order_info_bank_aba_lbl"><?php $this->print_string('order_info_bank_aba_lbl'); ?></span> :
                    <?php echo $this->theme->config->transfer_bank_aba; ?>
                </p>
            <?php endif; ?>
            <?php if (!empty($this->theme->config->transfer_bank_address)) : ?>
                <p class="order_info">
                    <span class="order_info_bank_address_lbl"><?php $this->print_string('order_info_bank_address_lbl'); ?></span> :
                    <?php echo $this->theme->config->transfer_bank_address; ?>
                </p>
            <?php endif; ?>
            <?php if (!empty($this->theme->config->transfer_payee_account)) : ?>
                <p class="order_info">
                    <span class="order_info_payee_account_lbl"><?php $this->print_string('order_info_payee_account_lbl'); ?></span> :
                    <?php echo $this->theme->config->transfer_payee_account; ?>
                </p>
            <?php endif; ?>
            <?php if (!empty($this->theme->config->transfer_payee_name)) : ?>
                <p class="order_info">
                    <span class="order_info_payee_name_lbl"><?php $this->print_string('order_info_payee_name_lbl'); ?></span> :
                    <?php echo $this->theme->config->transfer_payee_name; ?>
                </p>
            <?php endif; ?>
            <?php if (!empty($this->theme->config->transfer_payee_address)) : ?>
                <p class="order_info">
                    <span class="order_info_payee_address_lbl"><?php $this->print_string('order_info_payee_address_lbl'); ?></span> :
                    <?php echo $this->theme->config->transfer_payee_address; ?>
                </p>
            <?php endif; ?>
                <p class="order_info_instructions"><?php $this->print_string('order_info_banktransfer', $this->theme->config->transfer_email); ?></p>
            </div>
        </div>
    </fieldset>
</form>
