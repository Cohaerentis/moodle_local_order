<?php if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die(''); ?>
<?php
    $cols = $this->render->_extra;
    $anyenabled = false;
    foreach($cols as $col) {
        $field   = $col['field'];
        $force   = !empty($col['force']) ? true : false;
        $anyenabled = ($force || $this->render_field_enabled($field));
        if ($anyenabled) break;
    }
?>
<?php if ($anyenabled) : ?>
    <div class="row">
    <?php
        foreach($cols as $col) {
            $field   = $col['field'];
            echo $this->render->rpform->element_error_show($field, 'alert alert-danger');
        }

        foreach($cols as $col) {
            $type    = $col['type'];
            $colsize = $col['colsize'];
            $field   = $col['field'];
            $force   = !empty($col['force']) ? true : false;
            switch($type) {
                case 'select':
                case 'radio':
                    $options     = $col['options'];
                    $this->render_view("elements/field_{$type}", array('colsize' => $colsize, 'field' => $field,
                                                                       'options' => $options, 'force' => $force));
                    break;
                case 'checkbox':
                case 'text':
                default:
                    $this->render_view("elements/field_{$type}", array('colsize' => $colsize, 'field' => $field, 'force' => $force));
            }
        }
    ?>
    </div>
<?php endif; ?>
