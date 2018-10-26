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

require_once($CFG->dirroot.'/mod/bongo/locallib.php');

class mod_bongo_parse_rest_errors_testcase extends basic_testcase {
    public function mod_bongo_get_rest_errors() {
        $this->resetAfterTest(true);

        $parsedresponse = new stdClass();
        $parsedresponse->message = 'Internal Server Error';

        $resterror = mod_bongo_handle_rest_errors($parsedresponse);

        assert($resterror->errorexists == true, 'Rest error does not exist in parsed object!');
    }
}
