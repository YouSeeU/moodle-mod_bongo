#!/bin/bash
set -e

MOODLE_MODULE=`jq '.name' -r package.json`
curl -fL https://getcli.jfrog.io | sh
./jfrog rt c --url ${ARTIFACTORY_URL} --user ${ARTIFACTORY_USERNAME} --password ${ARTIFACTORY_PASSWORD} --interactive false
./jfrog rt bce ${CIRCLE_PROJECT_REPONAME} ${CIRCLE_BUILD_NUM}
./jfrog rt bag ${CIRCLE_PROJECT_REPONAME} ${CIRCLE_BUILD_NUM}
./jfrog rt u --build-name=${CIRCLE_PROJECT_REPONAME} --build-number=${CIRCLE_BUILD_NUM} --flat=true --recursive=false \*.zip ${ARTIFACTORY_REPO}/${ARTIFACTORY_ORG}/${MOODLE_MODULE}/
./jfrog rt bp  ${CIRCLE_PROJECT_REPONAME} ${CIRCLE_BUILD_NUM}
