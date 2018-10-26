#!/bin/bash
set -e

TO=$2
FROM=$1
MOODLE_MODULE=`jq '.name' -r package.json`
curl -fL https://getcli.jfrog.io | sh
./jfrog rt c --url ${ARTIFACTORY_URL} --user ${ARTIFACTORY_USERNAME} --password ${ARTIFACTORY_PASSWORD} --interactive false
FROM_REPO=`echo "${ARTIFACTORY_REPO}" | sed s/$TO/$FROM/`
./jfrog rt cp "${FROM_REPO}/${ARTIFACTORY_ORG}/${NODE_MODULE}/*.zip" "${ARTIFACTORY_REPO}/${ARTIFACTORY_ORG}/${MOODLE_MODULE}/"
