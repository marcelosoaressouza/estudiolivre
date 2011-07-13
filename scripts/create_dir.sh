#!/bin/bash

DIRS="repo backups db dump files img/wiki img/wiki_up img/trackers modules/cache temp temp/cache templates_c templates styles maps whelp mods"

for DIR in $DIRS; do
  mkdir -p $DIR 2> /dev/null
  chmod 0755 $DIR -R
done
