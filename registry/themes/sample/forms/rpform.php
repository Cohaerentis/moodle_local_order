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

if (!defined('LOCAL_ORDER_RP_THEME_INTERNAL')) die('');    ///  It must be included from a Registry index page

require_once($CFG->dirroot . '/lib/formslib.php');

class rpform extends moodleform {
    function definition() {
        // To be override
    }

    function _debug_show_error() {
        // wrout("_debug_show_error : " . var_export($this->_form->_errors, true));
    }

    function _debug_log_error() {
        // wrlog("_debug_log_error : " . var_export($this->_form->_errors, true));
    }

    function _debug_log_data() {
        // wrlog("_debug_log_data : " . var_export(count($this->_form->_elements), true));
        if (!empty($this->_form->_elements)) {
            $elements = $this->_form->_elements;
            foreach ($elements as $e) {
                if (!empty($e->_attributes['name'])) {
                    $name = $e->_attributes['name'];
                    if (isset($e->_attributes['value'])) {
                        // wrlog("    - $name = " . var_export($e->_attributes['value'], true));
                    } else {
                        // wrlog("    - $name = NULL");
                    }
                }
            }
        }
    }

    function class_error_show($element, $class = 'rpform-fieĺd-error') {
        $mform =& $this->_form;

        $classname = '';
        if (!empty($mform) && !empty($element) && $mform->elementExists($element)) {
            $error = $mform->getElementError($element);
            if (!empty($error)) {
                $classname = $class;
            }
        }
        return $classname;
    }

    function element_error_show($element, $class = 'rpform-fieĺd-error') {
        $mform =& $this->_form;

        $html = '';
        if (!empty($mform) && !empty($element) && $mform->elementExists($element)) {
            $error = $mform->getElementError($element);
            if (!empty($error)) {
                $html = '<div class="' . $class . '">' . $error . '</div>';
            }
        }
        return $html;
    }

    function element_error_exists($element) {
        $mform =& $this->_form;

        $exists = false;
        if (!empty($mform) && !empty($element) && $mform->elementExists($element)) {
            $error = $mform->getElementError($element);
            if (!empty($error)) $exists = true;
        }
        return $exists;
    }

    function element_error_set($element, $msg) {
        $mform =& $this->_form;

        $exists = false;
        if (!empty($mform) && !empty($element) && $mform->elementExists($element)) {
            $error = $mform->setElementError($element, $msg);
            if (!empty($error)) $exists = true;
        }
        return $exists;
    }

    function element_value($element, $default = '') {
        $mform =& $this->_form;

        $value = $default;
        if (!empty($mform) && !empty($element) && $mform->elementExists($element)) {
            $value = $mform->getElementValue($element);
        }
        return $value;
    }

    function element_value_set($element, $value) {
        $mform =& $this->_form;
        if (!empty($mform) && !empty($element) && $mform->elementExists($element)) {
            $obj = $mform->getElement($element);
            if (!empty($obj)) {
                $obj->setValue($value);
            }
        }
        return $value;
    }

    function radio_checkbox_value($element, $value = '1') {
        $mform =& $this->_form;
        $html = '';
        if (!empty($mform) && !empty($element) && $mform->elementExists($element)) {
            $html .= 'value="'. $value . '"';
            if (preg_match('/^(.+)\[(.+)\]$/', $element, $matches)) {
                $element  = $matches[1];
                $index    = $matches[2];
                $selected = $this->element_value($element);
                if (is_array($selected) && !empty($selected[$index]) && ($selected[$index] == $value)) {
                    $html .= ' checked="checked"';
                }
            } else if ($this->element_value($element) == $value) {
                $html .= ' checked="checked"';
            }
        }

        return $html;
    }
}
