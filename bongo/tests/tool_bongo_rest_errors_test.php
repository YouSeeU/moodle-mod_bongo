<?php

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot.'/admin/tool/bongo/locallib.php');

class tool_bongo_parse_rest_errors_testcase extends basic_testcase {
    function tool_bongo_get_rest_errors() {
        $this->resetAfterTest(true);

        $parsedresponse = new stdClass();
        $parsedresponse->message = 'Internal Server Error';

        $resterror = tool_bongo_handle_rest_errors($parsedresponse);

        assert($resterror->errorexists == true, 'Rest error does not exist in parsed object!');
    }
}
