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
      MODULE_VERSION="bongo"
fi

echo 'File name: '
echo $MOODLE_NAME-$MODULE_VERSION.zip

#Zip all folder contents including top level plugin name directory
rm -f bongo.zip
rm -f $MOODLE_NAME-$MODULE_VERSION.zip
zip -r $MOODLE_NAME-$MODULE_VERSION.zip bongo/
