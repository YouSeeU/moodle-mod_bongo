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
 * The bongo_configured event.
 *
 * @package    local_bongo
 * @copyright  2014 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_bongo\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The bongo_configured event.
 *
 * @copyright  2018 onwards Brian Kelly <brian.kelly@bongolearn.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class bongo_configured extends \core\event\base {

    /**
     * Registers the event with the system so it can be used by other plugins and event handlers.
     */
    protected function init() {
        $this->data['crud'] = 'c';
        $this->data['edulevel'] = self::LEVEL_OTHER;
        $this->data['objecttable'] = 'bongo';
    }

    /**
     * Return the localized name of the event.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('bongoconfiguredevent', 'local_bongo');
    }

    /**
     * Return the localized description of the event.
     *
     * @return string
     */
    public function get_description() {
        return get_string('bongoconfiguredeventdescription', 'local_bongo');
    }

    /**
     * Return the page within Moodle that triggered the event.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/local/bongo/index.php');
    }
}
