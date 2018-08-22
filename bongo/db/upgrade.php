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
 * Upgrade steps (such as database scheme changes and other things that must happen when the plugin is being upgraded)
 * are defined here.
 * The in-built XMLDB editor can be used to generate the code to change the database scheme.
 *
 * Upgrade API
 *
 * File         upgrade.php
 * Encoding     UTF-8
 *
 *
 * @copyright   YouSeeU
 * @author      Brian Kelly <brian.kelly@youseeu.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */
if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}

// Overrides global function.
function xmldb_mymodule_upgrade($oldversion) {
    global $CFG;

    $result = true;

    // Insert PHP code from XMLDB Editor here.

    return $result;
}
