# Bongo Plugin Description
Bongo is a Video Assessment platform built around synchronous and asynchronous learning
to facilitate soft skills development at scale.
The Bongo Moodle plugin enables access to YouSeeU Bongo Learn (c). The plugin creates a free Bongo trial subscription. A paid Bongo subscription is required for ongoing use.

## What the plugin does
It gathers relevant information related to the specific Moodle installation and 
sends that to the Bongo REST API. The Bongo REST API will respond with the necessary connection information allowing 
the Moodle to make regular LTI requests against Bongo.

## Supported Moodle versions
Moodle version 2.7 and higher are supported.

## Code repository name
The code repository name is moodle-mod_bongo.

## Source control URL
See https://github.com/YouSeeU/moodle-mod_bongo

## Bug tracker
See https://github.com/YouSeeU/moodle-mod_bongo/issues

## Learn more about the Bongo solution
Please visit https://www.bongolearn.com

## Licensing
Licensed under GNU GPL v3 and higher.

## Subscriptions required
Initial installation of the Bongo plugin provisions a free trial of Bongo. The trial can be extended based on need. For ongoing usage of Bongo in Moodle, a paid subscription of Bongo is required.

## How to build

## Dependencies
Must be using Moodle 2.7 or higher
Must have mod_lti

## Cross database compatibilty
Verfied to work with MySQL, PostgreSQL, MS SQL and Oracle.

### Linux
There is a shell script at the top level of the repo (./package_plugin.sh) that will create a zip of the plugin.  This
will only work on linux.

### Windows
Right click on the .\bongo\ directory and zip the folder. You will want to make sure that the .\bongo\ directory is
included at the top level of the zipped file.

## How to install on Moodle
* Log into Moodle as an administrator
* Navigate to Site Administration
* Open the Plugins tab
* Click on Install Plugin
* Upload the new zip file
* Click install from zip file
* If no errors, click continue
* If no unmet dependencies, click 'Upgrade Moodle database now'
* If no errors, 'Success' is shown, click 'Continue'
* Configure Bongo on Moodle
    * Navigate to '/admin/tool/bongo/index.php' on the moodle server (ex: http://localhost/admin/tool/bongo/index.php)
    * Add Moodle School Name
    * Add Bongo Premium Key
    * Select Bongo Region
    * Click Save
    * Click Save
* You're in Bongo!

## What the Bongo Plugin does
* Take configuration from user
* Contact the Bongo REST API
* Save the configuration in the Bongo Plugin's Moodle table
* Create a LTI Type (Consumer) on the Moodle server
* Create a Course and activity on the Moodle server and attach the activity to the LTI Type
* Describe to the user what the plugin just created
* Launch into Bongo
* After installation, the user and any administrators to create activities in courses that will use the Bongo
application from the 'Add Activity/Resource' in any course

## Potential issues
* Write access needs to be allowed on <Moodle root>/admin/tool
* Access to the internet so the plugin can call the Bongo REST API
