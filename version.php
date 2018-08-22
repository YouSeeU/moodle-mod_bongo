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
 * @package   mod_bongo
 * @copyright 2018, Brian Kelly <brian.kelly@youseeu.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


/**
 * Meta-data about the plugin (like the version number, dependencies or the maturity level) are defined here.
 * version.php page provides detailed description of the file contents
 */


defined('MOODLE_INTERNAL') || die();

$plugin->version = 2017102000;
$plugin->requires = 2014051200;// Moodle 2.7.0 is required.
//$plugin->cron = 0;
$plugin->component = 'mod_bongo';
$plugin->maturity = MATURITY_ALPHA;
$plugin->release = 'moodle_3.5_r1-a';

//$plugin->dependencies = [
//    'mod_forum' => ANY_VERSION,
//    'mod_data' => TODO
//];