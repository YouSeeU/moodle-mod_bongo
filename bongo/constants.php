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

class constants{
    const TOOL_BONGO_MOODLE_LAMBDA_ADDRESS = 'https://z6yyes4sc0.execute-api.us-east-1.amazonaws.com/dev/register';
    const TOOL_BONGO_FAVICON_URL = 'https://s3.amazonaws.com/ysumisc/Bongo_Favicon.png';
    const TOOL_BONGO_SECRET = 'secret';
    const TOOL_BONGO_KEY = 'key';
    const TOOL_BONGO_URL = 'url';
    const TOOL_BONGO_REGION = 'region';
    const TOOL_BONGO_TIMEZONE = 'timezone';
    const TOOL_BONGO_NAME = 'name';
    const TOOL_BONGO_PREMIUM_KEY = 'premiumkey';
    const TOOL_BONGO_COURSE_ID = 'courseid';
    const TOOL_BONGO_LTI = 'lti';

    const TOOL_BONGO_REST_CALL_TYPE = 'type';
    const TOOL_BONGO_REST_CALL_TYPE_INSTALL = '0';
    const TOOL_BONGO_REST_CALL_TYPE_UNINSTALL = '1';
}