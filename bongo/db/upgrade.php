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
 * Upgrade steps (such as database scheme changes that must happen when the plugin is being upgraded) are defined here.
 *
 * File         upgrade.php
 * Encoding     UTF-8
 *
 * @copyright   YouSeeU
 * @package     mod_bongo
 * @author      Brian Kelly <brian.kelly@youseeu.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */
if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}

require_once($CFG->dirroot . '/mod/bongo/locallib.php');

/**
 * Custom code called when the plugin is upgraded.  Migration from old code to new code and any new db actions.
 *
 * Overrides global function.
 *
 * @param integer $oldversion
 * @return bool
 */
function xmldb_bongo_upgrade($oldversion) {
    global $DB;
    $dbmanager = $DB->get_manager();

    $result = true;

    // Insert PHP code from XMLDB Editor here.
    if($oldversion < 2018111601){

        // Drop unused field.
        $table = new xmldb_table('bongo');
        $field = new xmldb_field('premium_key');
        if ($dbmanager->field_exists($table, $field)) {
            $dbmanager->drop_field($table, $field, true, true);
        }

        // Rename field 'key' on table 'bongo' as it is a reserved word in MySQL.
        $table = new xmldb_table('bongo');
        $field = new xmldb_field('key');
        if ($dbmanager->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, null, null, XMLDB_NOTNULL, null, null, 'groupid');
            // Extend the execution time limit of the script to 5 minutes.
            upgrade_set_timeout(300);
            // Rename it to 'issystem'.
            $dbmanager->rename_field($table, $field, 'ltikey');
        }

        // Try to find previous configuration.
        $bongocourseid = mod_bongo_get_bongo_course();
        if(!is_null($bongocourseid)){
            // Plugin was previously configured. Insert dummy data because previous install failed. We cannot recover lost data.
            mod_bongo_insert_dummy_data($bongocourseid);
        }

        upgrade_mod_savepoint(true, 2018111601, 'bongo');
    }

    return $result;
}
