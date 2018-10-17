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
 * Internal library functions for bongo
 *
 * The interface between the Moodle core and the plugin is defined here for the most plugin types.
 * The expected contents of the file depends on the particular plugin type.
 *
 * Moodle core often (but not always) loads all the lib.php files of the given plugin types. For the performance
 * reasons, it is strongly recommended to keep this file as small as possible and have just required code implemented
 * in it. All the plugin's internal logic should be implemented in the auto-loaded classes or in the locallib.php file.
 *
 * Call the Bongo REST API to create new institution and set up LTI consumer
 *
 *
 *
 * File         locallib.php
 * Encoding     UTF-8
 *
 * @copyright   YouSeeU
 * @author      Brian Kelly <brian.kelly@youseeu.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

require_once(__DIR__ . '/../../../config.php');
global $CFG, $DB;
require_once($CFG->dirroot . '/mod/lti/locallib.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/course/modlib.php');
require_once($CFG->dirroot . '/admin/tool/bongo/constants.php');

require_login();
if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}

/**
 * Creates an array of Bongo regions to show to the user on the configuration page
 *
 * @return array
 */
function tool_bongo_regions() {
    // These are not string constants because this array is shown to the user.
    return array(
        get_string('bongona', 'tool_bongo'),
        get_string('bongoca', 'tool_bongo'),
        get_string('bongosa', 'tool_bongo'),
        get_string('bongoeu', 'tool_bongo'),
        get_string('bongoau', 'tool_bongo')
    );
}

/**
 * Set up everything necessary to connect to Bongo
 * - Create Course
 * - Create LTI Type (Connector on Moodle side)
 * - Create activity in Course
 * - Register with Bongo
 * - Create Activity in Course and attach Activity to LTI Type
 *
 * @param stdClass $requestobject
 * @return stdClass
 */
function tool_bongo_set_up_bongo($requestobject) {
    $courseid = tool_bongo_create_mod_course();
    $coursesection = tool_bongo_get_course_section_id($courseid);
    $ltimoduleid = tool_bongo_get_lti_module_id();

    // Bongo will need the ID of the course that was created for linking.
    $requestobject->course_id = $courseid;

    // Format and execute rest call to Bongo to register.
    $parsedresponse = tool_bongo_register_with_bongo($requestobject);
    if($parsedresponse->errorexists == false){
        $ltitypeid = tool_bongo_create_lti_tool($parsedresponse->secret, $parsedresponse->key, $parsedresponse->url);
        $coursemoduleid = tool_bongo_create_course_module($courseid, $coursesection, $ltitypeid, $ltimoduleid);
        $parsedresponse->lti_type_id = $ltitypeid;
        $parsedresponse->module_id = $coursemoduleid;
        $parsedresponse->course_id = $courseid;
    }

    return $parsedresponse;
}

/**
 * Format a rest request and send to Bongo for registration
 *
 * @param stdClass $requestobject
 * @return stdClass Bongo's response, parsed to extract errors, key, secret, url and any other messages for the Bongo plugin
 */
function tool_bongo_register_with_bongo($requestobject) {
    $requestfields = constants::TOOL_BONGO_NAME . '=' . $requestobject->school_name
        . '&' . constants::TOOL_BONGO_REGION . '=' . $requestobject->region
        . '&' . constants::TOOL_BONGO_PREMIUM_KEY . '=' . $requestobject->premium_key
        . '&' . constants::TOOL_BONGO_COURSE_ID . '=' . $requestobject->course_id
        . '&' . constants::TOOL_BONGO_REST_CALL_TYPE . '=' . constants::TOOL_BONGO_REST_CALL_TYPE_INSTALL;
    $resultresponse = tool_bongo_execute_rest_call(constants::TOOL_BONGO_MOODLE_LAMBDA_ADDRESS, $requestfields);
    $parsedresponse = tool_bongo_parse_response($resultresponse);

    $errorresponse = tool_bongo_handle_rest_errors($parsedresponse);
    $parsedresponse->errorexists = $errorresponse->errorexists;
    $parsedresponse->errormessage = $errorresponse->errormessage;

    return $parsedresponse;
}

/**
 * Curl call to supplied address using the supplied post fields
 *
 * @param string $urladdress
 * @param string $postfields
 * @return stdClass
 */
function tool_bongo_execute_rest_call($urladdress, $postfields) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $urladdress);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
        $postfields
    );
    curl_setopt($ch, CURLOPT_POST, 1);

    $headers = array();
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        print 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    return $result;
}

/**
 * Parse the JSON response that came from the curl call
 *
 * @param string $jsonresult
 * @return stdClass
 */
function tool_bongo_parse_response($jsonresult) {
    $jsonresponse = json_decode($jsonresult, true, 512);
    $body = $jsonresponse;
    $message = (array_key_exists(constants::TOOL_BONGO_MESSAGE, $body) ? $body[constants::TOOL_BONGO_MESSAGE] : null);
    $secret = (array_key_exists(constants::TOOL_BONGO_SECRET, $body) ? $body[constants::TOOL_BONGO_SECRET] : null);
    $key = (array_key_exists(constants::TOOL_BONGO_KEY, $body) ? $body[constants::TOOL_BONGO_KEY] : null);
    $url = (array_key_exists(constants::TOOL_BONGO_URL, $body) ? $body[constants::TOOL_BONGO_URL] : null);
    $region = (array_key_exists(constants::TOOL_BONGO_REGION, $body) ? $body[constants::TOOL_BONGO_REGION] : null);

    $parsedresponse = new stdClass();
    $parsedresponse->secret = $secret;
    $parsedresponse->key = $key;
    $parsedresponse->url = $url;
    $parsedresponse->region = $region;
    $parsedresponse->message = $message;

    return $parsedresponse;
}

/**
 * Creates the Moodle LTI Type (External Tool)
 *
 * @param string $secret
 * @param string $key
 * @param string $url
 * @return int id
 */
function tool_bongo_create_lti_tool($secret, $key, $url) {
    global $DB;

    // If the lti tool has already been inserted, use the previous one.
    $ltitypes = $DB->get_records('lti_types', array('name' => get_string('pluginname', 'tool_bongo')));
    if (!empty($ltitypes)) {
        $id = -1;
        foreach ($ltitypes as $type) {
            $type->lti_resourcekey = $key;
            $type->lti_password = $secret;
            $id = $DB->update_record('lti_types', $type);
        }
        return $id;
    }

    $config = tool_bongo_create_lti_type_config($url, $key, $secret);

    $type = new \stdClass();
    $type->state = LTI_TOOL_STATE_CONFIGURED;

    lti_add_type($type, $config);
    $ltitype = $DB->get_record('lti_types', array('name' => get_string('pluginname', 'tool_bongo')));
    $id = $ltitype->id;

    return $id;
}

/**
 * Build the object necessary to insert the Bongo LTI type into the database
 *
 * @param String $url URL of the Bongo LTI endpoint
 * @param String $key unique key to identify Moodle installation
 * @param String $secret unique secret to authenticate to Bongo
 * @return stdClass database-ready object containing necessary fields for persisting
 */
function tool_bongo_create_lti_type_config($url, $key, $secret){
    // Create built in LTI tool.
    $config = new \stdClass();
    $config->lti_toolurl = $url;
    $config->lti_typename = get_string('pluginname', 'tool_bongo');
    $config->lti_description = get_string('plugindescription', 'tool_bongo');
    $config->lti_coursevisible = 2;
    $config->lti_icon = constants::TOOL_BONGO_FAVICON_URL;
    $config->lti_secureicon = constants::TOOL_BONGO_FAVICON_URL;
    $config->lti_state = 1;
    $config->lti_resourcekey = $key;
    $config->lti_password = $secret;

    // LTI Types Config.
    $config->lti_sendname = 1;
    $config->lti_sendemailaddr = 1;
    $config->lti_acceptgrades = 1;
    $config->lti_launchcontainer = 3;

    return $config;
}

/**
 * Gets the internal id of "lti" from the modules table
 *
 * @return int id
 */
function tool_bongo_get_lti_module_id() {
    global $DB;
    $module = $DB->get_record('modules', array('name' => 'lti'));

    return $module->id;
}

/**
 * Creates a course to be used as an example of using Bongo
 *
 * @return int
 */
function tool_bongo_create_mod_course() {
    global $DB;

    // If the course has already been inserted, use the previous one.
    $courses = $DB->get_records('course', array('fullname' => get_string('bongoexamplecourse', 'tool_bongo')));
    if (!empty($courses)) {
        $id = -1;
        foreach ($courses as $course) {
            $id = $course->id;
        }
        return $id;
    }

    $config = tool_bongo_create_course_object();

    create_course($config);
    $course = $DB->get_record('course', array('fullname' => get_string('bongoexamplecourse', 'tool_bongo')));
    $id = $course->id;

    return $id;
}

function tool_bongo_create_course_object(){
    $config = new stdClass();
    $config->fullname = get_string('bongoexamplecourse', 'tool_bongo');
    $config->shortname = get_string('bongoexamplecourse', 'tool_bongo');
    $config->summary = get_string('bongoexamplecourse', 'tool_bongo');
    $config->category = 1;
    $config->startdate = time();
    $config->timecreated = time();
    $config->timemodified = time();

    return $config;
}

/**
 * @param int $courseid
 * @return int section id
 */
function tool_bongo_get_course_section_id($courseid) {
    global $DB;
    $section = $DB->get_record('course_sections', array('course' => $courseid));

    return $section->id;
}

/**
 * Create Activity inside of new course so we can launch directly into Bongo in the example
 *
 * @param int $courseid
 * @param int $sectionid
 * @param int $ltitypeid
 * @param int $ltimoduleid
 * @return int coursemodule id
 */
function tool_bongo_create_course_module($courseid, $sectionid, $ltitypeid, $ltimoduleid) {
    $moduleinfo = tool_bongo_create_course_module_object($ltitypeid, $courseid, $sectionid, $ltimoduleid);

    $course = new stdClass();
    $course->id = $courseid;
    $coursemodule = add_moduleinfo($moduleinfo, $course);

    return $coursemodule->coursemodule;
}

/**
 * Create a database persist-ready object to be passed into
 *
 * @param int $ltitypeid database id of the lti type that was created
 * @param int $courseid database id of the course that was created
 * @param int $sectionid database id of the course section that was created
 * @param int $ltimoduleid database id of the lti module that was created
 * @return stdClass database persist-ready object
 */
function tool_bongo_create_course_module_object($ltitypeid, $courseid, $sectionid, $ltimoduleid){
    // Module test values.
    $moduleinfo = new stdClass();

    // Always mandatory generic values to any module.
    $moduleinfo->name = get_string('bongoactivity', 'tool_bongo');;
    $moduleinfo->showdescription = 0;
    $moduleinfo->showtitlelaunch = 1;
    $moduleinfo->typeid = $ltitypeid;
    $moduleinfo->urlmatchedtypeid = $ltitypeid;
    $moduleinfo->launchcontainer = 1;
    $moduleinfo->instructorchoicesendname = 1;
    $moduleinfo->instructorchoicesendemailaddr = 1;
    $moduleinfo->instructorchoiceacceptgrades = 1;
    $moduleinfo->grade = 100;
    $moduleinfo->visible = true;
    $moduleinfo->visibleoncoursepage = true;
    $moduleinfo->course = $courseid;
    $moduleinfo->section = $sectionid; // This is the section number in the course. Not the section id in the database.
    $moduleinfo->module = $ltimoduleid;
    $moduleinfo->modulename = constants::TOOL_BONGO_LTI;
    $moduleinfo->instance = $ltitypeid;
    $moduleinfo->add = constants::TOOL_BONGO_LTI;
    $moduleinfo->update = 0;
    $moduleinfo->return = 0;

    return $moduleinfo;
}

/**
 * Notify Bongo that plugin was uninstalled.
 *
 * This allows Bongo to cleanup unwanted installations and de-provision them.
 */
function tool_bongo_unregister_bongo_integration() {
    $bongoconfig = get_config('tool_bongo');

    // If the plugin was not configured, don't bother with a rest call
    if(isset($bongoconfig->key)){
        $requestfields = constants::TOOL_BONGO_KEY . '=' . $bongoconfig->key
            . '&' . constants::TOOL_BONGO_REST_CALL_TYPE . '=' . constants::TOOL_BONGO_REST_CALL_TYPE_UNINSTALL;
        $resultresponse = tool_bongo_execute_rest_call(constants::TOOL_BONGO_MOODLE_LAMBDA_ADDRESS, $requestfields);
    }
}

/**
 * Takes a parsed response object and handles the errors that came back from the REST call
 * @param stdClass $parsedresponse
 * @return stdClass if there was an error in the rest response
 */
function tool_bongo_handle_rest_errors($parsedresponse){
    $moodleerror = new stdClass();
    $errorexists = false;
    $errormessage = false;
    if(!is_null($parsedresponse->message)){
        $message = $parsedresponse->message;
        switch ($message) {
            case 'Internal server error':
                $errorexists = true;
                $errormessage = get_string('bongoresterror', 'tool_bongo');
                break;
            default:
                // No errors were found!
                break;
        }
    }
    $moodleerror->errorexists = $errorexists;
    $moodleerror->errormessage = $errormessage;

    return $moodleerror;
}
