#!/bin/bash
#Pour redemarrer les services  recoit start ou stop ou restart ou plus les parametres services
#Ici nous considerons que start est égal à restart
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
service[apache2]="apache2"
service[nginx]="nginx"
service[postfix]="postfix"
service[dovecot]="dovecot"
service[phpfpm]="php7.2-fpm"

serviceValeur="none" # utile pour  la fonction 
function verifierService ()
{
}

if [ $# = 0 ] || [ [ $1 = 'restart' ] && [ $2 = 'all' ] ] 
then
	# On verifie l'etat du service ensuite on redemarre	
retour=1
	systemctl status apache2 | grep 'active (running)' > /dev/null 2>&1
	if [ $? = 0 ]
	then
		systemctl restart apache2 > /dev/null 2>&1
		if [ $? = 0 ]
		then 
			$retour=0
		else
			$retour=1
		fi
	else
		#On fait des verification plus poussées pour etre sur que la commande n'est pas active afin de pouvoir redemarrer
		systemctl is-active apache2 > /dev/null 2>&1
		#Si on est sur que le service est actif alors on le redemarre (restart) sinon on le demarre (start)
		if [ $? = 0 ]
		then
			systemctl restart apache2 > /dev/null 2>&1
			if [ $? = 0 ]
			then 
				$retour=0
			else
				$retour=1
			fi
			
		else
			systemctl start apache2 > /dev/null 2>&1
			if [ $? = 0 ]
			then 
				$retour=0
			else
				$retour=1
			fi
		fi
	
	fi
	#Cas de nginx
	systemctl status nginx | grep 'active (running)' > /dev/null 2>&1
	if [ $? = 0 ]
	then
		systemctl restart nginx > /dev/null 2>&1
		if [ $? = 0 ]
		then 
			$retour=0
		else
			$retour=1
		fi
	else
		#On fait des verification plus poussées pour etre sur que la commande n'est pas active afin de pouvoir redemarrer
		systemctl is-active nginx > /dev/null 2>&1
		#Si on est sur que le service est actif alors on le redemarre (restart) sinon on le demarre (start)
		if [ $? = 0 ]
		then
			systemctl restart nginx > /dev/null 2>&1
			if [ $? = 0 ]
			then 
				$retour=0
			else
				$retour=1
			fi
			
		else
			#Dans ce cas le service est eteint donc on le demarre simplement
			systemctl start nginx > /dev/null 2>&1
			if [ $? = 0 ]
			then 
				$retour=0
			else
				$retour=1
			fi
		fi
	fi
	#Cas de php7.2-fpm
	systemctl status php7.2-fpm | grep 'active (running)' > /dev/null 2>&1
	if [ $? = 0 ]
	then
		systemctl restart php7.2-fpm  > /dev/null 2>&1
		if [ $? = 0 ]
		then 
			$retour=0
		else
			$retour=1
		fi
	else
		#On fait des verification plus poussées pour etre sur que la commande n'est pas active afin de pouvoir redemarrer
		systemctl is-active php7.2-fpm > /dev/null 2>&1
		#Si on est sur que le service est actif alors on le redemarre (restart) sinon on le demarre (start)
		if [ $? = 0 ]
		then
			systemctl restart php7.2-fpm > /dev/null 2>&1
			if [ $? = 0 ]
			then 
				$retour=0
			else
				$retour=1
			fi
		else
			systemctl start php7.2-fpm > /dev/null 2>&1
			if [ $? = 0 ]
			then 
				$retour=0
			else
				$retour=1
			fi
		fi
		
	fi
	#Cas de postfix
	systemctl status postfix | grep 'active (running)' > /dev/null 2>&1
	if [ $? = 0 ]
	then
		systemctl restart postfix > /dev/null 2>&1
		if [ $? = 0 ]
		then 
			$retour=0
		else
			$retour=1
		fi
	else
		#On fait des verification plus poussées pour etre sur que la commande n'est pas active afin de pouvoir redemarrer
		systemctl is-active papache2 > /dev/null 2>&1
		#Si on est sur que le service est actif alors on le redemarre (restart) sinon on le demarre (start)
		if [ $? = 0 ]
		then
			systemctl restart apache2 > /dev/null 2>&1
			if [ $? = 0 ]
			then 
				$retour=0
			else
				$retour=1
			fi
			
		else
			systemctl start apache2 > /dev/null 2>&1
			if [ $? = 0 ]
			then 
				$retour=0
			else
				$retour=1
			fi
		fi
	fi
	systemctl status dovecot | grep 'active (running)' > /dev/null 2>&1
	if [ $? = 0 ]
	then
		systemctl restart dovecot > /dev/null
		if [ $? = 0 ]
		then 
			$retour=0
		else
			$retour=1
		fi
	else
		#On fait des verification plus poussées pour etre sur que la commande n'est pas active afin de pouvoir redemarrer
		systemctl is-active papache2 > /dev/null 2>&1
		#Si on est sur que le service est actif alors on le redemarre (restart) sinon on le demarre (start)
		if [ $? = 0 ]
		then
			systemctl restart apache2 > /dev/null 2>&1
			if [ $? = 0 ]
			then 
				$retour=0
			else
				$retour=1
			fi
			
		else
			systemctl start apache2 > /dev/null 2>&1
			if [ $? = 0 ]
			then 
				$retour=0
			else
				$retour=1
			fi
		fi
	fi
	exit  $retour

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
		# Nous ne pouvons pas arreter le service web ni le service php sinon on ne peut plus y acceder via l'interface web
		if [ key = $2 ] && [ $2 != "nginx" ] && [ $2 != "apache2" ] && [ $2 != "phpfpm" ]; then
			systemctl status $2 | grep 'active (running)' > /dev/null 2>&1
			if [ $? = 0 ]; then
				systemctl stop $2 > /dev/null
			fi			
		fi
	done
fi