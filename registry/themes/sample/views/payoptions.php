<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die(''); ?>
<?php
    if (!empty($this->render->order))
        $order =& $this->render->order;
    else if (!empty($this->render->orderid))
        $order = local_order::read($this->render->orderid);
    else
        $order = false;
    $paymodes = $this->paymodes_list();
?>
<form method="post" action="<?php echo $this->uri; ?>" role="form">
    <fieldset>
    <div class="row">
        <div class="col-md-12">
            <h2><?php $this->print_string('form_payoptions_legend'); ?></h2>
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
                <?php $this->render_view('elements/order_details', array('order' => $order)); ?>
            </div>
        </div>
    <?php else : ?>
            <div class="col-md-12 alert alert-danger">
            No order created/loaded
            </div>
    <?php endif; ?>
    <?php if (!empty($this->render->formserrors)) : ?>
        <div class="row">
            <div class="col-md-12 alert alert-danger">
            <?php $this->print_string('form_there_are_errors'); ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if (!empty($order->entry->finalcost)) : ?>
        <?php
            $this->render_view('elements/fields_row', array(
                array('colsize' => 12, 'field' => 'paymode', 'type' => 'radio', 'force' => true,
                      'options' => $paymodes)
            ));
            $this->render_view('elements/fields_row', array(
                array('colsize' => 8, 'field' => 'promotional', 'type' => 'text', 'force' => true)
            ));
        ?>
    <?php else : ?>
        <div class="row">
            <div class="col-md-12">
                <?php $this->print_string('order_confirm_free'); ?>
            </div>
        </div>
    <?php endif; ?>
        <div class="row form-submit">
            <div class="col-md-5">
                <input type="hidden" value="<?php echo sesskey(); ?>" name="sesskey">
                <input type="hidden" value="<?php echo $order->entry->id; ?>" name="orderid">
                <input type="hidden" value="1" name="_qf__local_order_rp_payoptions_form">
                <input type="hidden" value="<?php echo $this::ACTION_PAY_OPTIONS; ?>" name="action">
            <?php if (!empty($order->entry->finalcost)) : ?>
                <button class="btn btn-lg btn-success" type="submit"><?php $this->print_string('btn_pay'); ?></button>
            <?php else : ?>
                <input type="hidden" value="<?php echo local_order::PAYMODE_FREE; ?>" name="paymode">
                <button class="btn btn-lg btn-success" type="submit"><?php $this->print_string('btn_confirm_order'); ?></button>
            <?php endif; ?>
            </div>
        </div>
    </fieldset>
</form>
