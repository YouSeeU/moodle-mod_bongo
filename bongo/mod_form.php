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
 * Landing page in case someone tries to use the Bongo Plugin dummy activity
 *
 * File         mod_form.php
 * Encoding     UTF-8
 *
 * @copyright   YouSeeU
 * @package     mod_bongo
 * @author      Brian Kelly <brian.kelly@youseeu.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}

require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot . '/mod/bongo/locallib.php');

/**
 * Landing page in case someone tries to use the Bongo Plugin dummy activity
 *
 * @copyright   YouSeeU
 * @author      Brian Kelly <brian.kelly@youseeu.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_bongo_mod_form extends moodleform_mod {

    /**
     * Override parent function. This function is only used if someone has enabled the disabled part of the plugin.
     *
     * We do not want them to do this, but we need to gracefully handle it and guide them back in the right direction.
     * We re-disable the plugin and guide them back to the Bongo config page.
     */
    public function definition() {
        // Before we do anything, make sure the dummy version of the Bongo Activity plugin is disabled.
        mod_bongo_disable_dummy_plugin();

        redirect(
            new moodle_url('/mod/bongo/index.php'),
            get_string('bongopluginnotconfigured', 'mod_bongo')
        );
    }
}