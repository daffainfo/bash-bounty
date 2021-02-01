#!/bin/bash
# Find Laravel Configuration File Mass Scanner 
LISTS=$1

if [[ ! -f ${LISTS} ]]; then
	echo "ERROR: ${LISTS} not found"
	echo "usage: bash $0 list.txt"
	exit
fi

for SITE in $(cat $LISTS);
do
    if [[ $(curl --connect-timeout 3 --max-time 3 -kLs "${SITE}/.env" ) =~ 'DB_DATABASE' ]]; then
		echo -e "\e[32m[+] FOUND: ${SITE}/.env"
	else
		echo -e "\e[31m[-] NOT FOUND: ${SITE}"
	fi
done
