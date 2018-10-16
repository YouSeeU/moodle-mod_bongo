<?php

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot.'/admin/tool/bongo/locallib.php');

class tool_bongo_rest_parser_testcase extends basic_testcase {
    function tool_bongo_parse_rest_response() {
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
