#!/bin/bash

echo "Compiling changes..."

# Expand templates

# The fields template generates code examples for field lookups for all languages
# Example: <!--FIELD:cd,stateleg-->
php fields_template.php >source.html.md.tmp

# Compile Versions
php compile_versions.php
