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
 * Describes what private information is stored by the Bongo plugin.
 *
 * File         provider.php
 * Encoding     UTF-8
 *
 * @copyright   Bongo
 * @package     local_bongo
 * @author      Brian Kelly <brian.kelly@bongolearn.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */
namespace local_bongo\privacy;

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}

use core_privacy\local\metadata\collection;

/**
 * Describes what private information is stored by the Bongo plugin.
 *
 * @copyright   Bongo
 * @author      Brian Kelly <brian.kelly@bongolearn.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */
class provider implements \core_privacy\local\metadata\provider, \core_privacy\local\request\data_provider {

    /**
     * No user data is stored on the Moodle server.
     * Any user data used by Bongo is stored remotely on the Bongo servers.
     *
     * @param collection $collection
     * @return collection
     */
    public static function get_metadata(collection $collection) : collection {
        $collection->add_external_location_link('bongolearn.com', [
            'userid' => 'privacy:metadata:userid',
            'fullname' => 'privacy:metadata:fullname',
            'email' => 'privacy:metadata:email'
        ], 'privacy:metadata');

        return $collection;
    }
}
