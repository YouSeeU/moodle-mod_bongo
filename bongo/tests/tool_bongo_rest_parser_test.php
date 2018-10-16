<?php

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot.'/admin/tool/bongo/locallib.php');

class tool_bongo_rest_parser_testcase extends basic_testcase {
    function tool_bongo_parse_rest_response() {
        $this->resetAfterTest(true);

        $response = '"body": '.
            '"{ " '.
                ' \"url\": \"https://bongo-test-site.youseeu.com/lti/school-name/connect\",'.
                ' \"key\": \"1234567890\",'.
                ' \"secret\": \"ABCDEFGHI\",'.
                ' \"region\": \"na\"'.
            '}"';

        $parsedresponse = tool_bongo_parse_response($response);

        assert($parsedresponse->errorexists == false, 'Rest error exists in parsed object!');
    }
}
