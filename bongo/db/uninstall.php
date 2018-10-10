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
 * Executes PHP code before Bongo's database tables and data are dropped during the plugin uninstallation.
 *
 * - Removes the LTI Type
 * - Notifies Bongo of uninstall
 *
 * File         uninstall.php
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

global $CFG, $DB;
require_once($CFG->dirroot . '/mod/lti/locallib.php');
require_once($CFG->dirroot . '/admin/tool/bongo/locallib.php');


// Needs error handling around not configured instance.
$bongorows = $DB->get_records('tool_bongo', array());
foreach ($bongorows as $bongorow) {
    $ltitype = $bongorow->lti_type_id;
    lti_delete_type($ltitype);
}
tool_bongo_unregister_bongo_integration();
