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
 * Internal constants, never to be seen by a user
 *
 * File         constants.php
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

class constants{
    const MOD_BONGO_MOODLE_LAMBDA_ADDRESS = 'https://bongo-gss.youseeu.com/api/provision';
    const MOD_BONGO_FAVICON_URL = 'https://s3.amazonaws.com/ysumisc/Bongo_Favicon.png';
    const MOD_BONGO_SECRET = 'secret';
    const MOD_BONGO_KEY = 'key';
    const MOD_BONGO_URL = 'url';
    const MOD_BONGO_REGION = 'bongoRegion';
    const MOD_BONGO_TIMEZONE = 'timezone';
    const MOD_BONGO_NAME = 'institutionName';
    const MOD_BONGO_ACCESS_CODE = 'accessCode';
    const MOD_BONGO_CUSTOMER_EMAIL = 'customerEmail';
    const MOD_BONGO_LMS_CODE = 'lmsCode';
    const MOD_BONGO_LTI = 'lti';
    const MOD_BONGO_MESSAGE = 'message';
    const MOD_BONGO_CODE = 'code';

    const MOD_BONGO_REST_CALL_TYPE = 'type';
    const MOD_BONGO_REST_CALL_TYPE_INSTALL = 'install';
    const MOD_BONGO_REST_CALL_TYPE_UNINSTALL = 'uninstall';

    const MOD_BONGO_REGION_NA = 'bongo-na';
    const MOD_BONGO_REGION_SA = 'bongo-sa';
    const MOD_BONGO_REGION_CA = 'bongo-ca';
    const MOD_BONGO_REGION_EU = 'bongo-eu';
    const MOD_BONGO_REGION_AU = 'bongo-au';
}
