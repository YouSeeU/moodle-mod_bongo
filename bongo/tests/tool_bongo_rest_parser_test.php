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

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot.'/admin/tool/bongo/locallib.php');

class tool_bongo_rest_parser_testcase extends basic_testcase {
    public function tool_bongo_parse_rest_response() {
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

        $parsedresponse = tool_bongo_parse_response($response);

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
