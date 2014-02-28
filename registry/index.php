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
 * Registry pages wrapper
 *
 * @package   order
 * @copyright 2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../../config.php');
require_once($CFG->dirroot . '/local/order/registry/lib.php');

// If no registry page found, redirect to home
$redirecturl = new moodle_url('/');

// Check for registry page, by URI
$uri = '/';
if (!empty($_SERVER['REQUEST_URI'])) {
    $uri = $_SERVER['REQUEST_URI'];
} else {
    redirect($redirecturl, get_string('rp_notfound', 'local_order'));
}

// Look for a registry page
if (!$RP = local_order_rp::get_by_uri($uri)) {
    redirect($redirecturl, get_string('rp_notfound', 'local_order'));
}

// A valid registry page and theme is loaded, globalize it
global $RP;

// Gives control to theme to parse request
$RP->request_process();
