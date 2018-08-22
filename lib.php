<?php

/**
 *
 * The interface between the Moodle core and the plugin is defined here for the most plugin types. The expected contents of the file depends on the particular plugin type.

Moodle core often (but not always) loads all the lib.php files of the given plugin types. For the performance reasons, it is strongly recommended to keep this file as small as possible and have just required code implemented in it. All the plugin's internal logic should be implemented in the auto-loaded classes or in the locallib.php file.

Coding style#Functions and Methods
 *
 */

