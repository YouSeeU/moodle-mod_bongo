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
 * @copyright   Bongo
 * @package     local_bongo
 * @author      Brian Kelly <brian.kelly@bongolearn.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

require_once('../../config.php');
global $CFG, $DB;
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->dirroot . '/local/bongo/locallib.php');

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
    redirect(new moodle_url('/'), get_string('bongoaccessdenied', 'local_bongo'));
}

$PAGE->set_context($context);
$PAGE->set_url('/local/bongo/index.php');
$PAGE->set_title(get_string('pluginsettings', 'local_bongo'));
$PAGE->set_heading(get_string('pluginsettings', 'local_bongo'));
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');

admin_externalpage_setup('local_bongo_settings');

// Log that we have seen the bongo config at least once.
local_bongo_set_bongo_config_viewed();

$form = new \local_bongo\forms\bongosetupform();

if ($form->is_cancelled()) {
    redirect(new moodle_url('/admin/search.php'));
} else if ($data = $form->get_data()) {
    $dbobject = new stdClass();
    $dbobject->name = $data->bongo_school_name;
    $dbobject->customer_email = $data->bongo_email;
    $dbobject->access_code = $data->bongo_access_code;
    $dbobject->timezone = date_default_timezone_get();
    $dbobject->region = localbongoconstants::LOCAL_BONGO_REGION_NA;

    $bongorecords = $DB->get_records('bongo', array());
    if (!empty($bongorecords)) {
        redirect(
            new moodle_url('/local/bongo/index.php'),
            get_string('pluginsettingsalreadyconfigured', 'local_bongo')
        );
    }

    $registrationresponse = local_bongo_set_up_bongo($dbobject);

    // If there was an error in the call to Bongo, display the parsed error and redirect the page.
    if ($registrationresponse->errorexists == true || is_null($registrationresponse->url)) {
        redirect(
            new moodle_url('/local/bongo/index.php'),
            $registrationresponse->errormessage
        );
    }

    $dbobject->hostname = $registrationresponse->url;
    $dbobject->ltikey = $registrationresponse->ltikey;
    $dbobject->secret = $registrationresponse->secret;
    $dbobject->lti_type_id = $registrationresponse->lti_type_id;
    $dbobject->course = $registrationresponse->course_id;
    $dbobject->module_id = $registrationresponse->module_id;

    $DB->insert_record('bongo', $dbobject);

    // Save plugin config.
    foreach ($dbobject as $name => $value) {
        set_config($name, $value, 'local_bongo');
    }

    // Trigger a bongo configured event.
    \local_bongo\event\bongo_configured::create(
        array(
            'context' => context_system::instance(),
            'objectid' => $dbobject->course)
    )->trigger();

    redirect(
        new moodle_url('/local/bongo/view.php?moduleid=' . $registrationresponse->module_id),
        get_string('bongochangessaved', 'local_bongo')
    );
}

// Build the page output.
echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginsettings', 'local_bongo'));
$form->display();
echo $OUTPUT->footer();
