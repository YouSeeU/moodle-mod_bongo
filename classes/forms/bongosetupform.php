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
 * Default setup/settings form for bongo.
 *
 * This is the main configuration page for anyone trying to configure the Bongo plugin.
 *
 * File         bongosetupform.php
 * Encoding     UTF-8
 *
 *
 * @copyright   Bongo
 * @package     local_bongo
 * @author      Brian Kelly <brian.kelly@bongolearn.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_bongo\forms;

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}
global $CFG, $PAGE;

// Load javascript into page.
$PAGE->requires->js_call_amd('local_bongo/app', 'init');

require_once($CFG->libdir . '/formslib.php');
require_once($CFG->dirroot . '/local/bongo/locallib.php');

/**
 * Default setup/settings form for bongo.
 *
 * @copyright   Bongo
 * @author      Brian Kelly <brian.kelly@bongolearn.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class bongosetupform extends \moodleform {

    /**
     * Define form.
     */
    public function definition() {
        $mform = &$this->_form;
        // Bongo information.
        $mform->addElement('html', get_string('bongoinfo', 'local_bongo'));

        // Moodle School Name.
        $mform->addElement('text', 'bongo_school_name', get_string('bongoschoolname', 'local_bongo'));
        $mform->addHelpButton('bongo_school_name', 'bongoschoolname', 'local_bongo');
        $mform->addRule('bongo_school_name', null, 'required', null, 'client');
        $mform->addRule(
            'bongo_school_name',
            get_string('bongoschoolformat', 'local_bongo'),
            'regex',
            '/^[A-Za-z0-9 ]+$/',
            'server'
        );
        $mform->setType('bongo_school_name', PARAM_RAW);

        $mform->addElement('text', 'bongo_email', get_string('bongoemail', 'local_bongo'));
        $mform->addHelpButton('bongo_email', 'bongoemail', 'local_bongo');
        $mform->addRule('bongo_email', null, 'required', null, 'client');
        $mform->addRule('bongo_email', get_string('err_email', 'form'), 'email', null, 'client');
        $mform->setType('bongo_email', PARAM_RAW);

        // Bongo Premium Key.
        $mform->addElement('text', 'bongo_access_code', get_string('bongopremiumkey', 'local_bongo'));
        $mform->addHelpButton('bongo_access_code', 'bongopremiumkey', 'local_bongo');
        $mform->addRule('bongo_access_code', null, 'required', null, 'client');
        $mform->addRule(
            'bongo_access_code',
            get_string('bongopremiumkeyformat', 'local_bongo'),
            'regex',
            '/^[A-Za-z0-9-]+$/',
            'server'
        );
        $mform->setType('bongo_access_code', PARAM_RAW);

        // Bongo Region selection to go here. Reference https://docs.moodle.org/dev/lib/formslib.php_Form_Definition#radio.

        $mform->addElement(
            'static',
            get_string('bongopremiumkey_help', 'local_bongo'),
            '',
            get_string('bongopremiumkey_help', 'local_bongo')
        );
        $mform->addElement(
            'static',
            get_string('bongolanguages', 'local_bongo'),
            '',
            get_string('bongolanguages', 'local_bongo')
        );

        $this->add_action_buttons(true, get_string('bongosubmitbutton_label', 'local_bongo'));
        $mform->addElement('html', '<div id=\'bongo-submitting-loader\' style=\'display:none\'>'.
            '<div id=\'bongo-submitting-loader-icon\'/></div>'.
            '<span id=\'bongo-submitting-loader-text\'>' . get_string('bongosubmitting_label', 'local_bongo') . '</span></div>');
    }
}