#!/bin/bash 
# SPF Checker
LISTS=$1

if [[ ! -f ${LISTS} ]]; then
	echo "usage: bash $0 list.txt"
	exit
fi

for SITE in $(cat $LISTS);
do
    if [[ $(curl --connect-timeout 3 -kls --max-time 3 -d "serial=fred12&domain=${SITE}" -H "Content-Type: application/x-www-form-urlencoded" -X POST "https://www.kitterman.com/spf/getspf3.py") =~ 'SPF record passed validation test with pySPF' ]]; then
		echo -e "\e[31m[+] VULN: ${SITE}"
	else
		echo -e "\e[32m[-] NOT VULN: ${SITE}"
	fi
    
done
