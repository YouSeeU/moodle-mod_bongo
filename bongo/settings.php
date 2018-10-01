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
 * Describes the administration configuration for your plugin.
 * The setting names are supposed to be plugintype_pluginname/settingname (note the slash) and not
 * plugintype_pluginname_settingname or even just settingname. This makes them to be stored in the config_plugins
 * table without polluting the global $CFG object.
 *
 * Registers external configuration pages.
 *
 * File         settings.php
 * Encoding     UTF-8
 *
 * @copyright   YouSeeU
 * @author      Brian Kelly <brian.kelly@youseeu.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
global $CFG;
require_once($CFG->libdir . '/adminlib.php');

require_login();

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}

// Add the Bongo configuration page to the main Admin Tree.
$ADMIN->add('tools',
    new admin_externalpage(
        'tool_bongo_settings',
        get_string('pluginname', 'tool_bongo'),
        new moodle_url('/admin/tool/bongo/index.php'),
        'moodle/course:create'
    )
);


$settings = null;
