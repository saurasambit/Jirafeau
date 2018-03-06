#!/bin/bash
set -e
new=$1
if [ -z "$new" ]; then
    echo "please pass the new string id to add as parameter"
    exit 1
fi
locales_dir=$(cd "$(dirname $0)" && pwd)
new_line="    \"$new\": \"\","
find $locales_dir -type f -name "*.json" -print0 | xargs -0 sed -i "s/{/{\n${new_line}/"
