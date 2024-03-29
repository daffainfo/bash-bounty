#!/bin/bash

# _darcs Mass Scanner
LISTS=$1

if [[ ! -f ${LISTS} ]]; then
	echo "ERROR: ${LISTS} not found"
	echo "usage: bash $0 list.txt"
	exit
fi

for SITE in $(cat $LISTS);
do
    if [[ $(curl --connect-timeout 3 --max-time 3 -kLs "${SITE}/_darcs/prefs/binaries" ) =~ 'Binary file regexps' ]]; then
		echo -e "\e[32m[+] FOUND: ${SITE}_darcs
	else
		echo -e "\e[31m[-] NOT FOUND: ${SITE}"
	fi
    
done
