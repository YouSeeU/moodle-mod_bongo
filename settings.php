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
 *
 * The setting names are supposed to be plugintype_pluginname/settingname (note the slash) and not
 * plugintype_pluginname_settingname or even just settingname. This makes them to be stored in the config_plugins
 * table without polluting the global $CFG object.
 *
 * Registers external configuration pages.
 *
 * File         settings.php
 * Encoding     UTF-8
 *
 * @copyright   Bongo
 * @package     local_bongo
 * @author      Brian Kelly <brian.kelly@bongolearn.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}

global $CFG;
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->dirroot . '/local/bongo/locallib.php');

// If plugin was just installed, view the config page once.
if ($ADMIN->fulltree) {
    $bongoplugin = $DB->get_records('local_bongo', array());
    if (empty($bongoplugin)) {
        // Only force viewing config if this is the first time they have seen the config.
        $viewed = local_bongo_get_bongo_config_viewed();
        if (!$viewed) {
            redirect(new moodle_url('/local/bongo/index.php'));
        }
    }
}

// Add settings page to the main admin tree.
if ($hassiteconfig) { // Needs this condition or there is error on login page.
    $ADMIN->add('localplugins',
        new admin_externalpage(
            'local_bongo_settings',
            get_string('pluginname', 'local_bongo'),
            new moodle_url('/local/bongo/index.php'),
            'moodle/course:create'
        )
    );
}
