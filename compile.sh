#!/bin/bash

# Initial files
sed 's/api.geocod.io/api-hipaa.geocod.io/g' source.html.md > source/hipaa/index.html.md
cp source.html.md source/index.html.md

# HIPAA
sed -i 's#<!--HIPAA##g' source/hipaa/index.html.md
sed -i 's#HIPAA-->##g' source/hipaa/index.html.md

# Non-HIPAA
sed -i 's#<!--DEFAULT##g' source/index.html.md
sed -i 's#DEFAULT-->##g' source/index.html.md
