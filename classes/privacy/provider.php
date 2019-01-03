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
 * @copyright   YouSeeU
 * @package     local_bongo
 * @author      Brian Kelly <brian.kelly@youseeu.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */
namespace local_bongo\privacy;

use core_privacy\local\metadata\collection;

class provider implements \core_privacy\local\metadata\provider, \core_privacy\local\request\data_provider {
    public static function get_metadata(collection $collection) : collection {
        // No user data is stored on the Moodle server.
        // Any user data used by Bongo is stored remotely on the Bongo servers, which have a different check.

        $collection->add_external_location_link('lti_client', [
            'email' => 'privacy:metadata:email',
        ], 'privacy:metadata:lti_client');

        return $collection;
    }
}
