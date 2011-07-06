# $Header: /cvsroot/tikiwiki/tiki/setup.sh,v 1.28.2.21 2008/02/22 05:32:01 marclaporte Exp $

# Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
# All Rights Reserved. See copyright.txt for details and a complete list of authors.
# Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

# List of directories affected by this script:
DIRS="backups db dump files img/wiki img/wiki_up img/trackers modules/cache temp temp/cache templates_c templates styles maps whelp mods"

if [ -d 'lib/Galaxia' ]; then
	DIRS=$DIRS" lib/Galaxia/processes"
fi


AUSER=nobody
AGROUP=nobody
RIGHTS=02775
VIRTUALS=""

UNAME=`uname | cut -c 1-6`

if [ -f /etc/debian_version ]; then
	AUSER=www-data
	AGROUP=www-data
fi

if [ -f /etc/redhat-release ]; then
	AUSER=apache
	AGROUP=apache
fi

if [ -f /etc/gentoo-release ]; then
	AUSER=apache
	AGROUP=apache
fi

if [ -f /etc/SuSE-release ]; then
        AUSER=wwwrun
        AGROUP=www
fi

if [ "$UNAME" = "CYGWIN" ]; then
	AUSER=SYSTEM
	AGROUP=SYSTEM
fi

if [ -z "$1" ]; then
	cat <<EOF
This script assigns necessary permissions for the directories that the
webserver writes files to. It also creates the (initially empty) cache 
directories, if necessary.

Usage sh $0 user [group] [rights] [list of virtual host domains]

For example, if apache is running as user $AUSER and group $AGROUP (can be found in phpinfo),
 and if you are running as user $USER, type:

  su -c 'sh $0 $USER $AGROUP'
 
This will allow you to delete certain files/directories without becoming root.
  
Or, if you can't become root, but are a member of the group apache runs under
(for example: $AGROUP), you can type:

  sh $0 $USER $AGROUP

Be aware, that you probably have to do a 

  chown -R $USER *

if your tiki runs in a PHP-safe-mode environment.

If you can't become root, and are not a member of the apache group, but if
your system uses ACL's (check with "mount | grep acl"), then type:

  sh $0 -acl $USER $AGROUP

If you can't become root, and are not a member of the apache group, and
your system does not support ACL's then type:

  sh $0 $USER yourgroup 02777

Replace yourgroup with your default group. Tip: You can find your group using the command 'id'.

If you are on a shared hosting account, you can't become root, and your 
group is probably the same as your user name. The following should work for you:

  sh $0 $USER $USER 02777


NOTE: If you do execute one of the three last commands, you will not be able 
to delete certain files created by apache, and will need to ask your system
administrator to delete them for you if needed. However, you may still be able to 
rename (move) them. 


---MultiTiki---
More information here:
http://doc.tikiwiki.org/MultiTiki

To use Tiki's multi-site capability (virtual hosts from a single DocumentRoot)
add a list of domains to the command to create all the needed directories.
For example:

  su -c 'sh $0 $USER $AGROUP $RIGHTS domain1 domain2 domain3'

or, if you can't become root:

  sh $0 $USER $AGROUP 02777 domain1 domain2 domain3


---Mods----
More information here:
http://mods.tikiwiki.org/

special for mods installer

  sh $0 $AUSER all

will change perms on all tiki files so you can use the tikimods power.
Remember to run the perms setup again when mods installer use if done.
  
	sh $0 $USER $AGROUP 

EOF
	exit 1
fi

if [ "$1" = "-acl" ]; then
	ACL=1
	shift
else
	ACL=0
fi

if [ -n "$1" ]; then
	AUSER=$1
	shift
fi
if [ -n "$1" ]; then
	if [ $1 = "all" ]; then
		chown -R $AUSER *
		exit 0
	fi
	AGROUP=$1
	shift
fi
if [ -n "$1" ]; then
	RIGHTS=$1
	shift
fi

if [ -n "$1" ]; then
	VIRTUALS=$@
	touch db/virtuals.inc
fi

# Create directories as needed
for dir in $DIRS; do
	if [ ! -d $dir ]; then
		echo Creating directory "$dir"
		mkdir -p $dir
	fi
	for vdir in $VIRTUALS; do
		if [ ! -d "$dir/$vdir" ]; then
			echo Creating directory "$dir/$vdir"
			mkdir -p "$dir/$vdir"
		fi
		echo $vdir >> db/virtuals.inc
		cat db/virtuals.inc | sort | uniq > db/virtuals.inc_new
		rm -f db/virtuals.inc && mv db/virtuals.inc_new db/virtuals.inc
	done
done

# Set ownerships of the directories
chown -R $AUSER *

if [ -n "$AGROUP" ]; then
	if [ $ACL = 1 ] ; then
		setfacl -R -m g:${AGROUP}:rwx $DIRS
		setfacl -m g:${AGROUP}:rwx robots.txt
	else
		chgrp -R $AGROUP $DIRS
        	chgrp $AGROUP robots.txt
	fi
fi

if [ $ACL = 0 ] ; then
	chmod -R $RIGHTS $DIRS
	chmod $RIGHTS robots.txt
	chmod $RIGHTS tiki-install.php
fi

chown $AUSER robots.txt

# by setting the rights to tiki-install.php tiki-installer can be used in most cases to disable the file.
chown $AUSER tiki-install.php

exit 0

