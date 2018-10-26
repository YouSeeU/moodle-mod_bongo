#!/bin/bash
set -ex

./package_plugin.sh
MOODLE_MODULE=`jq '.name' -r package.json`
MODULE_VERSION=`jq '.version' -r package.json | cut -d + -f 1`
