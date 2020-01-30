declare -A service
service[apache2]="apache2"
service[nginx]="nginx"
service[postfix]="postfix"
service[dovecot]="dovecot"
service[phpfpm]="php7.2-fpm"

if [ -n $1 ] 
then
	if [[ $1 = "apache2" ]]; then
		systemctl status $1 | grep 'active (running)' > /dev/null 2>&1
		if [ $? = 0 ]; then
			exit 0
		else 
			#On fait des verification plus poussées pour etre sur que la commande n'est pas active afin de pouvoir retourner 1 dans le cas ou elle n'est pas active
			systemctl is-active $1 > /dev/null 2>&1
			if [ $? = 0 ]
			then
				exit 0
			else
				exit 1
			fi
		fi
	elif [[ $1 = "nginx" ]]; then
		systemctl status $1 | grep 'active (running)' > /dev/null 2>&1
		if [ $? = 0 ]; then
			exit 0
		else 
			#On fait des verification plus poussées pour etre sur que la commande n'est pas active afin de pouvoir retourner 1 dans le cas ou elle n'est pas active
			systemctl is-active $1 > /dev/null 2>&1
			if [ $? = 0 ]
			then
				exit 0
			else
				exit 1
			fi
		fi
	elif [[ $1 = "php7.2-fpm" ]]; then
		systemctl status $1 | grep 'active (running)' > /dev/null 2>&1
		if [ $? = 0 ]; then
			exit 0
		else 
			#On fait des verification plus poussées pour etre sur que la commande n'est pas active afin de pouvoir retourner 1 dans le cas ou elle n'est pas active
			systemctl is-active $1 > /dev/null 2>&1
			if [ $? = 0 ]
			then
				exit 0
			else
				exit 1
			fi
		fi
	elif [[ $1 = "postfix" ]]; then
		systemctl status $1 | grep 'active (running)' > /dev/null 2>&1
		if [ $? = 0 ]; then
			exit 0
		else 
			#On fait des verification plus poussées pour etre sur que la commande n'est pas active afin de pouvoir retourner 1 dans le cas ou elle n'est pas active
			systemctl is-active $1 > /dev/null 2>&1
			if [ $? = 0 ]
			then
				exit 0
			else
				exit 1
			fi
		fi
	elif [[ $1 = "dovecot" ]]; then
		systemctl status $1 | grep 'active (running)' > /dev/null 2>&1
		if [ $? = 0 ]; then
			exit 0
		else 
			#On fait des verification plus poussées pour etre sur que la commande n'est pas active afin de pouvoir retourner 1 dans le cas ou elle n'est pas active
			systemctl is-active $1 > /dev/null 2>&1
			if [ $? = 0 ]
			then
				exit 0
			else
				exit 1
			fi
		fi
	fi
fi