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
 * Passthrough form to relay information about Bongo before launching into demo course.
 *
 * File         bongo_information_form.php
 * Encoding     UTF-8
 *
 * @package     mod_bongo\forms
 *
 * @copyright   YouSeeU
 * @author      Brian Kelly <brian.kelly@youseeu.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_bongo\forms;

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}
global $CFG;

require_once($CFG->libdir . '/formslib.php');

/**
 * This page describes what Bongo is, what the plugin just did, and welcomes them to Bongo.
 *
 * @package     bongo
 *
 * @copyright   YouSeeU
 * @author      Brian Kelly <brian.kelly@youseeu.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class bongoinformationform extends \moodleform {

    /**
     * Define form.
     */
    public function definition() {
        $mform = &$this->_form;
        // Bongo information page.

        // Breadcrumb content.
        $mform->addElement('html', get_string('plugininformation', 'mod_bongo'));

        // Hidden field to store module id through another submit.
        $mform->addElement('hidden', 'bongo_module_id');
        $mform->setType('bongo_module_id', PARAM_TEXT);

        // Add custom submit button.
        $mform->addElement('submit', 'submitbutton', get_string('bongocontinue', 'mod_bongo'));
    }
}