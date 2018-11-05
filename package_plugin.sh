#!/usr/bin/env bash

MOODLE_MODULE=$1
MODULE_VERSION=$2

#Zip all folder contents including top level plugin name directory
rm bongo.zip
rm $MOODLE_MODULE-$MODULE_VERSION.zip
zip -r $MOODLE_MODULE-$MODULE_VERSION.zip bongo/
