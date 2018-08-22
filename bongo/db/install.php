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
 * Executes PHP code right after Bongo's database schema has been installed.
 *
 * File         install.php
 * Encoding     UTF-8
 *
 * @copyright   YouSeeU
 * @author      Brian Kelly <brian.kelly@youseeu.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}

require_once($CFG->dirroot . '/mod/lti/locallib.php');

// Overrides global function. Required for all plugins.
function xmldb_tool_bongo_install() {
    global $DB;

    // Turning on Bongo in Moodle.
    if (!$DB->record_exists('config', array('name' => 'enablebongo'))) {
        $enabledata = new stdClass();
        $enabledata->name = 'enablebongo';
        $enabledata->value = 1;
        $DB->insert_record('config', $enabledata);
    } else if ($enabled = $DB->get_record('config', array('name' => 'enablebongo'))) {
        if ($enabled->value == 0) {
            $enabled->value = 1;
            $DB->update_record('config', $enabled);
        }
    }
}