#!/bin/bash

#Recoit le nom du répertoire à supprimer ensuite supprime le repertoire au bon endroit
#return 0 si bon , sinon return 1
if [ -n $1 ]
then
        chemin="/externe/mail/vhosts/eneam.da/"
        cd $chemin
        #On s'assure qu'on n'est dans le bon dossier ensuite on suprrime le dossier correspon$
        if [ $? = 0 ]
        then
                rm -rf $1 > /dev/null 2>&1
                if [[ $? = 0 ]]; then
                        exit 0
                else
                        exit 1

                fi
        fi
fi