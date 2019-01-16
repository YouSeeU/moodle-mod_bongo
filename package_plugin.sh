#!/usr/bin/env bash

MOODLE_NAME=$1
MODULE_VERSION=$2

echo "Moodle Name: $MOODLE_NAME"
echo "Module Version: $MODULE_VERSION"

if [ -z "$MOODLE_NAME" ]
then
      echo "\$MOODLE_NAME is empty, defaulting to 'bongo'"
      MOODLE_NAME="bongo"
fi

if [ -z "$MODULE_VERSION" ]
then
      echo "\$MODULE_VERSION is empty, defaulting to 'version'"
      MODULE_VERSION="version"
fi

echo 'File name: '
echo $MOODLE_NAME-$MODULE_VERSION.zip

# Clean out any zip files created during the previous run.
rm -f bongo.zip
rm -f $MOODLE_NAME-$MODULE_VERSION.zip
# Remove zipped folder in case it was not deleted by the last run.
rm -rf ./bongo

# Create zip-able folder and move all contents of repo into it for zipping.
mkdir bongo
cp -r ./* bongo/

# Remove copy of zip-able folder in the new folder to avoid Moodle getting confused.
rmdir ./bongo/bongo

#Zip all folder contents of folder excluding the git, idea and circleci build folders.
zip -r $MOODLE_NAME-$MODULE_VERSION.zip ./bongo -x *.git* *.idea* *.circleci* *.zip *.travis* *bongo *.sh

# Remove zip-able folder to clean up repo and build machine
rm -rf ./bongo/
