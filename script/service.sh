#!/bin/bash
#Pour redemarrer les services  recoit start ou stop ou restart ou plus les parametres services
# service.sh [start,stop, restart ] [-a, --all,, ]
# SYNOPSIS service.sh COMMAND [OPTIONS]  [NAME]
#
#OPTIONS 
#	
#	
#COMMAND
#	all
#	start demarrer le service
# 	stop arreter le service
#	restart redemarrer le service
#
#Dans le cas ou on n'a pas envoyé de paramètre on redemarre tous les service 

declare -A service
service[apache2]=apache2
service[nginx]=nginx
service[postfix]=postfix
service[dovecot]=dovecot
service[phpfpm]=php7.2-fpm

if  [ $# = 0 ] || [ [ $1 = 'restart' ] && [ $2 = 'all' ] ] 
then
	# On verifie l'etat du service ensuite on redemarre
	systemctl status apache2 | grep 'active (running)' > /dev/null 2>&1
	if [ $? = 0 ]
	then
		systemctl restart apache2 > /dev/null
	fi
	#Cas de nginx
	systemctl status nginx | grep 'active (running)' > /dev/null 2>&1
	if [ $? = 0 ]
	then
		systemctl restart nginx > /dev/null
	fi
	#Cas de php7.2-fpm
	systemctl status php7.2-fpm | grep 'active (running)' > /dev/null 2>&1
	if [ $? = 0 ]
	then
		systemctl restart php7.2-fpm  > /dev/null
	fi
	#Cas de postfix
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
	#systemctl restart nginx	 | grep 'active (running)' > /dev/null 2>&1
	#systemctl restart postfix | grep 'active (running)' > /dev/null 2>&1
	#systemctl restart dovecot | grep 'active (running)' > /dev/null 2>&1
	#systemctl restart mysql | grep 'active (running)' > /dev/null 2>&1

elif  [ $1 = "restart" ]
then
	for key in "${!service[@]}"; do
		if [[ key = $2 ]]; then
			systemctl status $2 | grep 'active (running)' > /dev/null 2>&1
			if [ $? = 0 ]; then
				systemctl restart $2 > /dev/null
			fi			
		fi
	done
elif  [ $1 = "stop" ]
then
	for key in "${!service[@]}"); do
		if [ key = $2 ] && [ $2 != "nginx" ] && [ $2 != "apache2" ] ; then
			systemctl status $2 | grep 'active (running)' > /dev/null 2>&1
			if [ $? = 0 ]; then
				systemctl stop $2 > /dev/null
			fi			
		fi
	done
fi