#!/bin/bash

echo "Compiling changes..."

# Expand templates

# The fields template generates code examples for field lookups for all languages
# Example: <!--FIELD:cd,stateleg-->
php fields_template.php > source.html.md.tmp

# Initial files
sed 's/api.geocod.io/api-hipaa.geocod.io/g' source.html.md.tmp > source/hipaa/index.html.md
sed -i 's/dash.geocod.io/dash-hipaa.geocod.io/g' source/hipaa/index.html.md
cp source.html.md.tmp source/index.html.md
rm source.html.md.tmp

# HIPAA
sed -i 's#<!--HIPAA##g' source/hipaa/index.html.md
sed -i 's#HIPAA-->##g' source/hipaa/index.html.md

# Non-HIPAA
sed -i 's#<!--DEFAULT##g' source/index.html.md
sed -i 's#DEFAULT-->##g' source/index.html.md
