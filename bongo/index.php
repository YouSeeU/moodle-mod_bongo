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
 * Bongo configuration workflow. Contains the "Main Page" of the Bongo plugin.
 *
 * File         index.php
 * Encoding     UTF-8
 *
 * @copyright   YouSeeU
 * @package     mod_bongo
 * @author      Brian Kelly <brian.kelly@youseeu.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

require_once('../../config.php');
global $CFG, $DB;
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->dirroot . '/mod/bongo/locallib.php');

defined('MOODLE_INTERNAL') || die();
require_login();
$context = context_system::instance();

if (
!(
    isloggedin()
    and !isguestuser()
    and has_capability('moodle/site:config', $context)
)
) {
    redirect(new moodle_url('/'), get_string('bongoaccessdenied', 'mod_bongo'));
}

$PAGE->set_context($context);
$PAGE->set_url('/mod/bongo/index.php');
$PAGE->set_title(get_string('pluginsettings', 'mod_bongo'));
$PAGE->set_heading(get_string('pluginsettings', 'mod_bongo'));
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');

admin_externalpage_setup('mod_bongo_settings');

$form = new \mod_bongo\forms\bongosetupform();

if ($form->is_cancelled()) {
    redirect(new moodle_url('/admin/search.php'));
} else if ($data = $form->get_data()) {
    $dbobject = new stdClass();
    $dbobject->name = $data->bongo_school_name;
    $dbobject->customer_email = $data->bongo_email;
    $dbobject->access_code = $data->bongo_access_code;
    $dbobject->timezone = date_default_timezone_get();
    $dbobject->region = $data->bongo_region;

    $bongorecords = $DB->get_records('bongo', array('name' => $dbobject->name));
    if (!empty($bongorecords)) {
        redirect(
            new moodle_url('/mod/bongo/index.php'),
            get_string('pluginsettingsalreadyconfigured', 'mod_bongo')
        );
    }

    $registrationresponse = mod_bongo_set_up_bongo($dbobject);

    // If there was an error in the call to Bongo, display the parsed error and redirect the page.
    if ($registrationresponse->errorexists == true || is_null($registrationresponse->url)) {
        redirect(
            new moodle_url('/mod/bongo/index.php'),
            $registrationresponse->errormessage
        );
    }

    $dbobject->hostname = $registrationresponse->url;
    $dbobject->key = $registrationresponse->key;
    $dbobject->secret = $registrationresponse->secret;
    $dbobject->lti_type_id = $registrationresponse->lti_type_id;
    $dbobject->course = $registrationresponse->course_id;

    $DB->insert_record('bongo', $dbobject);

    // Save plugin config.
    foreach ($dbobject as $name => $value) {
        set_config($name, $value, 'mod_bongo');
    }

    // Trigger a bongo configured event.
    // $event = \mod_bongo\event\bongo_configured::create();
    // $event->trigger();

    redirect(
        new moodle_url('/mod/bongo/view.php?moduleid=' . $registrationresponse->module_id),
        get_string('bongochangessaved', 'mod_bongo')
    );
}

// Build the page output.
echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginsettings', 'mod_bongo'));
$form->display();
echo $OUTPUT->footer();
