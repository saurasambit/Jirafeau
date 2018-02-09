#!/bin/bash
original_id=$1
new_id=$2
if [ -z "$original_id" ] || [ -z "$new_id" ] ; then
    echo "arguments: [OLD_ID] [NEW_ID]"
    exit 1
fi
locales_dir=$(cd "$(dirname $0)" && pwd)
o="\"$original_id\":"
i="\"$new_id\":"
find . -type f -name "*.json" -print0 | xargs -0 sed -i "s/$o/$i/g"

