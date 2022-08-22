#!/bin/bash

# Run from shell, from the root directory of the plugin
# $ sh create-dist.sh

# The root .distignore creates an archive w/o composer installed
# Then we expand the archive and install composer w/o dev deps
# Then we trash the old archive, and create a new one.
# And finally, we re-expand the archive so that this folder can be symlinked
# for use locally as a pseudo submodule.

plugin_name=${PWD##*/}
plugin_archive=$plugin_name".zip"

if [ -d "./dist" ]; then rm -Rf ./dist; fi &&
mkdir ./dist &&
wp dist-archive ./ ./dist &&
cd ./dist &&
unzip $plugin_archive -d ./ &&
cd $plugin_name &&
composer install --no-dev &&
touch .distignore &&
echo "readme.md" >> .distignore &&
echo "composer.json" >> .distignore &&
echo "composer.lock" >> .distignore &&
echo ".distignore" >> .distignore &&
cd ../ &&
rm $plugin_archive &&
cd $plugin_name &&
wp dist-archive ./ ../ &&
cd ../ &&
trash $plugin_name &&
unzip $plugin_archive -d ./