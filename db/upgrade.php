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
 * ORDER interface library
 *
 * @package   order
 * @copyright 2013 Antonio Espinosa <aespinosa@teachnova.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function xmldb_local_order_upgrade($oldversion = 0) {
    global $DB;
    $dbman = $DB->get_manager();

    if ($oldversion < 2013080102) {

        // Define table local_order to be created
        $table = new xmldb_table('local_order');

        // Adding fields to table local_order
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        $table->add_field('registryid', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        $table->add_field('cohortid', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        $table->add_field('uniqueid', XMLDB_TYPE_CHAR, '64', null, null, null, null);
        $table->add_field('createdate', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        $table->add_field('modifydate', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        $table->add_field('paymode', XMLDB_TYPE_INTEGER, '2', null, null, null, '0');
        $table->add_field('promotional', XMLDB_TYPE_CHAR, '64', null, null, null, null);
        $table->add_field('currency', XMLDB_TYPE_CHAR, '3', null, null, null, 'EUR');
        $table->add_field('cost', XMLDB_TYPE_NUMBER, '10, 3', null, null, null, '0');
        $table->add_field('finalcost', XMLDB_TYPE_NUMBER, '10, 3', null, null, null, '0');
        $table->add_field('status', XMLDB_TYPE_INTEGER, '2', null, null, null, '0');
        $table->add_field('metadata', XMLDB_TYPE_TEXT, null, null, null, null, null);

        // Adding keys to table local_order
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        // Adding indexes to table local_order
        $table->add_index('local_order_userid_status', XMLDB_INDEX_NOTUNIQUE, array('userid', 'status'));
        $table->add_index('local_order_status', XMLDB_INDEX_NOTUNIQUE, array('status'));

        // Conditionally launch create table for local_order
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define table local_order_item to be created
        $table = new xmldb_table('local_order_item');

        // Adding fields to table local_order_item
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('orderid', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        $table->add_field('itemtype', XMLDB_TYPE_CHAR, '20', null, null, null, null);
        $table->add_field('name', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('description', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('cost', XMLDB_TYPE_NUMBER, '10, 3', null, null, null, '0');
        $table->add_field('metadata', XMLDB_TYPE_TEXT, null, null, null, null, null);

        // Adding keys to table local_order_item
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        // Adding indexes to table local_order_item
        $table->add_index('local_order_item_orderid', XMLDB_INDEX_NOTUNIQUE, array('orderid'));

        // Conditionally launch create table for local_order_item
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define table local_order_registry to be created
        $table = new xmldb_table('local_order_registry');

        // Adding fields to table local_order_registry
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('cohortid', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        $table->add_field('theme', XMLDB_TYPE_CHAR, '64', null, null, null, null);
        $table->add_field('slug', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('metadata', XMLDB_TYPE_TEXT, null, null, null, null, null);

        // Adding keys to table local_order_registry
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        // Adding indexes to table local_order_registry
        $table->add_index('local_order_registry_slug', XMLDB_INDEX_UNIQUE, array('slug'));

        // Conditionally launch create table for local_order_registry
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // order savepoint reached
        upgrade_plugin_savepoint(true, 2013080102, 'local', 'order');
    }


    if ($oldversion < 2013080103) {

        // Define field status to be added to local_order_registry
        $table = new xmldb_table('local_order_registry');
        $field = new xmldb_field('status', XMLDB_TYPE_INTEGER, '2', null, null, null, '0', 'metadata');

        // Conditionally launch add field status
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        $index = new xmldb_index('local_order_registry_slug_status', XMLDB_INDEX_UNIQUE, array('slug'));
        // Conditionally launch drop index local_order_registry_slug_status
        if ($dbman->index_exists($table, $index)) {
            $dbman->drop_index($table, $index);
        }

        $index = new xmldb_index('local_order_registry_slug_status', XMLDB_INDEX_UNIQUE, array('slug', 'status'));
        // Conditionally launch add index local_order_registry_slug_status
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }

        $index = new xmldb_index('local_order_registry_status', XMLDB_INDEX_NOTUNIQUE, array('status'));
        // Conditionally launch add index local_order_registry_status
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }

        // order savepoint reached
        upgrade_plugin_savepoint(true, 2013080103, 'local', 'order');
    }

}