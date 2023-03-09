#!/bin/bash

echo "Compiling changes..."

# Expand templates

# The fields template generates code examples for field lookups for all languages
# Example: <!--FIELD:cd,stateleg-->
php fields_template.php > source.html.md.tmp

# Initial files
sed 's/api.geocod.io/api.enterprise.geocod.io/g' source.html.md.tmp > source/enterprise/index.html.md
sed -i 's/dash.geocod.io/dash.enterprise.geocod.io/g' source/enterprise/index.html.md
cp source.html.md.tmp source/index.html.md
rm source.html.md.tmp

# Enterprise
sed -i 's#<!--ENTERPRISE##g' source/enterprise/index.html.md
sed -i 's#ENTERPRISE-->##g' source/enterprise/index.html.md

# Non-enterprise
sed -i 's#<!--DEFAULT##g' source/index.html.md
sed -i 's#DEFAULT-->##g' source/index.html.md
