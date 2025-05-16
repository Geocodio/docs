#!/bin/bash
set -e

echo "Compiling changes..."

# The fields template generates code examples for field lookups for all languages
# Example: <!--FIELD:cd,stateleg-->
php fields_template.php > source.html.md.tmp
if [ $? -ne 0 ]; then
    echo "ERROR: Failed to expand field templates"
    exit 1
fi

# Compile Versions
php compile_versions.php
if [ $? -ne 0 ]; then
    echo "ERROR: Failed to compile versions"
    exit 1
fi

echo "Done!"