<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die(''); ?>
<?php
    if (!empty($this->render->order))
        $order =& $this->render->order;
    else if (!empty($this->render->orderid))
        $order = local_order::read($this->render->orderid);
    else
        $order = false;

?>
<form method="post" action="<?php echo $this->uri; ?>" role="form">
    <fieldset>
    <div class="row">
        <div class="col-md-12">
            <h2><?php $this->print_string('form_creditcard_legend'); ?></h2>
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
        <div class="row">
            <div class="col-md-12">
                <p class="order_info">
                    <span class="order_info_total_lbl"><?php $this->print_string('order_info_total_lbl'); ?></span> :
                    <?php echo $order->cost_show(); ?>
                </p>
                <p class="order_info_instructions"><?php $this->print_string('order_info_creditcard'); ?></p>
            </div>
        </div>
    </fieldset>
</form>
