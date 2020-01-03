#!/bin/bash
#Pour redemarrer les services  recoit start ou stop ou restart ou plus les parametres services
# service.sh [start,stop, restart ] [-a, --all,, ]
# SYNOPSIS service.sh COMMAND [OPTIONS]  [NAME]
#
#OPTIONS 
#	-a --all Tous les services 
#	
#COMMAND
#	start demarrer le service
# 	stop arreter le service
#	restart redemarrer le service
#
#Dans le cas ou on n'a pas envoyé de paramètre on redemarre tous les service 
if [ $# = 0 ]
then
	systemctl status apache2 | grep 'active (running)' > /dev/null 2>&1
	if [ $? = 0 ]
	then
		systemctl restart apache2 > /dev/null
	fi
	systemctl status nginx | grep 'active (running)' > /dev/null 2>&1
	if [ $? = 0 ]
	then
		systemctl restart nginx > /dev/null
	fi
	systemctl status postfix | grep 'active (running)' > /dev/null 2>&1
	if [ $? = 0 ]
	then
		systemctl restart postfix > /dev/null
	fi
	systemctl status dovecot | grep 'active (running)' > /dev/null 2>&1
	if [ $? = 0 ]
	then
		systemctl restart apache2 > /dev/null
	fi
	systemctl restart nginx	 | grep 'active (running)' > /dev/null 2>&1
	systemctl restart postfix | grep 'active (running)' > /dev/null 2>&1
	systemctl restart dovecot | grep 'active (running)' > /dev/null 2>&1
	systemctl restart mysql | grep 'active (running)' > /dev/null 2>&1

elif  [ $1 = "start" ]
then
		systemctl restart postfix



elif [ $1 = "stop" ]
then
		systemctl restart dovecot
	fi
fi

