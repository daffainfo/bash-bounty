#!/bin/bash
# .svn Checker
LISTS=$1

if [[ ! -f ${LISTS} ]]; then
	echo "ERROR: ${LISTS} not found"
	echo "usage: bash $0 list.txt"
	exit
fi

for SITE in $(cat $LISTS);
do
    if [[ $(curl --connect-timeout 3 --max-time 3 -kLs "${SITE}/.svn/entries" ) =~ 'svn://' ]]; then
		echo -e "\e[32m[+] FOUND: ${SITE}.svn/entries"
	else
		echo -e "\e[31m[-] NOT FOUND: ${SITE}"
	fi
    
done

		
