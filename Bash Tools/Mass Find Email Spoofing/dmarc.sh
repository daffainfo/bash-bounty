#!/bin/bash 
# DMARC Checker
LISTS=$1

if [[ ! -f ${LISTS} ]]; then
	echo "usage: bash $0 list.txt"
	exit
fi

for SITE in $(cat $LISTS);
do
    if [[ $(curl --connect-timeout 3 -kls --max-time 3 -X GET "https://dmarcly.com/server/dmarc_check.php?domain=${SITE}") =~ 'success' ]]; then
		echo -e "\e[32m[+] VULN: ${SITE}"
	else
		echo -e "\e[31m[-] NOT VULN: ${SITE}"
	fi
    
done
