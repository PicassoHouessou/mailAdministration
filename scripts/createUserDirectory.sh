#!/bin/bash

#Recoit le nom du répertoire à créer et ensuite crée le repertoire au bon endroit avec les to$
#return 0 si bon , sinon return 1


if [ -n $1 ]
then
	chemin="/externe/mail/vhosts/eneam.da/"
	#Creation dur repertoire principal 
        mkdir /externe/mail/vhosts/eneam.da/$1/  > /dev/null 2>&1
        #Création des sous répertoires
        mkdir /externe/mail/vhosts/eneam.da/$1/new/ > /dev/null 2>&1
        mkdir /externe/mail/vhosts/eneam.da/$1/tmp/ > /dev/null 2>&1
        mkdir /externe/mail/vhosts/eneam.da/$1/cur/ > /dev/null 2>&1
        cd $chemin
        chown -Rv vhosts:vhosts $1 > /dev/null 2>&1
        chmod -R 700 $1 > /dev/null 2>&1
        if [ $? = 0 ]
        then
                exit 0
        else
                exit 1
        fi
fi
