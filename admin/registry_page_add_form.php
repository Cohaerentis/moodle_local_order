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
 * Registry page form main class
 *
 * @package   order:registry
 * @copyright 2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('LOCAL_ORDER_INTERNAL')) die('');    ///  It must be included from an Admin page

require_once($CFG->dirroot . '/lib/formslib.php');

class registry_page_add_form extends moodleform {

    protected function definition() {
        $mform  =& $this->_form;
        $custom =& $this->_customdata;

        // -------------------------------------------------------------------------------
        $mform->addElement('header', 'basics', get_string('legend_admin_registry_page_basic', 'local_order'));

        // Slug
        $mform->addElement('text', 'slug', get_string('lbl_slug', 'local_order'), array('size' => '64'));
        $mform->setType('slug', PARAM_PATH);
        $mform->addRule('slug', null, 'required', null, 'client');

        // Cohort
        $cohorts = local_order_cohorts_list();
        $mform->addElement('select', 'cohortid', get_string('lbl_cohort', 'local_order'), $cohorts);
        $mform->addRule('cohortid', null, 'required', null, 'client');

        // Theme
        $themes = local_order_rp::theme_list();
        $mform->addElement('select', 'theme', get_string('lbl_theme', 'local_order'), $themes);
        $mform->addRule('theme', null, 'required', null, 'client');

        $mform->addElement('hidden', 'action', 'edit');
        $mform->setType('action', PARAM_ALPHA);

        $mform->addElement('hidden', 'return', $custom['return']);
        $mform->setType('return', PARAM_URL);

        // -------------------------------------------------------------------------------
        $this->add_action_buttons();
    }

    public function definition_after_data(){
        $mform =& $this->_form;
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        // Check if this slug already exists
        if (local_order_rp::slug_exists($data['slug'])) {
            $errors['slug'] = get_string('error_slug_already_exists', 'local_order');
        }

        return $errors;
    }

}