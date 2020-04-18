declare -A service
service[apache2]="apache2"
service[nginx]="nginx"
service[postfix]="postfix"
service[dovecot]="dovecot"
service[phpfpm]="php7.2-fpm"
#Pour corriger un bug en attendant j'ai changé $1 par $2
if [ -n $2 ] 
then
	if [[ $2 = "apache2" ]]; then
		systemctl status $2 | grep 'active (running)' > /dev/null 2>&1
		if [ $? = 0 ]; then
			exit 0
		else 
			#On fait des verification plus poussées pour etre sur que la commande n'est pas active afin de pouvoir retourner 1 dans le cas ou elle n'est pas active
			systemctl is-active $2 > /dev/null 2>&1
			if [ $? = 0 ]
			then
				exit 0
			else
				exit 1
			fi
		fi
	elif [[ $2 = "nginx" ]]; then
		systemctl status $2 | grep 'active (running)' > /dev/null 2>&1
		if [ $? = 0 ]; then
			exit 0
		else 
			#On fait des verification plus poussées pour etre sur que la commande n'est pas active afin de pouvoir retourner 1 dans le cas ou elle n'est pas active
			systemctl is-active $2 > /dev/null 2>&1
			if [ $? = 0 ]
			then
				exit 0
			else
				exit 1
			fi
		fi
	elif [[ $2 = "php7.2-fpm" ]]; then
		systemctl status $2 | grep 'active (running)' > /dev/null 2>&1
		if [ $? = 0 ]; then
			exit 0
		else 
			#On fait des verification plus poussées pour etre sur que la commande n'est pas active afin de pouvoir retourner 1 dans le cas ou elle n'est pas active
			systemctl is-active $2 > /dev/null 2>&1
			if [ $? = 0 ]
			then
				exit 0
			else
				exit 1
			fi
		fi
	elif [[ $2 = "postfix" ]]; then
		systemctl status $2 | grep 'active (running)' > /dev/null 2>&1
		if [ $? = 0 ]; then
			exit 0
		else 
			#On fait des verification plus poussées pour etre sur que la commande n'est pas active afin de pouvoir retourner 1 dans le cas ou elle n'est pas active
			systemctl is-active $2 > /dev/null 2>&1
			if [ $? = 0 ]
			then
				exit 0
			else
				exit 1
			fi
		fi
	elif [[ $2 = "dovecot" ]]; then
		systemctl status $2 | grep 'active (running)' > /dev/null 2>&1
		if [ $? = 0 ]; then
			exit 0
		else 
			#On fait des verification plus poussées pour etre sur que la commande n'est pas active afin de pouvoir retourner 1 dans le cas ou elle n'est pas active
			systemctl is-active $2 > /dev/null 2>&1
			if [ $? = 0 ]
			then
				exit 0
			else
				exit 1
			fi
		fi
	fi
fi
# Si le code precedent s'est pas executé on sort
exit 1
