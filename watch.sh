#!/bin/bash

fswatch -0 source.html.md | xargs -0 -n1 ./compile.sh