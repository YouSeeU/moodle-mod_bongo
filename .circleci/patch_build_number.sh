#!/bin/bash
set -ex

sudo apt install -y jq moreutils
VERSION=`jq -r '.version' package.json`
BRANCH_TYPE=`echo "${CIRCLE_BRANCH}" | cut -d / -f 1`
BRANCH_CONTEXT=`echo "${CIRCLE_BRANCH}" | cut -d / -f 2`
[ "${BRANCH_TYPE}" == "hotfix" ] && BRANCH_CONTEXT="hf-${BRANCH_CONTEXT}"
SHORT_SHA=`git rev-parse --short HEAD`
PATCHED_VERSION="${VERSION}-${BRANCH_CONTEXT}+build.${CIRCLE_BUILD_NUM}.sha.${SHORT_SHA}"
jq ".version = \"${PATCHED_VERSION}\"" package.json | sponge package.json
