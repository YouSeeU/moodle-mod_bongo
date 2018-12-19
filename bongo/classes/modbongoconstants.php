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
 * @package     mod_bongo
 * @author      Brian Kelly <brian.kelly@youseeu.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}

/**
 * Internal constants, never to be seen by a user
 *
 * @copyright   YouSeeU
 * @author      Brian Kelly <brian.kelly@youseeu.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class modbongoconstants{
    /**
     * The address of the REST Url endpoint in Bongo.
     */
    const MOD_BONGO_MOODLE_LAMBDA_ADDRESS = 'https://bongo-gss.youseeu.com/api/provision';

    /**
     * The address of the Bongo Favicon used when a Bongo activity is added to a class.
     */
    const MOD_BONGO_FAVICON_URL = 'https://s3.amazonaws.com/ysumisc/Bongo_Favicon.png';

    /**
     * JSON key for the incoming 'secret' entry.
     */
    const MOD_BONGO_SECRET = 'secret';

    /**
     * JSON key for the incoming 'key' entry.
     */
    const MOD_BONGO_KEY = 'key';

    /**
     * JSON key for the incoming 'url' entry.
     */
    const MOD_BONGO_URL = 'url';

    /**
     * JSON key for the outgoing 'bongoRegion' entry.
     */
    const MOD_BONGO_REGION = 'bongoRegion';

    /**
     * JSON key for the outgoing 'institutionName' entry.
     */
    const MOD_BONGO_NAME = 'institutionName';

    /**
     * JSON key for the outgoing 'accessCode' entry.
     */
    const MOD_BONGO_ACCESS_CODE = 'accessCode';

    /**
     * JSON key for the outgoing 'customerEmail' entry.
     */
    const MOD_BONGO_CUSTOMER_EMAIL = 'customerEmail';

    /**
     * JSON key for the outgoing 'lmsCode' entry.
     */
    const MOD_BONGO_LMS_CODE = 'lmsCode';

    /**
     * Object key for the creating the lti type.
     */
    const MOD_BONGO_LTI = 'lti';

    /**
     * JSON key for the 'message' entry.
     */
    const MOD_BONGO_MESSAGE = 'message';

    /**
     * Object key for the 'code' entry.
     */
    const MOD_BONGO_CODE = 'code';

    /**
     * Object key for the 'verison' entry.
     */
    const MOD_BONGO_VERSION = 'version';

    /**
     * Object key for the 'moodle_verison' entry.
     */
    const MOD_BONGO_MOODLE_VERSION = 'moodle_version';

    /**
     * Object key for the 'moodle_dir_root' entry.
     */
    const MOD_BONGO_MOODLE_DIR_ROOT = 'moodle_dir_root';

    /**
     * Object key for the 'db_type' entry.
     */
    const MOD_BONGO_MOODLE_DB_TYPE = 'moodle_db_type';

    /**
     * JSON key for the 'type' entry.
     */
    const MOD_BONGO_REST_CALL_TYPE = 'type';

    /**
     * JSON value for the 'type' entry.
     */
    const MOD_BONGO_REST_CALL_TYPE_INSTALL = 'install';

    /**
     * JSON value for the 'type' entry.
     */
    const MOD_BONGO_REST_CALL_TYPE_UNINSTALL = 'uninstall';

    /**
     * JSON value for the 'bongoRegion' entry.
     */
    const MOD_BONGO_REGION_NA = 'bongo-na';

    /**
     * JSON value for the 'bongoRegion' entry.
     */
    const MOD_BONGO_REGION_SA = 'bongo-sa';

    /**
     * JSON value for the 'bongoRegion' entry.
     */
    const MOD_BONGO_REGION_CA = 'bongo-ca';

    /**
     * JSON value for the 'bongoRegion' entry.
     */
    const MOD_BONGO_REGION_EU = 'bongo-eu';

    /**
     * JSON value for the 'bongoRegion' entry.
     */
    const MOD_BONGO_REGION_AU = 'bongo-au';
}
