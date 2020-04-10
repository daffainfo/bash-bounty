#!/bin/bash 
# DMARC Checker
LISTS=$1

if [[ ! -f ${LISTS} ]]; then
	echo "usage: bash $0 list.txt"
	exit
fi

for SITE in $(cat $LISTS);
do
    if [[ $(curl --connect-timeout 3 -kls --max-time 3 -d "action=dm_integration_inspect_dmarc&domain=${SITE}&security=83b182c4ce" -X POST "https://dmarcian.com/wp-admin/admin-ajax.php") =~ 'No DMARC record published.' ]]; then
		echo -e "\e[32m[+] VULN: ${SITE}"
	else
		echo -e "\e[31m[-] NOT VULN: ${SITE}"
	fi
    
done
