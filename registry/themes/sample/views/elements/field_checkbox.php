<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die(''); ?>
<?php
    $colsize = $this->render->_extra['colsize'];
    $field   = $this->render->_extra['field'];
    $force   = !empty($this->render->_extra['force']) ? true : false;
    $value   = $this->render->rpform->element_value($field);

    $enabled = ($force || $this->render_field_enabled($field));
?>
<?php if ($enabled) : ?>
    <div class="col-md-<?php echo $colsize; ?> <?php echo $this->render->rpform->class_error_show($field, 'has-error');?>">
        <label for="<?php echo $field; ?>"
               class="checkbox-inline">
            <input type="checkbox"
                   name="<?php echo $field; ?>"
                   id="<?php echo $field; ?>"
                   <?php echo $this->render->rpform->radio_checkbox_value($field, 1); ?>
            />
            <?php $this->print_string("lbl_{$field}"); ?>
            <?php echo $this->render_field_required($field); ?></label>
    </div>
<?php endif; ?>
