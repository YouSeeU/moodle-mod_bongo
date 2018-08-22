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
 * Library functions for bongo
 *
 * The interface between the Moodle core and the plugin is defined here for the most plugin types.
 * The expected contents of the file depends on the particular plugin type.
 *
 * Moodle core often (but not always) loads all the lib.php files of the given plugin types. For the performance
 * reasons, it is strongly recommended to keep this file as small as possible and have just required code implemented
 * in it. All the plugin's internal logic should be implemented in the auto-loaded classes or in the locallib.php file.
 *
 * File         lib.php
 * Encoding     UTF-8
 *
 * @copyright   YouSeeU
 * @author      Brian Kelly <brian.kelly@youseeu.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

require_once(__DIR__ . '/../../../config.php');

require_login();
if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}

function tool_bongo_extend_navigation(\global_navigation $nav) {
    return;
}
