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
 * Informational page in between the configuration page and the course page. Gives
 * information about what Bongo is and what the plugin just configured.
 *
 *
 * File         view.php
 * Encoding     UTF-8
 *
 * @copyright   YouSeeU
 * @author      Brian Kelly <brian.kelly@youseeu.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

require_once(dirname(__FILE__) . '/../../../config.php');
global $CFG, $DB;
require_once($CFG->libdir . '/adminlib.php');

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}
require_login();
$context = context_system::instance();
$PAGE->set_context($context);

$PAGE->set_url('/tool/bongo/view.php');
$PAGE->set_title('Bongo');
$PAGE->set_heading('Bongo');

// Moodle 2.2 and greater is required to use this.
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');

$config = get_config('tool_bongo');
$form = new \tool_bongo\forms\bongoinformationform();

if (isset($_GET['moduleid'])) {
    $moduleid = $_GET['moduleid'];
    $addedtoform['bongo_module_id'] = $moduleid;
    $form->set_data($addedtoform);
}

if ($form->is_cancelled()) {
    redirect(new moodle_url('/admin/search.php'));
} else if ($data = $form->get_data()) {
    redirect(new moodle_url('/mod/lti/view.php?id=' . $data->bongo_module_id));
}

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('plugininformationpage', 'tool_bongo'));
$form->display();
echo $OUTPUT->footer();