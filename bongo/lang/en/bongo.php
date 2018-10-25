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
 * English strings for the plugin are defined here. Only string that appear to the user are listed. For internal strings
 * see the constants.php file.
 * At least $string['pluginname'] must be present.
 * String API provides information about the string files.
 *
 * Usage: get_string('pluginname', 'mod_bongo')
 *  - first argument is the string index, the second is the plugin that owns the string index
 *
 * File         mod_bongo.php
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

$string['bongoaccessdenied'] = 'You are not allowed to configure the Bongo Plugin.'.
    ' Please see an administrator for more information.';
$string['bongoinfo'] = 'For more information on Bongo and how it works see: <a href="http://www.bongolearn.com">www.bongolearn.com</a>';
$string['plugindescription'] = 'Bongo';
$string['pluginname'] = 'Bongo';
$string['modulename'] = 'Bongo';
$string['modulenameplural'] = 'Bongos';
$string['plugininformation'] = '<b>Thank you for installing Bongo!</b>'.
    '</p>To use Bongo in your courses, you must first add it from the activity resource menu on the main class page. '.
    'Once you click on the Bongo activity, you will be taken directly to the platform.' .
    '</p>We are excited to show you Bongo, and we look forward to you experiencing everything it has to offer. '.
    '</p>Ready to <b>feel the beat</b>, with Bongo! Click the button below to check out our demo course. ';
$string['plugininformationpage'] = 'Bongo Information';
$string['pluginsettings'] = 'Bongo Configuration';
$string['pluginsettingsalreadyconfigured'] = 'Bongo is already configured!';
$string['pluginsettingscanceled'] = 'Bongo configuration canceled';

// Form info.
$string['bongochangessaved'] = 'Changes saved!';
$string['bongopremiumkey'] = 'Bongo Access Code';
$string['bongopremiumkey_help'] = ' If you do not have a key please <a href="https://www.bongolearn.com/activation-code">Visit Our Site</a>.';
$string['bongoschoolname'] = 'Moodle School Name';
$string['bongoschoolname_help'] = 'Name of the school you are associated with.';
$string['bongoschoolformat'] = 'Please use only Upper Case, lower case, numbers, and spaces';
$string['bongoregion'] = 'Region';
$string['bongoregion_help'] = 'What area of the world are you installing this plugin to?';
$string['bongoemail'] = 'Email Address';
$string['bongoemail_help'] = 'Email Address that Bongo can use to contact you about your trial';


// Regions.
$string['bongoau'] = 'Australia';
$string['bongoca'] = 'Canada';
$string['bongoeu'] = 'Europe';
$string['bongona'] = 'North America';
$string['bongosa'] = 'South America';

// Course Strings.
$string['bongoexamplecourse'] = 'Bongo Example Course';
$string['bongocontinue'] = 'Take me to Bongo';
$string['bongoactivity'] = 'Bongo Activity';

// Error Strings.
$string['bongoresterror'] = 'An error occurred while contacting Bongo';
$string['bongoresterrorinvalidtoken'] = 'That token is invalid. Please contact Bongo for a new key.';
$string['bongoresterrorexpiredtoken'] = 'That token is expired. Please contact Bongo for a new key.';

// Form Actions
$string['bongosubmitbutton_label'] = 'Create';
$string['bongosubmitting_label'] = 'Please wait while your Bongo instance is being created. Do not navigate away from this page.';
