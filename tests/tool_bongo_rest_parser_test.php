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
 * Tests the full parsing ability of the rest response parser.
 *
 * Builds a string that mimics what teh response from Bongo will look like. This tests the parser to see if it can
 * parse the string into a known object.
 *
 * File         tool_bongo_rest_parser_test.php
 * Encoding     UTF-8
 *
 * @copyright   YouSeeU
 * @package     mod_bongo
 * @author      Brian Kelly <brian.kelly@youseeu.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot.'/mod/bongo/locallib.php');

/**
 * Tests the full parsing ability of the rest response parser.
 *
 * @copyright   YouSeeU
 * @author      Brian Kelly <brian.kelly@youseeu.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_bongo_rest_parser_testcase extends basic_testcase {

    /**
     * Test the rest parser's ability to parse a normal message.
     */
    public function mod_bongo_parse_rest_response() {
        $url = 'https://bongo-test-site.youseeu.com/lti/school-name/connect';
        $key = '1234567890';
        $secret = 'ABCDEFGHI';
        $region = 'na';

        $response = '"body": '.
            '"{ " '.
                ' \"url\": \"' . $url . '\",'.
                ' \"key\": \"' . $key . '\",'.
                ' \"secret\": \"' . $secret . '\",'.
                ' \"region\": \"' . $region . '\"'.
            '}"';

        $parsedresponse = mod_bongo_parse_response($response);

        assert($parsedresponse->errorexists == false, 'Rest error exists in parsed object!' . var_dump($parsedresponse));
        assert(!is_null($parsedresponse->url), 'Rest URL does not exist!' . var_dump($parsedresponse));
        assert(!is_null($parsedresponse->key), 'Rest Key was not parsed correctly!' . var_dump($parsedresponse));
        assert(!is_null($parsedresponse->secret), 'Rest secret was not parsed correctly!' . var_dump($parsedresponse));
        assert(!is_null($parsedresponse->region), 'Rest region was not parsed correctly!' . var_dump($parsedresponse));

        assert($parsedresponse->url == $url, 'Rest URL was not parsed correctly!' . var_dump($parsedresponse));
        assert($parsedresponse->key == $key, 'Rest Key was not parsed correctly!' . var_dump($parsedresponse));
        assert($parsedresponse->secret == $secret, 'Rest secret was not parsed correctly!' . var_dump($parsedresponse));
        assert($parsedresponse->region == $region, 'Rest region was not parsed correctly!' . var_dump($parsedresponse));

    }
}
