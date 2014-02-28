<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die(''); ?>
<?php
    $colsize = $this->render->_extra['colsize'];
    $field   = $this->render->_extra['field'];
    $force   = !empty($this->render->_extra['force']) ? true : false;

    $enabled = ($force || $this->render_field_enabled($field));
?>
<?php if ($enabled) : ?>
    <div class="col-md-<?php echo $colsize; ?> form-group <?php echo $this->render->rpform->class_error_show($field, 'has-error');?>">
        <label for="<?php echo $field; ?>"
               class="control-label">
            <?php $this->print_string("lbl_{$field}"); ?>
            <?php if ($this->render->_content == 'signup') echo $this->render_field_required($field); ?></label>
        <input class="form-control"
               type="text"
               name="<?php echo $field; ?>"
               maxlength="<?php echo $this->maxlength[$field]; ?>"
               id="<?php echo $field; ?>"
               placeholder="<?php $this->print_string("placeholder_{$field}"); ?>"
               value="<?php echo $this->render->rpform->element_value($field); ?>"
        />
    </div>
<?php endif; ?>
