<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die(''); ?>
<?php
    $order   = $this->render->_extra['order'];
?>
<?php if (!empty($order)) : ?>
<div class="well order-details">
    <h4><?php $this->print_string('order_details'); ?> : <?php echo $order->entry->uniqueid; ?></h4>
    <table>
        <tr>
            <th class="title-name"><?php $this->print_string('order_details_title_name'); ?></td>
            <th class="title-description"><?php $this->print_string('order_details_title_description'); ?></td>
            <th class="title-cost"><?php $this->print_string('order_details_title_cost'); ?></td>
        </tr>
    <?php if (!empty($order->items)) : ?>
        <?php foreach ($order->items as $item) : ?>
        <tr>
            <td class="item-name">[<?php echo $item->entry->name; ?>]</td>
            <td class="item-description"><?php echo $item->entry->description; ?></td>
            <td class="item-cost"><?php echo $item->cost_show(); ?></td>
        </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr colspan="3" class='no-items'><?php $this->print_string('order_details_no_items'); ?></tr>
    <?php endif; ?>
        <tr class="total">
            <td colspan="2" class="total-label"><?php $this->print_string('order_details_total'); ?></td>
            <td class="total-cost"><?php echo $order->cost_show(); ?></td>
        </tr>
    </table>
</div>
<?php endif; ?>
