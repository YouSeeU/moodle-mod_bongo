#!/usr/bin/env bash

MOODLE_MODULE=$1
MODULE_VERSION=$2

echo 'File name: '
echo $MOODLE_MODULE-$MODULE_VERSION.zip

#Zip all folder contents including top level plugin name directory
rm -f bongo.zip
rm -f $MOODLE_MODULE-$MODULE_VERSION.zip
zip -r $MOODLE_MODULE-$MODULE_VERSION.zip bongo/
