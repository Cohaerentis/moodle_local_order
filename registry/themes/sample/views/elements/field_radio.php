<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die(''); ?>
<?php
    $colsize   = $this->render->_extra['colsize'];
    $field     = $this->render->_extra['field'];
    $options   = $this->render->_extra['options'];
    $force     = !empty($this->render->_extra['force']) ? true : false;
    $value     = $this->render->rpform->element_value($field);

    $enabled = ($force || $this->render_field_enabled($field));
?>
<?php if ($enabled) : ?>
    <div class="col-md-<?php echo $colsize; ?> <?php echo $this->render->rpform->class_error_show($field, 'has-error');?>">
        <label for="<?php echo $field; ?>"
               class="control-label collapse in">
            <?php $this->print_string("lbl_{$field}"); ?>
            <?php echo $this->render_field_required($field); ?></label>
        <?php foreach ($options as $value => $text) : ?>
        <label for="<?php echo $field; ?>-<?php echo $value; ?>"
               class="radio">
            <input type="radio"
                   name="<?php echo $field; ?>"
                   id="<?php echo $field; ?>-<?php echo $value; ?>"
                   <?php echo $this->render->rpform->radio_checkbox_value($field, $value); ?>
            />
            <?php echo $text; ?></label>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
