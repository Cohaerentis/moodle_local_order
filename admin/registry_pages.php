<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * ADMIN : Registry pages management.
 *
 * @package   order
 * @copyright 2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->dirroot . '/local/order/registry/lib.php');
require_once(LOCAL_ORDER_DIRROOT . '/admin/lib.php');

local_order_require_capability('manage');
admin_externalpage_setup('local_order_registry_pages');

$action   = optional_param('action', '', PARAM_ALPHA);
$rpid     = optional_param('rpid', 0, PARAM_INT);

// ACTION : Create a new registry page
// ACTION : Edit a registry page
if ($action == 'edit') {
    include(LOCAL_ORDER_DIRROOT . '/admin/registry_page_edit.php');
    die;

// ACTION : Delete a registry page
} else if ($action == 'delete') {
    include(LOCAL_ORDER_DIRROOT . '/admin/registry_page_delete.php');
    die;

// ACTION : Enable a registry page
// ACTION : Disable a registry page
} else if ( ($action == 'enable') || ($action == 'disable') ) {
    $rp = local_order_rp::get_by_id($rpid);
    if (!empty($rp)) {
        if ($action == 'enable') $rp->enable();
        else                     $rp->disable();
    }

}

// NO ACTION : Show registry pages list

$theme    = optional_param('theme', '', PARAM_ALPHANUMEXT);
$slug     = optional_param('slug', '', PARAM_PATH);
$status   = optional_param('status', '', PARAM_ALPHA);
$cohort   = optional_param('cohort', '', PARAM_ALPHANUMEXT);
$download = optional_param('download', '', PARAM_ALPHA);

echo $OUTPUT->header();
echo $OUTPUT->box_start('', 'local_order');
echo $OUTPUT->heading(get_string('heading_admin_registry_pages', 'local_order'));

$pageurl = new moodle_url('/local/order/admin/registry_pages.php', array(
    'theme'     => $theme,
    'slug'      => $slug,
    'status'    => $status,
    'cohort'    => $cohort));
$addlink = new moodle_url('/local/order/admin/registry_pages.php', array(
    'action' => 'edit',
    'return' => $pageurl));
?>

<form action="" method="get" class="filter">
    <div class="label"><label for="theme"><?php print_string('search_theme', 'local_order'); ?></label></div>
    <div class="field"><input type="text" name="theme" id="theme" value="<?php echo $theme; ?>"></div>
    <div class="clearer"></div>
    <div class="label"><label for="slug"><?php print_string('search_slug', 'local_order'); ?></label></div>
    <div class="field"><input type="text" name="slug" id="slug" value="<?php echo $slug; ?>"></div>
    <div class="clearer"></div>
    <div class="label"><label for="status"><?php print_string('search_status', 'local_order'); ?></label></div>
    <div class="field"><select name="status" id="status">
        <option value="all"      <?php if ($status === 'all')       echo 'selected="selected"'; ?>><?php print_string('rp_status_all', 'local_order'); ?></option>
        <option value="enabled"  <?php if ($status === 'enabled')   echo 'selected="selected"'; ?>><?php print_string('rp_status_enabled', 'local_order'); ?></option>
        <option value="disabled" <?php if ($status === 'disabled')  echo 'selected="selected"'; ?>><?php print_string('rp_status_disabled', 'local_order'); ?></option>
    </select></div>
    <div class="label"><label for="cohort"><?php print_string('search_cohort', 'local_order'); ?></label></div>
    <div class="field"><input type="text" name="cohort" id="cohort" value="<?php echo $cohort; ?>"></div>
    <div class="clearer"></div>
    <div class="label"></div>
    <div class="field"><input type="submit" value="<?php print_string('btn_filter', 'local_order'); ?>"></div>
</form>
<a class="addlink" href="<?php echo $addlink; ?>"><?php print_string('link_admin_rp_add', 'local_order'); ?></a>

<?php

$table = new local_order_admin_registry_pages_table('registry_pages', $theme, $slug, $status, $cohort);
$table->define_baseurl($pageurl);
$table->out(100, true);
?>
<a class="addlink" href="<?php echo $addlink; ?>"><?php print_string('link_admin_rp_add', 'local_order'); ?></a>
<?php
echo $OUTPUT->box_end();
echo $OUTPUT->footer();
