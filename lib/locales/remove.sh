#!/bin/bash
set -e
id=$1
if [ -z "$id" ]; then
    echo "please pass the string id to remove as parameter"
    exit 1
fi
locales_dir=$(cd "$(dirname $0)" && pwd)
find $locales_dir -type f -name "*.json" -print0 | xargs -0 sed -i "/$id/d"
