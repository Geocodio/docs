#!/bin/bash

if ! command -v fswatch &> /dev/null; then
    echo "Error: fswatch is not installed."
    echo "Please install it using one of the following methods:"
    echo "  - For macOS (Homebrew): brew install fswatch"
    echo "  - For Debian/Ubuntu: sudo apt-get install fswatch"
    echo "  - For other systems, see: https://github.com/emcrisostomo/fswatch"
    exit 1
fi

./compile.sh

echo "Watching for changes to source.html.md"
fswatch -0 source.html.md | xargs -0 -n1 ./compile.sh