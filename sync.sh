#!/bin/bash
srcpath=`dirname $0`
aws s3 sync $srcpath s3://jasonwright.info --delete --exclude .git --exclude node_modules
