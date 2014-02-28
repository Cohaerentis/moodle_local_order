<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die(''); ?>
<?php
    $colsize        = $this->render->_extra['colsize'];
    $field          = $this->render->_extra['field'];
    $options        = $this->render->_extra['options'];
    $selected       = $this->render->rpform->element_value($field, '');
    $force          = !empty($this->render->_extra['force']) ? true : false;

    $enabled = ($force || $this->render_field_enabled($field));

?>
<?php if ($enabled) : ?>
    <div class="col-md-<?php echo $colsize; ?> form-group <?php echo $this->render->rpform->class_error_show($field, 'has-error');?>">
        <label for="<?php echo $field; ?>"
               class="control-label">
            <?php $this->print_string("lbl_{$field}"); ?>
            <?php echo $this->render_field_required($field); ?></label>
        <select class="form-control"
                name="<?php echo $field; ?>"
                id="<?php echo $field; ?>"
        />
        <?php foreach ($options as $value => $text) : ?>
            <option value="<?php echo $value; ?>" <?php if ($selected == $value) echo 'selected="selected"';?>><?php echo $text; ?></option>
        <?php endforeach;?>
        </select>
    </div>
<?php endif; ?>
