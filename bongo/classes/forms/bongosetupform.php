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
 * Default setup/settings form for bongo
 *
 * File         bongo_setup_form.php
 * Encoding     UTF-8
 *
 * @package     tool_bongo\forms
 *
 * @copyright   YouSeeU
 * @author      Brian Kelly <brian.kelly@youseeu.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_bongo\forms;

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}
global $CFG;

require_once($CFG->libdir . '/formslib.php');
require_once($CFG->dirroot . '/admin/tool/bongo/locallib.php');

/**
 * Setup/settings form for bongo
 *
 * @package     bongo
 *
 * @copyright   YouSeeU
 * @author      Brian Kelly <brian.kelly@youseeu.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class bongosetupform extends \moodleform {

    /**
     * Define form.
     */
    public function definition() {
        $mform = &$this->_form;
        // Bongo information.
        $mform->addElement('html', get_string('bongoinfo', 'tool_bongo'));

        // Moodle School Name.
        $mform->addElement('text', 'bongo_school_name', get_string('bongoschoolname', 'tool_bongo'));
        $mform->addHelpButton('bongo_school_name', 'bongoschoolname', 'tool_bongo');
        $mform->addRule('bongo_school_name', null, 'required', null, 'client');
        $mform->setType('bongo_school_name', PARAM_TEXT);

        $mform->addElement('text', 'bongo_email', get_string('email'));
        $mform->addHelpButton('bongo_email', 'bongoemail', 'tool_bongo');
        $mform->addRule('bongo_email', null, 'required', null, 'client');
        $mform->setType('bongo_email', PARAM_NOTAGS);

        // Bongo Premium Key.
        $mform->addElement('text', 'bongo_access_code', get_string('bongopremiumkey', 'tool_bongo'));
        $mform->addHelpButton('bongo_access_code', 'bongopremiumkey', 'tool_bongo');
        $mform->addRule('bongo_access_code', null, 'required', null, 'client');
        $mform->setType('bongo_access_code', PARAM_ALPHANUM);
        $mform->addElement(
            'static',
            get_string('bongopremiumkey_help', 'tool_bongo'),
            '',
            get_string('bongopremiumkey_help', 'tool_bongo')
        );

//        REMOVED FOR MOODLE MOOT. Only the NA Region will be used

        // Bongo Region selection.
//        $regions = tool_bongo_regions();
//        $radioarray = array();
//        for ($i = 0; $i < count($regions); $i++) {
//            $radioarray[] =& $mform->createElement('radio', 'bongo_region', '', $regions[$i], $i);
//        }

        // Add Bongo regions to form.

//        $mform->addGroup($radioarray, 'bongo_region_radio_array', get_string('bongoregion', 'tool_bongo'), array('</p>'), false);
//        $mform->addHelpButton('bongo_region_radio_array', 'bongoregion', 'tool_bongo');
//        $mform->addRule('bongo_region_radio_array', null, 'required', null, 'client');

        $this->add_action_buttons(true);
    }
}