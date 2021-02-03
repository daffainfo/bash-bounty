#!/bin/bash
# .bzr Mass Scanner
LISTS=$1

if [[ ! -f ${LISTS} ]]; then
	echo "ERROR: ${LISTS} not found"
	echo "usage: bash $0 list.txt"
	exit
fi

for SITE in $(cat $LISTS);
do
    if [[ $(curl --connect-timeout 3 --max-time 3 -kLs "${SITE}/.bzr/README" ) =~ 'This is a Bazaar control directory.' ]]; then
		echo -e "\e[32m[+] FOUND: ${SITE}.bzr
	else
		echo -e "\e[31m[-] NOT FOUND: ${SITE}"
	fi
    
done
