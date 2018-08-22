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
 * Meta-data about the plugin (like the version number, dependencies or the maturity level) are defined here.
 *
 *
 * File         version.php
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

$plugin->version = 2017102000;

// Moodle 2.7.0 is required. This is because the mod_lti plugin was not available until 2.7.0.
$plugin->requires = 2014051200;
$plugin->component = 'tool_bongo';
$plugin->maturity = MATURITY_ALPHA;
$plugin->release = 'moodle_3.5_r1-a';

$plugin->dependencies = [
    'mod_lti' => ANY_VERSION
];
